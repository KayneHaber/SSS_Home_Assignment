<!DOCTYPE html>
<html>
<head>
    <title>Edit Jam Session</title>
</head>
<body>
    <h1>Edit Jam Session</h1>

    <p><a href="{{ route('sessions.show', $session) }}">Back</a></p>

    @if ($errors->any())
        <div>
            <strong>Please fix the errors below.</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('sessions.update', $session) }}">
        @csrf
        @method('PUT')

        <h3>Venue</h3>
        <p>
            <label>Venue name</label><br>
            <input type="text" name="venue_name" value="{{ old('venue_name', $session->venue->name ?? '') }}">
        </p>

        <p>
            <label>Venue address</label><br>
            <input type="text" name="venue_address" value="{{ old('venue_address', $session->venue->address ?? '') }}">
        </p>

        <h3>Session</h3>
        <p>
            <label>Title</label><br>
            <input type="text" name="title" value="{{ old('title', $session->title) }}">
        </p>

        <p>
            <label>Genre</label><br>
            <input type="text" name="genre" value="{{ old('genre', $session->genre) }}">
        </p>

        <p>
            <label>Starts at</label><br>
            <input type="datetime-local" name="starts_at" value="{{ old('starts_at', \Carbon\Carbon::parse($session->starts_at)->format('Y-m-d\TH:i')) }}">
        </p>

        <p>
            <label>Description</label><br>
            <textarea name="description" rows="4" cols="40">{{ old('description', $session->description) }}</textarea>
        </p>

        <button type="submit">Save</button>
    </form>
</body>
</html>
