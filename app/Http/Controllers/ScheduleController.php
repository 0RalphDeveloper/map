<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Models\Plant;
use Illuminate\Http\Request;
class ScheduleController extends Controller
{
    public function index()
    {
        $schedules = Schedule::with('plant')->get();
        return view('calendar', compact('schedules'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'plant_id' => 'required|exists:plants,id',
            'event_type' => 'required|in:watering,fertilizing,pruning',
            'event_date' => 'required|date',
        ]);

        $schedule = Schedule::create($request->all());

        return redirect()->back();
    }

    public function plants(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'species' => 'nullable|string|max:255',
            'location' => 'required|string',

        ]);

        $plant = Plant::create([
            'name' => $request->name,
            'species' => $request->species,
            'location' => $request->location

        ]);

        return back();
    }

    public function viewplants(){
        return view('plant');
    }


    
}
