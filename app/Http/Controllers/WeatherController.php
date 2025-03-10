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

    public function getWeather(Request $request)
    {
        $city = 'Tayabas'; // Example city, can be dynamic based on user input.

        // Fetch weather data
        $weatherData = $this->weatherService->getWeather($city);

        if (isset($weatherData['error'])) {
            return response()->json($weatherData, 404);
        }

        return response()->json($weatherData);
    }
}