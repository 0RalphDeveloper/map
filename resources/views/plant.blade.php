<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<h2>Add a New Plant</h2>
<form action="{{route('plants')}}" method = POST enctype="multipart/form-data">
    @csrf
    <label for="plant_name">Plant Name:</label>
    <input type="text" id="plant_name" name="name" required>

    <label for="barangay">Location:</label>
<select id="barangay" name="location" required>
    <option value="">-- Select Barangay --</option>
    @php
        $barangays = [
            "Angeles Zone I, Tayabas City",
            "Angeles Zone II, Tayabas City",
            "Angeles Zone III, Tayabas City",
            "Angeles Zone IV, Tayabas City",
            "Angustias Zone I, Tayabas City",
            "Angustias Zone II, Tayabas City",
            "Angustias Zone III, Tayabas City",
            "Angustias Zone IV, Tayabas City",
            "San Diego Zone I, Tayabas City",
            "San Diego Zone II, Tayabas City",
            "San Diego Zone III, Tayabas City",
            "San Diego Zone IV, Tayabas City",
            "San Isidro Zone I, Tayabas City",
            "San Isidro Zone II, Tayabas City",
            "San Isidro Zone III, Tayabas City",
            "San Isidro Zone IV, Tayabas City",
            "San Roque Zone I, Tayabas City",
            "San Roque Zone II, Tayabas City",
            "Brgy. Alitao, Tayabas City",
            "Brgy. Alasam Ibaba, Tayabas City",
            "Brgy. Alasam Ilaya, Tayabas City",
            "Brgy. Alupay, Tayabas City",
            "Brgy. Anos, Tayabas City",
            "Brgy. Ayaas, Tayabas City",
            "Brgy. Baguio, Tayabas City",
            "Brgy. Banilad, Tayabas City",
            "Brgy. Bukal Ibaba, Tayabas City",
            "Brgy. Bukal Ilaya, Tayabas City",
            "Brgy. Calantas, Tayabas City",
            "Brgy. Calumpang, Tayabas City",
            "Brgy. Camaysa, Tayabas City",
            "Brgy. Dapdap, Tayabas City",
            "Brgy. Domoit Kanluran, Tayabas City",
            "Brgy. Domoit Silangan, Tayabas City",
            "Brgy. Gibanga, Tayabas City",
            "Brgy. Ibas, Tayabas City",
            "Brgy. Ilasan Ibaba, Tayabas City",
            "Brgy. Ilasan Ilaya, Tayabas City",
            "Brgy. Ipilan, Tayabas City",
            "Brgy. Isabang, Tayabas City",
            "Brgy. Katigan Kanluran, Tayabas City",
            "Brgy. Katigan Silangan, Tayabas City",
            "Brgy. Lakawan, Tayabas City",
            "Brgy. Lalo, Tayabas City",
            "Brgy. Lawigue, Tayabas City",
            "Brgy. Lita, Tayabas City",
            "Brgy. Malaoa, Tayabas City",
            "Brgy. Masin, Tayabas City",
            "Brgy. Mate, Tayabas City",
            "Brgy. Mateuna, Tayabas City",
            "Brgy. Mayowe, Tayabas City",
            "Brgy. Nangka Ibaba, Tayabas City",
            "Brgy. Nangka Ilaya, Tayabas City",
            "Brgy. Opias, Tayabas City",
            "Brgy. Palale Ibaba, Tayabas City",
            "Brgy. Palale Ilaya, Tayabas City",
            "Brgy. Palale Kanluran, Tayabas City",
            "Brgy. Palale Silangan, Tayabas City",
            "Brgy. Pandakaki, Tayabas City",
            "Brgy. Pook, Tayabas City",
            "Brgy. Potol, Tayabas City",
            "Brgy. Talolong, Tayabas City",
            "Brgy. Tamlong, Tayabas City",
            "Brgy. Tongko, Tayabas City",
            "Brgy. Valencia, Tayabas City",
            "Brgy. Wakas, Tayabas City"
        ];
    @endphp

    @foreach ($barangays as $barangay)
        <option value="{{ $barangay }}">{{ $barangay }}</option>
    @endforeach
</select>

    


    <label for="species">Species:</label>
    <input type="text" id="species" name="species">

    <button type="submit">Add Plant</button>
    <p id="plantMessage"></p>
</form>

   <a href="/calendar" style="display: inline-block; padding: 10px 20px; background-color: grey; color: #fff; text-decoration: none; border-radius: 5px;">Plant Schedules</a>
   <a href="/dashboarduser" style="display: inline-block; padding: 10px 20px; background-color: #007bff; color: #fff; text-decoration: none; border-radius: 5px;">
        Back to Dashboard
    </a>
    
</body>
</html>