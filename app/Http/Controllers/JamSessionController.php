<?php

namespace App\Http\Controllers;

use App\Models\JamSession;
use App\Models\Venue;
use Illuminate\Http\Request;

class JamSessionController extends Controller
{
    public function index()
    {
        $sessions = JamSession::with('venue')
            ->orderBy('starts_at', 'asc')
            ->get();

        return view('sessions.index', compact('sessions'));
    }

    public function create()
    {
        return view('sessions.create');
    }

    public function store(Request $request)
    {
        $data = $this->validatedData($request);

        $venue = Venue::firstOrCreate(
            ['name' => $data['venue_name']],
            ['address' => $data['venue_address'] ?? null]
        );

        JamSession::create([
            'venue_id' => $venue->id,
            'title' => $data['title'],
            'genre' => $data['genre'],
            'starts_at' => $data['starts_at'],
            'description' => $data['description'] ?? null,
        ]);

        return redirect()->route('sessions.index')->with('success', 'Jam session added.');
    }

    public function show(JamSession $session)
    {
        $session->load('venue');
        return view('sessions.show', compact('session'));
    }

    public function edit(JamSession $session)
    {
        $session->load('venue');
        return view('sessions.edit', compact('session'));
    }

    public function update(Request $request, JamSession $session)
    {
        $data = $this->validatedData($request);

        $venue = Venue::firstOrCreate(
            ['name' => $data['venue_name']],
            ['address' => $data['venue_address'] ?? null]
        );

        $session->update([
            'venue_id' => $venue->id,
            'title' => $data['title'],
            'genre' => $data['genre'],
            'starts_at' => $data['starts_at'],
            'description' => $data['description'] ?? null,
        ]);

        return redirect()->route('sessions.show', $session)->with('success', 'Jam session updated.');
    }

    public function destroy(JamSession $session)
    {
        $session->delete();
        return redirect()->route('sessions.index')->with('success', 'Jam session deleted.');
    }

    private function validatedData(Request $request): array
    {
        return $request->validate([
            'venue_name' => ['required', 'string', 'max:255'],
            'venue_address' => ['nullable', 'string', 'max:255'],

            'title' => ['required', 'string', 'max:255'],
            'genre' => ['required', 'string', 'max:255'],
            'starts_at' => ['required', 'date'],
            'description' => ['nullable', 'string', 'max:1000'],
        ]);
    }
}
