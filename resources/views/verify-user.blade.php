<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Your Account</title>
</head>
<body style="font-family: Arial, sans-serif; text-align: center; padding: 20px;">

    <h2>Welcome, {{ $user->name }}!</h2>
    <p>Thank you for signing up. Please verify your email by clicking the button below:</p>

    <a href="{{ $verificationUrl }}" 
       style="display: inline-block; padding: 10px 20px; color: #fff; background-color: #28a745; text-decoration: none; border-radius: 5px;">
        Verify Your Account
    </a>

    <p>If you did not create an account, please ignore this email.</p>

</body>
</html>
