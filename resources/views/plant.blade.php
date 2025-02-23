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

    <label for="species">Species:</label>
    <input type="text" id="species" name="species">

    <button type="submit">Add Plant</button>
    <p id="plantMessage"></p>
</form>

   <a href="/calendar"><input type="submit" value="Plant Schedules"></a> 
   <a href="/dashboarduser"><input type="submit" value="Go to dashboard"></a> 

    
</body>
</html>