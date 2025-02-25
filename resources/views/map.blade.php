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

    <h1>Plant Street View, Click to View Plants</h1>
    <p>Click the marker to zoom in and view the plants of each barangay.</p>
    
    <div id="map"></div>

    <script>
        var map = L.map('map').setView([14.5995, 120.9842], 12);

        // Load OpenStreetMap tiles
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        var userMarker, accuracyCircle;

        // Function to add barangay markers
        function addBarangayMarker(name, lat, lng) {
            var marker = L.marker([lat, lng]).addTo(map)
                .bindPopup(`<b>${name}</b><br>
                            <button onclick="viewPlace(${lat}, ${lng})">View Plants Here</button>`);
            return marker;
        }

        // Example barangay locations (Replace with actual lat/lng)
        var barangays = [
            { name: "Angeles Zone I, Tayabas City", lat: 14.02749696281908, lng: 121.59328602754334 },
            { name: "Angeles Zone II, Tayabas City", lat: 14.027747530836868, lng: 121.59268217339907 },
            { name: "Angeles Zone III, Tayabas City", lat: 14.02870527133438, lng: 121.59213117134392 },
            { name: "Angeles Zone IV, Tayabas City", lat: 14.029102539806926, lng: 121.59482434456272 },
            { name: "Angustias Zone I, Tayabas City", lat: 14.031264483550189, lng: 121.5884998732706 },
            { name: "Angustias Zone II, Tayabas City", lat: 14.031394, lng: 121.5891694 },
            { name: "Angustias Zone III, Tayabas City", lat: 14.0279358, lng: 121.5929226 },
            { name: "Angustias Zone IV, Tayabas City", lat: 14.0335803, lng: 121.5883996 },
            { name: "San Diego Zone I, Tayabas City", lat: 14.0286886, lng: 121.5918591 },
            { name: "San Diego Zone II, Tayabas City", lat: 14.0294334, lng: 121.5925663 },
            { name: "San Diego Zone III, Tayabas City", lat: 14.0298214, lng: 121.5928784 },
            { name: "San Diego Zone IV, Tayabas City", lat: 14.031256322652359, lng: 121.5938920713855 },
            { name: "San Isidro Zone I, Tayabas City", lat: 14.0287089, lng: 121.5879589 },
            { name: "San Isidro Zone II, Tayabas City", lat: 14.0283909, lng: 121.5859833 },
            { name: "San Isidro Zone III, Tayabas City", lat: 14.0285625, lng: 121.5880822 },
            { name: "San Isidro Zone IV, Tayabas City", lat: 14.0287963, lng: 121.5879358 },
            { name: "San Roque Zone I, Tayabas City", lat: 14.0301685, lng: 121.5901842 },
            { name: "San Roque Zone II, Tayabas City", lat: 14.032059320549893, lng: 121.59150902408233 },
            { name: "Brgy. Alitao, Tayabas City", lat: 14.0461, lng: 121.5374 },
            { name: "Brgy. Alasam Ibaba, Tayabas City", lat: 14.0251, lng: 121.6301 },
            { name: "Brgy. Alasam Ilaya, Tayabas City", lat: 14.0375, lng: 121.6302 },
            { name: "Brgy. Alupay, Tayabas City", lat: 14.0582, lng: 121.6099 },
            { name: "Brgy. Anos, Tayabas City", lat: 13.9910, lng: 121.5667 },
            { name: "Brgy. Ayaas, Tayabas City", lat:  14.0295, lng: 121.6125 },
            { name: "Brgy. Baguio, Tayabas City", lat:  14.0183, lng: 121.5859 },
            { name: "Brgy. Banilad, Tayabas City", lat:  14.0430, lng: 121.6055 },
            { name: "Brgy. Bukal Ibaba, Tayabas City", lat:  14.0094, lng: 121.5590 },
            { name: "Brgy. Bukal Ilaya, Tayabas City", lat:  14.0359, lng: 121.5253 },
            { name: "Brgy. Calantas, Tayabas City", lat:  14.0367, lng: 121.5448 },
            { name: "Brgy. Calumpang, Tayabas City", lat: 13.9770, lng: 121.5575 },
            { name: "Brgy. Camaysa, Tayabas City", lat: 14.0457, lng: 121.5734 },
            { name: "Brgy. Dapdap, Tayabas City", lat: 14.0521, lng: 121.5698 },
            { name: "Brgy. Domoit Kanluran, Tayabas City", lat: 13.9769, lng: 121.5837 },
            { name: "Brgy. Domoit Silangan, Tayabas City", lat: 13.9749, lng: 121.5925 },
            { name: "Brgy. Gibanga, Tayabas City", lat:  14.0259, lng: 121.5194 },
            { name: "Brgy. Ibas, Tayabas City", lat:  14.0573, lng: 121.5859 },
            { name: "Brgy. Ilasan Ibaba, Tayabas City", lat:  14.0623, lng: 121.6268 },
            { name: "Brgy. Ilasan Ilaya, Tayabas City", lat:  14.0639, lng: 121.6326 },
            { name: "Brgy. Ipilan, Tayabas City", lat:  14.0249, lng: 121.5854 },
            { name: "Brgy. Isabang, Tayabas City", lat:  13.9641, lng: 121.5650 },
            { name: "Brgy. Katigan Kanluran, Tayabas City", lat:  14.0451, lng: 121.6194 },
            { name: "Brgy. Katigan Silangan, Tayabas City", lat:  14.0562, lng: 121.6213 },
            { name: "Brgy. Lakawan, Tayabas City", lat:  14.0116, lng: 121.6191 },
            { name: "Brgy. Lalo, Tayabas City", lat:  14.0416, lng: 121.5671 },
            { name: "Brgy. Lawigue, Tayabas City", lat:  14.0292, lng: 121.6472 },
            { name: "Brgy. Lita, Tayabas City", lat:  14.0185, lng: 121.5972 },
            { name: "Brgy. Malaoa, Tayabas City", lat:  14.0081, lng: 121.5785 },
            { name: "Brgy. Masin, Tayabas City", lat:  14.0528, lng: 121.6415 },
            { name: "Brgy. Mate, Tayabas City", lat:  14.0035, lng: 121.6362 },
            { name: "Brgy. Mateuna, Tayabas City", lat:  14.0238, lng: 121.6011 },
            { name: "Brgy. Mayowe, Tayabas City", lat:  13.9721, lng: 121.5801 },
            { name: "Brgy. Nangka Ibaba, Tayabas City", lat:  13.9938, lng: 121.6014 },
            { name: "Brgy. Nangka Ilaya, Tayabas City", lat:  14.0111, lng: 121.5937 },
            { name: "Brgy. Opias, Tayabas City", lat:  14.0292, lng: 121.5950 },
            { name: "Brgy. Palale Ibaba, Tayabas City", lat:  14.0454, lng: 121.6750 },
            { name: "Brgy. Palale Ilaya, Tayabas City", lat:  14.0532, lng: 121.6569 },
            { name: "Brgy. Palale Kanluran, Tayabas City", lat:  14.0434, lng: 121.6515 },
            { name: "Brgy. Palale Silangan, Tayabas City", lat:  14.0668, lng: 121.6787 },
            { name: "Brgy. Pandakaki, Tayabas City", lat:  13.9895, lng: 121.6271 },
            { name: "Brgy. Pook, Tayabas City", lat:  14.0482, lng: 121.5938 },
            { name: "Brgy. Potol, Tayabas City", lat:  13.9909, lng: 121.5872 },
            { name: "Brgy. Talolong, Tayabas City", lat:  14.0786, lng: 121.6128 },
            { name: "Brgy. Tamlong, Tayabas City", lat:  14.0651, lng: 121.5973 },
            { name: "Brgy. Tongko, Tayabas City", lat:  13.9896, lng: 121.6119 },
            { name: "Brgy. Valencia, Tayabas City", lat:  14.0733, lng: 121.6552 },
            { name: "Brgy. Wakas, Tayabas City", lat:  13.9971, lng: 121.6088 },
        ];

        localStorage.setItem("barangays", JSON.stringify(barangays.map(b => b.name)));


        // Loop through the barangay list and add markers
        barangays.forEach(barangay => {
        var marker = L.marker([barangay.lat, barangay.lng]).addTo(map)
        .bindPopup(`<b>${barangay.name}</b><br>
                    <button onclick="viewPlants('${barangay.name}')">View Plants</button>`);
});

        function onLocationFound(e) {
            var latlng = e.latlng;
            var accuracy = e.accuracy;

            if (!userMarker) {
                userMarker = L.marker(latlng, { draggable: false }).addTo(map)
                    .bindPopup(`<b>You are here!</b><br>
                                <button onclick="viewPlace(${latlng.lat}, ${latlng.lng})">View Plants Here!</button>`)
                    .openPopup();
            } else {
                userMarker.setLatLng(latlng);
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
        function viewPlants(barangay) {
        window.location.href = `/brgyplants?barangay=${encodeURIComponent(barangay)}`;
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
                enableHighAccuracy: true, 
                maximumAge: 5000, 
                timeout: 10000
            }
        );
    </script>

</body>
</html>
