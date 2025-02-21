<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
@if(session()->has('message'))
    {{session()->get('message')}}
@endif

@if(session()->has('error'))
    {{session()->get('error')}}
@endif

    <h1>DASHBOARD ADMIN</h1>
    <form action="{{route('sendemail')}}" method = GET enctype="multipart/form-data">
        <input type="submit" value="Send Email to all users">
    </form>

</body>
</html>