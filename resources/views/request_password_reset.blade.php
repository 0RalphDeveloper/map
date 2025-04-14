<h2>Forgot Your Password?</h2>

@if (session('status'))
    <p style="color: green;">{{ session('status') }}</p>
@endif

<form method="POST" action="{{ route('custom.send.link') }}">
    @csrf
    <input type="email" name="email" placeholder="Enter your email" required>
    <button type="submit">Send Password Reset Link</button>
</form>
