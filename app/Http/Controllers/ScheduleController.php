<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Models\Plant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ScheduleController extends Controller
{
    public function index()
    {
        $schedules = Schedule::with('plant')->where('login_id', Auth::id())->get();
        return view('calendar', compact('schedules'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'plant_id' => 'required|exists:plants,id',
            'event_type' => 'required|in:watering,fertilizing,pruning',
            'event_date' => 'required|date',
        ]);

        $schedule = Schedule::create([
            'login_id' => Auth::id(),
            'plant_id' => $request->plant_id,
            'event_type' => $request->event_type,
            'event_date' => $request->event_date,
            'status' => $request->status ?? 'pending',
        ]);
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

    public function completeschedule($id)
{
    // Get the authenticated user's ID
    $userId = Auth::id();

    // Find the schedule that belongs to the logged-in user
    $schedule = Schedule::where('id', $id)
                        ->where('login_id', $userId)
                        ->firstOrFail();

    // Update the status to "completed"
    $schedule->update(['status' => 'completed']);

    return back();
}

    public function viewBrgy(Request $request){
        $barangay = $request->query('barangay');
        $plants = Plant::where('location', $barangay)->get();

        return view('brgyplants', compact('barangay', 'plants')); 
    }

    
}
