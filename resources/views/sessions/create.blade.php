@extends('layouts.app')

@section('title', 'Add Jam Session')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="mb-0">Add Jam Session</h1>
        <a class="btn btn-outline-secondary" href="{{ route('sessions.index') }}">Back</a>
    </div>

    <form method="POST" action="{{ route('sessions.store') }}" class="card p-3">
        @csrf

        <h5 class="mb-3">Venue</h5>

        <div class="mb-3">
            <label class="form-label">Venue name</label>
            <input class="form-control" type="text" name="venue_name" value="{{ old('venue_name') }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Venue address</label>
            <input class="form-control" type="text" name="venue_address" value="{{ old('venue_address') }}">
            <div class="form-text">This address is checked using an external validation API.</div>
        </div>

        <hr>

        <h5 class="mb-3">Session</h5>

        <div class="mb-3">
            <label class="form-label">Title</label>
            <input class="form-control" type="text" name="title" value="{{ old('title') }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Genre</label>
            <input class="form-control" type="text" name="genre" value="{{ old('genre') }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Starts at</label>
            <input class="form-control" type="datetime-local" name="starts_at" value="{{ old('starts_at') }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea class="form-control" name="description" rows="4">{{ old('description') }}</textarea>
        </div>

        <button class="btn btn-primary" type="submit">Create</button>
    </form>
@endsection
