<!DOCTYPE html>
<html>
<head>
    <title>View Jam Session</title>
</head>
<body>
    <h1>View Jam Session</h1>

    <p><a href="{{ route('sessions.index') }}">Back</a></p>

    @if (session('success'))
        <p><strong>{{ session('success') }}</strong></p>
    @endif

    <h2>{{ $session->title }}</h2>

    <p><strong>Genre:</strong> {{ $session->genre }}</p>
    <p><strong>Starts:</strong> {{ \Carbon\Carbon::parse($session->starts_at)->format('d M Y, H:i') }}</p>
    <p><strong>Venue:</strong> {{ $session->venue->name ?? 'N/A' }}</p>

    @if (!empty($session->venue?->address))
        <p><strong>Venue address:</strong> {{ $session->venue->address }}</p>
    @endif

    @if (!empty($session->description))
        <p><strong>Description:</strong><br>{{ $session->description }}</p>
    @endif

    <p>
        <a href="{{ route('sessions.edit', $session) }}">Edit</a>
    </p>
</body>
</html>
