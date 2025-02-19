<form action="/detect" method="POST">
    @csrf
    <label for="image_url">Enter Image URL:</label>
    <input type="text" name="image_url" id="image_url" required>
    <button type="submit">Detect Face</button>
</form>
