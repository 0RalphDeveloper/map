<?php

use App\Models\Login;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MapController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/verify-user/{id}', function ($id) {
    $user = Login::findOrFail($id);
    $user->verified = true;
    $user->save();
    return redirect('/loginuser')->with('success', 'Your account has been verified. You can now log in.');
})->name('verifyuser');

Route::get('/registeruser', [LoginController::class, 'createview'])->name('registeruser');
Route::post('/createaccount', [LoginController::class, 'createstore'])->name('createstore');
Route::get('/loginuser', [LoginController::class, 'loginview'])->name('loginview');
Route::post('/loggedinuser', [LoginController::class, 'loginuser'])->name('loginuser');

Route::middleware('authuser')->group(function (){
Route::get('/calendar', [ScheduleController::class, 'index'])->name('calendar');
Route::post('/schedules', [ScheduleController::class, 'store'])->name('schedules');

Route::get('/plantsview', [ScheduleController::class, 'viewplants'])->name('viewplants');
Route::post('/plants', [ScheduleController::class, 'plants'])->name('plants');

Route::get('/map', [MapController::class, 'mapview']);

Route::get('/direction', [MapController::class, 'getDirection']);
Route::get('/categories', [MapController::class, 'categories']);

Route::get('/send-email', [LoginController::class, 'sendEmail'])->name('sendemail');
});

Route::middleware('authadmin')->group(function (){
    Route::get('/dashboardadmin', [DashboardController::class, 'viewdashboard'])->name('viewdashboard');

    Route::get('/announcement', [LoginController::class, 'annoucenmentview'])->name('annoucenmentview');
    Route::post('/announcement/send', [LoginController::class, 'sendAnnouncement'])->name('sendAnnouncement');
});






