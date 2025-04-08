<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\WeatherService;

class WeatherController extends Controller
{
    protected $weatherService;

    public function __construct(WeatherService $weatherService)
    {
        $this->weatherService = $weatherService;
    }

    // Show the Blade view with the barangay dropdown and weather data
    public function index()
    {
        // List of barangays (you can add more if needed)
        $barangays = [
            'Alupay', 'Angeles', 'Anos', 'Bagumbayan', 'Calumpang',
            'Dapdap', 'Domit', 'Ipilan', 'Lalo', 'Opias', 'Palale', 'San Diego'
        ];

        return view('weather', compact('barangays'));
    }

    public function showWeather(Request $request)
    {
        $barangay = $request->input('barangay');
    
        if (!$barangay) {
            return response()->json(['error' => 'Please select a barangay.'], 400);
        }
    
        // Fetch weather data using the WeatherService
        $weather = $this->weatherService->getWeather($barangay);
    
        // Check if there's an error in the result
        if (isset($weather['error'])) {
            return response()->json(['error' => $weather['error']], 400);
        }
    
        // Pass the weather data to the Blade view
        return view('weather-result', ['weather' => $weather, 'barangay' => $barangay]);
    }
    
}