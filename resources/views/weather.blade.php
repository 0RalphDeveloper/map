<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Weather Forecast - 3-Hour Intervals</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background-color: #f4f4f4;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-start;
            min-height: 100vh;
            overflow-x: hidden;
            padding: 20px;
        }

        .container {
            width: 95%;
            max-width: 1400px;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            align-items: center;
            overflow: hidden;
        }

        .current-weather {
            background: linear-gradient(135deg, #007bff, #00c6ff);
            color: white;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 20px;
            text-align: center;
            box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.2);
            width: 100%;
            font-size: 1.3rem;
        }

        .weather-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 15px;
            padding: 10px;
            width: 100%;
            max-height: 70vh;
            overflow-y: auto;
        }

        .weather-day {
            background: #f8f9fa;
            padding: 15px;
            min-width: 120px;
            border-radius: 10px;
            text-align: center;
            box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1);
            flex: 1 1 calc(100% / 8 - 20px);
            max-width: calc(100% / 8 - 20px);
        }

        .upcoming-title {
            font-size: 1.5rem;
            font-weight: bold;
            text-align: center;
            color: white;
            margin: 15px auto;
            padding: 10px 20px;
            background: linear-gradient(135deg, #007bff, #00c6ff);
            border-radius: 10px;
            box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.2);
            display: block;
            width: fit-content;
        }

        @media (max-width: 1200px) {
            .weather-day { flex: 1 1 calc(100% / 4 - 20px); max-width: calc(100% / 4 - 20px); }
        }
        @media (max-width: 800px) {
            .weather-day { flex: 1 1 calc(100% / 2 - 20px); max-width: calc(100% / 2 - 20px); }
        }
        @media (max-width: 500px) {
            .weather-day { flex: 1 1 100%; max-width: 100%; }
        }
    </style>
</head>
<body>

    <div class="container">
        <h2>Weather Forecast With 3-Hour Intervals 🌦</h2>
        <div id="weatherResult"></div>
        <p id="currentDateTime"></p>
    </div>

    <script>
        let lastFetchTime;

        function fetchWeather() {
            fetch('/weather')
            .then(response => {
                if (!response.ok) {
                    throw new Error("Weather data not found!");
                }
                return response.json();
            })
            .then(data => {
                if (!data.forecast || data.forecast.length === 0) {
                    document.getElementById('weatherResult').innerHTML = `<p style="color:red;">No weather data available.</p>`;
                    return;
                }

                let weatherHtml = `  
                    <div class="current-weather">
                        <h3>${data.city}, ${data.country}</h3>
                        <p><strong>Current Local Time:</strong> <span id="currentDateTimeDisplay">${formatDateTime(new Date())}</span></p>
                        <p><strong>Current Weather:</strong></p>
                        <p>🌡 Temperature: <strong>${data.forecast[0].temperature}°C</strong></p>
                        <p>🌤 Weather: <strong>${data.forecast[0].weather}</strong></p>
                        <img src="http://openweathermap.org/img/wn/${data.forecast[0].icon}.png" alt="Weather icon">
                    </div>
                    <p class="upcoming-title">Upcoming 3-Hour Intervals</p>
                    <div class="weather-container">`;

                // Display upcoming weather intervals
                data.forecast.slice(1).forEach(forecast => {
                    let forecastTime = new Date(forecast.datetime); // Convert API time to Date object
                    weatherHtml += `
                        <div class="weather-day">
                            <p><strong>${formatDateTime(forecastTime)}</strong></p>
                            <p>🌡 ${forecast.temperature}°C</p>
                            <p>🌤 ${forecast.weather}</p>
                            <img src="http://openweathermap.org/img/wn/${forecast.icon}.png" alt="Weather icon">
                        </div>`;
                });

                weatherHtml += `</div>`;
                document.getElementById('weatherResult').innerHTML = weatherHtml;

                // Schedule the next fetch after the next 3-hour interval
                scheduleNextFetch();
            })
            .catch(error => {
                document.getElementById('weatherResult').innerHTML = `<p style="color:red;">${error.message}</p>`;
            });
        }

        // Function to format datetime into readable format
        function formatDateTime(date) {
                let options = { 
                    year: 'numeric', 
                    month: 'short', 
                    day: '2-digit', 
                    hour: '2-digit', 
                    minute: '2-digit', 
                    hour12: true 
                };
                return date.toLocaleString('en-US', options); 
            
        }

        // Function to schedule the next fetch at the next 3-hour interval
        function scheduleNextFetch() {
            let now = new Date();
            // Round up to the next 3-hour interval
            let nextFetchTime = new Date(now);
            nextFetchTime.setHours(Math.ceil(now.getHours() / 3) * 3);  // Align to the next 3-hour interval
            nextFetchTime.setMinutes(0, 0, 0); // Set minutes, seconds, and milliseconds to 0

            let delay = nextFetchTime - now; // Calculate the time remaining in milliseconds
            //setTimeout(fetchWeather, delay);  // Schedule next fetch
        }

        // Update time display every second
        function updateDateTime() {
            let dateTimeElement = document.getElementById('currentDateTimeDisplay');
            if (dateTimeElement) {
                dateTimeElement.textContent = formatDateTime(new Date());
            }
        }

        window.onload = function() {
            fetchWeather();
            //setInterval(updateDateTime, 6000); // Update the time display every second
        };
    </script>

</body>
</html>
