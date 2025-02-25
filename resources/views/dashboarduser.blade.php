<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
@if(session()->has('success'))
            {{session()->get('success')}}
@endif
<br>


    THIS IS DASHBOARD FOR VERFIED AND NON VERIFIED
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navbar with Dropdown</title>

    <!-- Bootstrap 5 & FontAwesome -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow">
        <div class="container">
            <!-- Brand Logo -->
            <a class="navbar-brand" href="#">
                <i class="fas fa-leaf text-success"></i> Plant Scheduler
            </a>

            <!-- Toggle Button for Mobile -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Navbar Links & User Dropdown -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <!-- Left Side (Navigation Links) -->
                <ul class="navbar-nav me-auto">
                    <li class="nav-item"><a class="nav-link" href="#">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Contact</a></li>
                </ul>

                <li class="nav-item dropdown" style="position: relative; display: inline-block;">
                
    @if(Auth::check())
    <!-- Dropdown Toggle (User Icon) -->
    <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="text-decoration: none; color: inherit;">
        <i class="fas fa-user-circle fa-2x"></i>
    </a>
   
    <!-- Dropdown Menu -->
    <div class="dropdown-menu dropdown-menu-end shadow border-0 rounded-3" aria-labelledby="navbarDropdown" style="min-width: 200px;">

        <!-- User Info -->
        <div class="dropdown-header text-muted small">
            Signed in as <br>
            <strong>{{ Auth::user()->username }}</strong>
        </div>

        <div class="dropdown-divider"></div>

        <!-- Dashboard Link -->
        <a class="dropdown-item d-flex align-items-center" href="/dashboarduser">
            <i class="fas fa-tachometer-alt me-2"></i> Dashboard
        </a>
        <div class="dropdown-divider"></div>

        <!-- Logout Form -->
        <form id="logout-form" action="{{ route('logoutUser') }}" method="POST" style="display: none;">
            @csrf
        </form>
        <a class="dropdown-item d-flex align-items-center text-danger" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="fas fa-sign-out-alt me-2"></i> Logout
        </a>
    </div>
    </li>
    @endif
        </nav>

    @if(!Auth::check())
    <p>LOGIN OR SIGN UP ACCOUNT TO USE SCHEDULING</p>
    <a href="/registeruser" style="display: inline-block; padding: 10px 20px; background-color: #007bff; color: #fff; text-decoration: none; border-radius: 5px;">Sign Up</a>
    <br>
        <BR></BR>
        <a href="/loginuser" style="display: inline-block; padding: 10px 20px; background-color: #007bff; color: #fff; text-decoration: none; border-radius: 5px;">Sign In</a>
        </div>
    @endif


@if(Auth::check() && Auth::user()->role === 'admin')
        <div class="addplants">
        <br>
        THIS IS DASHBOARD FOR ADMINUSER

        <p>GO TO PLANT SCHEDULES</p>
        <a href="/plantsview" style="display: inline-block; padding: 10px 20px; background-color: green; color: #fff; text-decoration: none; border-radius: 5px;">Add Plants</a>
        <br><br>
        <a href="/announcement" style="display: inline-block; padding: 10px 20px; background-color: brown; color: #fff; text-decoration: none; border-radius: 5px;">Admin Announcement</a>
        


    @elseif(Auth::check() && Auth::user()->verified)
    THIS IS DASHBOARD FOR VERIFIED USER
        <p>GO TO PLANT SCHEDULES</p>
        <a href="/calendar" style="display: inline-block; padding: 10px 20px; background-color: green; color: #fff; text-decoration: none; border-radius: 5px;">Plant Schedules</a>
        </div>    
    @endif

    @if(Auth::check() && !Auth::user()->verified && Auth::user()->role === 'user')
    <div class="addplants">
    <br>
    THIS IS DASHBOARD FOR NON VERIFIED USER
    <p>VERIFY YOUR ACCOUNT TO USE SCHEDULING</p>
        <a href="/sendverificationuser" style="display: inline-block; padding: 10px 20px; background-color: #007bff; color: #fff; text-decoration: none; border-radius: 5px;">Verify Account</a>

    </div>    
    @endif


    
</body>
</html>