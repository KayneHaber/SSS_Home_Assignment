@extends('layouts.app')

@section('title', 'Jam Sessions')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="mb-0">Jam Sessions</h1>
        <a class="btn btn-primary" href="{{ route('sessions.create') }}">Add Jam Session</a>
    </div>

    <form method="GET" action="{{ route('sessions.index') }}" class="card p-3 mb-3">
        <div class="row g-3">
            <div class="col-md-3">
                <label class="form-label">Genre contains</label>
                <input class="form-control" type="text" name="genre" value="{{ $filters['genre'] }}">
            </div>

            <div class="col-md-3">
                <label class="form-label">Venue contains</label>
                <input class="form-control" type="text" name="venue" value="{{ $filters['venue'] }}">
            </div>

            <div class="col-md-3">
                <label class="form-label">From (starts at)</label>
                <input class="form-control" type="datetime-local" name="from" value="{{ $filters['from'] }}">
            </div>

            <div class="col-md-3">
                <label class="form-label">To (starts at)</label>
                <input class="form-control" type="datetime-local" name="to" value="{{ $filters['to'] }}">
            </div>

            <div class="col-md-3">
                <label class="form-label">Sort by</label>
                <select class="form-select" name="sort">
                    <option value="starts_at" @selected($filters['sort'] === 'starts_at')>Start time</option>
                    <option value="title" @selected($filters['sort'] === 'title')>Title</option>
                    <option value="genre" @selected($filters['sort'] === 'genre')>Genre</option>
                    <option value="created_at" @selected($filters['sort'] === 'created_at')>Created date</option>
                </select>
            </div>

            <div class="col-md-3">
                <label class="form-label">Direction</label>
                <select class="form-select" name="direction">
                    <option value="asc" @selected($filters['direction'] === 'asc')>Ascending</option>
                    <option value="desc" @selected($filters['direction'] === 'desc')>Descending</option>
                </select>
            </div>

            <div class="col-md-6 d-flex align-items-end gap-2">
                <button class="btn btn-dark" type="submit">Apply</button>
                <a class="btn btn-outline-secondary" href="{{ route('sessions.index') }}">Reset</a>
            </div>
        </div>
    </form>

    @include('sessions._list', ['sessions' => $sessions])
@endsection
