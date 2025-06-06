<?php

use App\Models\Login;
use App\Models\Plant;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MapController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\WeatherController;
use App\Http\Controllers\ResetPasswordController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/verify-user/{id}', function ($id) {
    $user = Login::findOrFail($id);
    $user->verified = true;
    $user->save();
    return redirect('/dashboarduser');
})->name('verifyuser');

Route::get('/request-password-reset', [ResetPasswordController::class, 'showRequestForm'])->name('custom.request.form');
Route::post('/send-password-reset-link', [ResetPasswordController::class, 'sendResetLink'])->name('custom.send.link');

Route::get('/custom-password-reset', [ResetPasswordController::class, 'showResetForm'])->name('custom.reset.form');
Route::post('/custom-password-reset', [ResetPasswordController::class, 'resetPassword'])->name('custom.reset.submit');

Route::post('/dashboardadmin/create', [LoginController::class, 'logoutUser'])->name('logoutUser');

Route::get('/registeruser', [LoginController::class, 'createview'])->name('registeruser');
Route::post('/createaccount', [LoginController::class, 'createstore'])->name('createstore');
Route::get('/loginuser', [LoginController::class, 'loginview'])->name('loginview');
Route::post('/loggedinuser', [LoginController::class, 'loginuser'])->name('loginuser');

Route::get('/dashboarduser', [DashboardController::class, 'dashboardview'])->name('dashboardview');

Route::middleware('authuser')->group(function (){
    Route::get('/sendverificationuser', [LoginController::class, 'sendverification'])->name('sendverification');
    Route::post('/sentverification/{id}', [LoginController::class, 'sentverification'])->name('sentverification');

});

Route::middleware('authverified')->group(function (){

Route::get('/weather', [WeatherController::class, 'index']);
Route::post('/weather/result', [WeatherController::class, 'showWeather'])->name('weather.result');

Route::get('/calendar', [ScheduleController::class, 'index'])->name('calendar');
Route::post('/schedules', [ScheduleController::class, 'store'])->name('schedules');
Route::get('/completed/{id}', [ScheduleController::class, 'completeschedule'])->name('completeschedule');

Route::get('/brgyplants',[ScheduleController::class, 'viewBrgy']);

Route::get('/map', [MapController::class, 'mapview']);

Route::get('/direction', [MapController::class, 'getDirection']);
Route::get('/categories', [MapController::class, 'categories']);

Route::get('/send-email', [LoginController::class, 'sendEmail'])->name('sendemail');

});

Route::middleware('authadmin')->group(function (){
    Route::get('/plantsview', [ScheduleController::class, 'viewplants'])->name('viewplants');
    Route::post('/plants', [ScheduleController::class, 'plants'])->name('plants');

    Route::get('/announcement', [LoginController::class, 'annoucenmentview'])->name('annoucenmentview');
    Route::post('/announcement/send', [LoginController::class, 'sendAnnouncement'])->name('sendAnnouncement');
});








