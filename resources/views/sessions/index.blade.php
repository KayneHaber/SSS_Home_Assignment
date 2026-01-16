<!DOCTYPE html>
<html>
<head>
    <title>Jam Sessions</title>
</head>
<body>
    <h1>Jam Sessions</h1>

    <p><a href="{{ route('sessions.create') }}">Add Jam Session</a></p>

    @if (session('success'))
        <p><strong>{{ session('success') }}</strong></p>
    @endif

    @if ($sessions->isEmpty())
        <p>No jam sessions yet.</p>
    @else
        <ul>
            @foreach ($sessions as $s)
                <li>
                    <strong>{{ $s->title }}</strong><br>
                    Genre: {{ $s->genre }}<br>
                    Starts: {{ \Carbon\Carbon::parse($s->starts_at)->format('d M Y, H:i') }}<br>
                    Venue: {{ $s->venue->name ?? 'N/A' }}<br>

                    <a href="{{ route('sessions.show', $s) }}">View</a>
                    |
                    <a href="{{ route('sessions.edit', $s) }}">Edit</a>

                    <form method="POST" action="{{ route('sessions.destroy', $s) }}" style="margin-top: 6px;">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Delete</button>
                    </form>
                </li>
                <hr>
            @endforeach
        </ul>
    @endif
</body>
</html>
