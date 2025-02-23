<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
@if(session()->has('success'))
            {{session()->get('success')}}
@endif

@if(!Auth::check())
    THIS IS DASHBOARD FOR VERFIED AND NON VERIFIED
    <p>LOGIN OR SIGN UP ACCOUNT TO USE SCHEDULING</p>
        <a href="/registeruser"><input type="submit" value="Sign Up"></a> 
        <br>
        <BR></BR>
        <a href="/loginuser"><input type="submit" value="Sign In"></a> 
    </div>
@endif

@if(Auth::check() && Auth::user()->role === 'admin')
        <div class="addplants">
        <br>
        THIS IS DASHBOARD FOR ADMINUSER

        <p>GO TO PLANT SCHEDULES</p>
        <a href="/plantsview"><input type="submit" value="Add Plants"></a> 
        <br><br>
        <a href="/dashboardadmin"><input type="submit" value="Dashboard Admin"></a> 
        <br><br>
        <a href="/announcement"><input type="submit" value="Admin Announcement"></a> 
        </div>   
    @elseif(Auth::check() && Auth::user()->verified)
    THIS IS DASHBOARD FOR VERIFIED USER
        <p>GO TO PLANT SCHEDULES</p>
        <a href="/plantsview"><input type="submit" value="Add Plants"></a> 
        </div>    
    @endif

    @if(Auth::check() && !Auth::user()->verified && Auth::user()->role === 'user')
    <div class="addplants">
    <br>
    THIS IS DASHBOARD FOR NON VERIFIED USER
    <p>VERIFY YOUR ACCOUNT TO USE SCHEDULING</p>
        <a href="/sendverificationuser"><input type="submit" value="Verify Account"></a> 
    </div>    
    @endif


    
</body>
</html>