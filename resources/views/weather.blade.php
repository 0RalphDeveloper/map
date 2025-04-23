<form action="{{ route('weather.result') }}" method="POST">
    @csrf

    <div class="input-container">
        <select name="barangay" id="barangaySelect" required>
            <option value="">-- Select Barangay --</option>
            @foreach ($barangays as $barangay)
                <option value="{{ $barangay }}">{{ $barangay }}</option>
            @endforeach
        </select>

        <button type="submit">Get Weather</button>
    </div>
</form>
<div>
<a href="/dashboarduser" style="display: inline-block; padding: 10px 20px; background-color: blue; color: #fff; text-decoration: none; border-radius: 5px;">Dashboard</a>
</div>