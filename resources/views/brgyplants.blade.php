<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plants in {{ $barangay }}</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"></script>
    <style>
        body { font-family: Arial, sans-serif; text-align: center; }
        #map { height: 500px; width: 100%; margin-top: 20px; }
        .plant-container { margin-top: 20px; }
    </style>
</head>
<body>

    <h1>Plants in {{ $barangay }}</h1>
    <button onclick="history.back()">Back to Map</button>

    <div class="plant-container">
        @if($plants->isEmpty())
            <p>No plants found in this barangay.</p>
        @else
            <ul>
                @foreach($plants as $plant)
                    <li>{{ $plant->name }}</li>
                @endforeach
            </ul>
        @endif
    </div>

</body>
</html>
