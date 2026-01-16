@if ($sessions->isEmpty())
    <div class="alert alert-info mb-0">No jam sessions match your filters.</div>
@else
    <div class="list-group">
        @foreach ($sessions as $s)
            <div class="list-group-item">
                <div class="d-flex justify-content-between align-items-start gap-3">
                    <div>
                        <h5 class="mb-1">{{ $s->title }}</h5>
                        <div class="text-muted small">
                            Genre: {{ $s->genre }},
                            Starts: {{ \Carbon\Carbon::parse($s->starts_at)->format('d M Y, H:i') }},
                            Venue: {{ $s->venue->name ?? 'N/A' }}
                        </div>
                    </div>

                    <div class="d-flex gap-2">
                        <a class="btn btn-outline-secondary btn-sm" href="{{ route('sessions.show', $s) }}">View</a>
                        <a class="btn btn-outline-primary btn-sm" href="{{ route('sessions.edit', $s) }}">Edit</a>

                        <form method="POST" action="{{ route('sessions.destroy', $s) }}">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-outline-danger btn-sm" type="submit">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endif
