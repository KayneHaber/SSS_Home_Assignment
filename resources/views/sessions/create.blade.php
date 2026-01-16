<!DOCTYPE html>
<html>
<head>
    <title>Add Jam Session</title>
</head>
<body>
    <h1>Add Jam Session</h1>

    <p><a href="{{ route('sessions.index') }}">Back</a></p>

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

    <form method="POST" action="{{ route('sessions.store') }}">
        @csrf

        <h3>Venue</h3>
        <p>
            <label>Venue name</label><br>
            <input type="text" name="venue_name" value="{{ old('venue_name') }}">
        </p>

        <p>
            <label>Venue address</label><br>
            <input type="text" name="venue_address" value="{{ old('venue_address') }}">
        </p>

        <h3>Session</h3>
        <p>
            <label>Title</label><br>
            <input type="text" name="title" value="{{ old('title') }}">
        </p>

        <p>
            <label>Genre</label><br>
            <input type="text" name="genre" value="{{ old('genre') }}">
        </p>

        <p>
            <label>Starts at</label><br>
            <input type="datetime-local" name="starts_at" value="{{ old('starts_at') }}">
        </p>

        <p>
            <label>Description</label><br>
            <textarea name="description" rows="4" cols="40">{{ old('description') }}</textarea>
        </p>

        <button type="submit">Create</button>
    </form>
</body>
</html>
