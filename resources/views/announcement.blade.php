<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
        .announce{
            display: inline-block; 
            padding: 10px 20px; 
            background-color:rgba(219, 20, 20, 0.81); 
            color: #fff; 
            text-decoration: none; 
            border-radius: 5px;
            cursor: pointer;
            border: none;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>THIS IS ADMIN ANNOUNCEMENT SECTIONS</h1>
    <h2>Send Announcement</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('sendAnnouncement') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="recipient" class="form-label">Recipient:</label>
            <select name="recipient" id="recipient" class="form-control" required>
                <option value="all">All Users</option>
                <option value="non-verified">Non-Verified Users</option>
                <option value="verified">Verified Users</option>

            </select>
        </div>

        
        <div class="mb-3">
            <label for="subject" class="form-label">Subject:</label>
            <input type="text" name="subject" id="subject" class="form-control" required>
        </div>


        <div class="mb-3">
            <label for="message" class="form-label">Message:</label>
            <textarea name="message" id="message" class="form-control" rows="5" required></textarea>
        </div>

        <button type="submit" class="announce">Send Announcement</button>
    </form>
    <br>
    <a href="/dashboarduser" style="display: inline-block; padding: 10px 20px; background-color: #007bff; color: #fff; text-decoration: none; border-radius: 5px;">
        Back to Dashboard
    </a>
</div>

</body>
</html>