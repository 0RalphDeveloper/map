<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function viewdashboard(){
        return view('dashboard');
    }

    public function dashboardview(){
        return view('dashboarduser');
    }


}
