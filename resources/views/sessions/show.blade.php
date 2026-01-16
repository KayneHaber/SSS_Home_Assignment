@extends('layouts.app')

@section('title', 'View Jam Session')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="mb-0">View Jam Session</h1>
        <a class="btn btn-outline-secondary" href="{{ route('sessions.index') }}">Back</a>
    </div>

    <div class="card p-3">
        <h3 class="mb-2">{{ $session->title }}</h3>

        <p class="mb-1"><strong>Genre:</strong> {{ $session->genre }}</p>
        <p class="mb-1"><strong>Starts:</strong> {{ \Carbon\Carbon::parse($session->starts_at)->format('d M Y, H:i') }}</p>
        <p class="mb-1"><strong>Venue:</strong> {{ $session->venue->name ?? 'N/A' }}</p>

        @if (!empty($session->venue?->address))
            <p class="mb-1"><strong>Venue address:</strong> {{ $session->venue->address }}</p>
        @endif

        @if (!empty($session->description))
            <p class="mb-0"><strong>Description:</strong><br>{{ $session->description }}</p>
        @endif

        <div class="d-flex gap-2 mt-3">
            <a class="btn btn-outline-primary" href="{{ route('sessions.edit', $session) }}">Edit</a>

            <form method="POST" action="{{ route('sessions.destroy', $session) }}">
                @csrf
                @method('DELETE')
                <button class="btn btn-outline-danger" type="submit">Delete</button>
            </form>
        </div>
    </div>
@endsection
