<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barangay Weather</title>
    <style>
        /* Your existing styles */
    </style>
</head>
<body>
    <div class="container">
        <h2>Select Barangay for Weather Info</h2>

        <!-- Horizontal layout for barangay selection and button -->
        <div class="input-container">
            <select id="barangaySelect">
                <option value="">-- Select Barangay --</option>
                @foreach ($barangays as $barangay)
                    <option value="{{ $barangay }}">{{ $barangay }}</option>
                @endforeach
            </select>

            <button id="getWeather">Get Weather</button>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#getWeather').click(function() {
                let barangay = $('#barangaySelect').val();

                if (!barangay) {
                    alert("Please select a barangay.");
                    return;
                }

                // Redirect to a new page with the weather data (passing the barangay as a query parameter)
                window.location.href = "/weather/result?barangay=" + encodeURIComponent(barangay);
            });
        });
    </script>
</body>
</html>
