<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plant Schedule</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid black; padding: 10px; text-align: left; }
        th { background-color: #f2f2f2; }
        .success { color: green; }
        .error { color: red; }
    </style>
</head>
<body>

    <h2>Plant Scheduling</h2>

    <form action="{{route('schedules')}}" method = POST enctype="multipart/form-data">
    @csrf
        <label for="plant">Plant Name:</label>
        <select id="plant_id" name="plant_id">
            @foreach(\App\Models\Plant::all() as $plant)
                <option value="{{ $plant->id }}">{{ $plant->name }}</option>
            @endforeach
        </select>
        <label for="event_type">Event Type:</label>
        <select id="event_type" name="event_type">
            <option value="watering">Watering</option>
            <option value="fertilizing">Fertilizing</option>
            <option value="pruning">Pruning</option>
        </select>

        <label for="event_date">Date & Time:</label>
        <input type="datetime-local" id="event_date" name="event_date" required>

        <button type="submit">Add Schedule</button>

        <p id="message"></p>
    </form>


    <h3>Schedule List</h3>
    <table>
        <thead>
            <tr>
                <th>Plant</th>
                <th>Event</th>
                <th>Date</th>
                <th>Location</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody id="scheduleTable">
            @foreach($schedules as $schedule)
                <tr>
                    <td>{{ $schedule->plant->name }}</td>
                    <td>{{ ucfirst($schedule->event_type) }}</td>
                    <td>{{ $schedule->event_date }}</td>
                    <td>{{ $schedule->plant->location }}</td>
                    <td>{{ ucfirst($schedule->status) }}
                        @if($schedule->status === 'pending') 
                        <form action="{{route('completeschedule', $schedule->id)}}" method="GET">
                        @csrf
                        <button class="btn btn-primary btn-sm delete-notification">
                            <i class="fas fa-check "></i> Complete</button>
                        </form>
                        @endif
                    </td>

                </tr>
            @endforeach
        </tbody>
    </table>
</form>
<div class="addplants">
    <br>
    @if(Auth::check() && Auth::user()->role === 'admin')
    <a href="/plantsview" style="display: inline-block; padding: 10px 20px; background-color: green; color: #fff; text-decoration: none; border-radius: 5px;">Add Plants</a>
    @endif
    <a href="/dashboarduser" style="display: inline-block; padding: 10px 20px; background-color: #007bff; color: #fff; text-decoration: none; border-radius: 5px;">
        Back to Dashboard
    </a></div>



</body>
</html>
