<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leaflet.js Click to View Google Street View</title>
    
    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"></script>

    <style>
        body { font-family: Arial, sans-serif; text-align: center; }
        #map { height: 500px; width: 100%; margin-top: 20px; }
    </style>
</head>
<body>

    <h1>Leaflet.js Click to View Google Street View</h1>
    <p>Click the marker to zoom in and view the place in Google Street View.</p>
    
    <div id="map"></div>

    <script>
        var map = L.map('map').setView([0, 0], 13); // Default map view

        // Load OpenStreetMap tiles
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        var marker, accuracyCircle;

        function onLocationFound(e) {
            var latlng = e.latlng;
            var accuracy = e.accuracy;

            if (!marker) {
                // Create marker with click event to view place in Google Street View
                marker = L.marker(latlng, { draggable: false }).addTo(map)
                    .bindPopup(`<b>You are here!</b><br>
                                <button onclick="viewPlace(${latlng.lat}, ${latlng.lng})">View in Street View</button>`)
                    .openPopup();

                marker.on("click", function () {
                    map.setView(latlng, 18, { animate: true }); // Zoom in on click
                });

            } else {
                marker.setLatLng(latlng);
            }

            if (!accuracyCircle) {
                accuracyCircle = L.circle(latlng, { radius: accuracy }).addTo(map);
            } else {
                accuracyCircle.setLatLng(latlng);
                accuracyCircle.setRadius(accuracy);
            }

            map.setView(latlng, 15);
        }

        function onLocationError(e) {
            alert("Error getting location: " + e.message);
        }

        // Open Google Street View for the clicked location
        function viewPlace(lat, lng) {
            // Open Google Street View
            window.open(`https://www.google.com/maps/@?api=1&map_action=pano&viewpoint=${lat},${lng}`, "_blank");
        }

        // Enable real-time tracking with high accuracy
        navigator.geolocation.watchPosition(
            function(position) {
                var latlng = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };
                var accuracy = position.coords.accuracy;

                onLocationFound({ latlng: latlng, accuracy: accuracy });
            },
            onLocationError,
            {
                enableHighAccuracy: true, // Use GPS for better accuracy
                maximumAge: 5000, // Use cached location if it’s < 5 sec old
                timeout: 10000 // Wait up to 10 sec before error
            }
        );
    </script>

</body>
</html>
