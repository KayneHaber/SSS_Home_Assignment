@extends('layouts.app')

@section('title', 'Edit Jam Session')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="mb-0">Edit Jam Session</h1>
        <a class="btn btn-outline-secondary" href="{{ route('sessions.show', $session) }}">Back</a>
    </div>

    <form method="POST" action="{{ route('sessions.update', $session) }}" class="card p-3">
        @csrf
        @method('PUT')

        <h5 class="mb-3">Venue</h5>

        <div class="mb-3">
            <label class="form-label">Venue name</label>
            <input class="form-control" type="text" name="venue_name" value="{{ old('venue_name', $session->venue->name ?? '') }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Venue address</label>
            <input class="form-control" type="text" name="venue_address" value="{{ old('venue_address', $session->venue->address ?? '') }}">
            <div class="form-text">This address is checked using an external validation API.</div>
        </div>

        <hr>

        <h5 class="mb-3">Session</h5>

        <div class="mb-3">
            <label class="form-label">Title</label>
            <input class="form-control" type="text" name="title" value="{{ old('title', $session->title) }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Genre</label>
            <input class="form-control" type="text" name="genre" value="{{ old('genre', $session->genre) }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Starts at</label>
            <input class="form-control" type="datetime-local" name="starts_at" value="{{ old('starts_at', \Carbon\Carbon::parse($session->starts_at)->format('Y-m-d\TH:i')) }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea class="form-control" name="description" rows="4">{{ old('description', $session->description) }}</textarea>
        </div>

        <button class="btn btn-primary" type="submit">Save</button>
    </form>
@endsection
