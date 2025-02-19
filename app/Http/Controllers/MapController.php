<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MapController extends Controller
{
    public function mapview(){
        return view('map');
    }

    public function categories(){
        return view('category');
    }

    
}
