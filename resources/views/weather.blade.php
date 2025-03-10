

blade
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
            justify-content: center;
            height: 100vh;
            overflow: hidden;
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
        }
        .weather-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 15px;
            padding: 10px;
            max-height: 60vh;
            overflow-y: auto;
            width: 100%;
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
        <h2>Weather Forecast - 3-Hour Intervals 🌦</h2>
        <div id="weatherResult"></div>
        <p id="currentDateTime"></p>
    </div>

    <script>
        function fetchWeather() {
            let csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            
            fetch('/weather', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrfToken },
                body: JSON.stringify({}) // You can pass dynamic data here if needed
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error("Weather data not found!");
                }
                return response.json();
            })
            .then(data => {
                let weatherHtml = `  
                    <div class="current-weather">
                        <h3>${data.city}, ${data.country}</h3>
                        <p><strong>Current Date and Time:</strong> <span id="currentDateTimeDisplay">${new Date()}</span></p>
                        <p><strong>Current Weather:</strong></p>
                        <p><strong>${formatAMPM(new Date(data.forecast[0].datetime))}</strong></p>
                        <p>🌡 Temperature: <strong>${data.forecast[0].temperature}°C</strong></p>
                        <p>🌤 Weather: <strong>${data.forecast[0].weather}</strong></p>
                        <img src="http://openweathermap.org/img/wn/${data.forecast[0].icon}.png" alt="Weather icon">
                    </div>
                    <div class="weather-container">`;

                // Displaying the upcoming 3-hour intervals starting from the second one
                data.forecast.slice(1).forEach(forecast => {
                    weatherHtml += `
                        <div class="weather-day">
                            <p><strong>${formatAMPM(new Date(forecast.datetime))}</strong></p>
                            <p>🌡 ${forecast.temperature}°C</p>
                            <p>🌤 ${forecast.weather}</p>
                            <img src="http://openweathermap.org/img/wn/${forecast.icon}.png" alt="Weather icon">
                        </div>`;
                });
                
                weatherHtml += `</div>`;
                document.getElementById('weatherResult').innerHTML = weatherHtml;
            })
            .catch(error => {
                document.getElementById('weatherResult').innerHTML = `<p style="color:red;">${error.message}</p>`;
            });
        }

        // Function to format date to 12-hour AM/PM format
        function formatAMPM(date) {
            let hours = date.getHours();
            let minutes = date.getMinutes();
            let ampm = hours >= 12 ? 'PM' : 'AM';
            hours = hours % 12;
            hours = hours ? hours : 12; // the hour '0' should be '12'
            minutes = minutes < 10 ? '0' + minutes : minutes;
            let currentDate = date.toLocaleDateString(); // Current date
            return `${currentDate} ${hours}:${minutes} ${ampm}`;
        }

      // Function to update the date and time every second
        function updateDateTime() {
            document.getElementById('currentDateTimeDisplay').textContent = new Date();
        }

        window.onload = function() {
            fetchWeather();            // Fetch weather data on load
            //setInterval(fetchWeather, 10800000); 
            //setInterval(updateDateTime, 1000); // Update the date and time every second
        };
    </script>

</body>
</html>