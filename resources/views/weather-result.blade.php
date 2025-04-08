<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weather Forecast</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 150vh;
            flex-direction: column;
        }

        .container {
            background-color: rgba(255, 255, 255, 0.9); /* semi-transparent white */
            padding: 20px;
            border-radius: 15px;
            width: 100%;
            max-width: 900px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        h1 {
            color: #333;
        }

        .current-weather {
            background-color: #4CAF50;
            padding: 20px;
            color: white;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .barangay-name {
            font-size: 24px;
            font-weight: bold;
            color: #ffffff;
            margin-bottom: 15px;
        }

        .forecast {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            justify-content: center;
            overflow-y: auto;
            max-height: 400px; /* Set max height to make it scrollable */
            padding-top: 10px;
        }

        .forecast-item {
            background-color: #fff;
            padding: 15px;
            border-radius: 10px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
            width: 250px;
            text-align: center;
            flex: 0 0 auto;
        }

        .forecast-item img {
            width: 50px;
            height: 50px;
            margin-top: 10px;
        }

        .forecast-item h4 {
            font-size: 18px;
            margin: 10px 0;
            color: #333;
        }

        .forecast-item p {
            font-size: 14px;
            color: #555;
        }

        .error-message {
            color: red;
            font-size: 16px;
        }

        .btn-return {
        display: inline-block;
        background-color: #4CAF50; /* Green color */
        color: white;
        padding: 10px 20px;
        border-radius: 5px;
        text-decoration: none;
        font-size: 16px;
        text-align: center;
        transition: background-color 0.3s ease;
    }

    .btn-return:hover {
        background-color: #45a049; /* Darker green on hover */
    }
    </style>
</head>
<body>

    <div class="container">
        <h1>Weather Forecast</h1>

        @if (isset($weather['forecast']) && count($weather['forecast']) > 0)
            <!-- Current weather -->
            <div class="current-weather">
                @if (isset($barangay))
                    <div class="barangay-name">
                        Weather forecast for: <strong>{{ $barangay }}</strong>
                    </div>
                @endif
                <h3>{{ $weather['forecast'][0]['datetime'] }}</h3>
                <p>{{ $weather['forecast'][0]['temperature'] }}°C</p>
                <p>{{ $weather['forecast'][0]['weather'] }}</p>
                <img src="https://openweathermap.org/img/wn/{{ $weather['forecast'][0]['icon'] }}@2x.png" alt="Weather Icon">
            </div>

            <!-- 3-hour intervals forecast -->
            <div class="forecast">
                @foreach (array_slice($weather['forecast'], 1) as $forecast) <!-- Skipping current weather -->
                    <div class="forecast-item">
                        <h4>{{ $forecast['datetime'] }}</h4>
                        <p>{{ $forecast['temperature'] }}°C</p>
                        <p>{{ $forecast['weather'] }}</p>
                        <img src="https://openweathermap.org/img/wn/{{ $forecast['icon'] }}@2x.png" alt="Weather Icon">
                    </div>
                @endforeach
            </div>
        @else
            <p class="error-message">No weather data available.</p>
        @endif
    </div>
    <div>
        <br>
        <a href="/weather" class="btn-return">Return Back</a> 
    </div>


</body>
</html>

