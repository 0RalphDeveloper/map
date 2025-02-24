<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Verification</title>
</head>
<body style="font-family: Arial, sans-serif; text-align: center; padding: 180px;">
    <h2>Welcome, {{ $user->username }}!</h2>
    <p>Please verify your account by clicking the button below:</p>

    <form action="{{ route('sentverification') }}" method="POST">
        @csrf
        <button type="submit" style="padding: 10px 20px; color: #fff; background-color: #28a745; border: none; border-radius: 5px; cursor: pointer;">
            Verify Your Account
        </button>
    </form>

    <br>

    <a href="/dashboarduser" style="display: inline-block; padding: 10px 20px; background-color: #007bff; color: #fff; text-decoration: none; border-radius: 5px;">
        Back to Dashboard
    </a>
</body>
</html>
