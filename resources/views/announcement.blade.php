<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
                @foreach(\App\Models\Login::all() as $user)
                    <option value="{{ $user->email }}">{{ $user->email }}</option>
                @endforeach
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

        <button type="submit" class="btn btn-primary">Send Announcement</button>
    </form>
</div>

</body>
</html>