<?php

namespace App\Http\Controllers;

use App\Models\JamSession;
use App\Models\Venue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class JamSessionController extends Controller
{
    public function index(Request $request)
    {
        $query = JamSession::query()->with('venue');

        // Filters
        if ($request->filled('genre')) {
            $query->where('genre', 'like', '%' . $request->string('genre')->toString() . '%');
        }

        if ($request->filled('venue')) {
            $venueTerm = $request->string('venue')->toString();
            $query->whereHas('venue', function ($q) use ($venueTerm) {
                $q->where('name', 'like', '%' . $venueTerm . '%');
            });
        }

        if ($request->filled('from')) {
            $query->where('starts_at', '>=', $request->input('from'));
        }

        if ($request->filled('to')) {
            $query->where('starts_at', '<=', $request->input('to'));
        }

        // Sorting
        $allowedSorts = ['starts_at', 'title', 'genre', 'created_at'];
        $sort = $request->input('sort', 'starts_at');
        $direction = $request->input('direction', 'asc');

        if (!in_array($sort, $allowedSorts, true)) {
            $sort = 'starts_at';
        }
        if (!in_array($direction, ['asc', 'desc'], true)) {
            $direction = 'asc';
        }

        $sessions = $query->orderBy($sort, $direction)->get();

        return view('sessions.index', [
            'sessions' => $sessions,
            'filters' => [
                'genre' => $request->input('genre', ''),
                'venue' => $request->input('venue', ''),
                'from' => $request->input('from', ''),
                'to' => $request->input('to', ''),
                'sort' => $sort,
                'direction' => $direction,
            ],
        ]);
    }

    public function create()
    {
        return view('sessions.create');
    }

    public function store(Request $request)
    {
        $data = $this->validatedData($request);

        if (!$this->addressIsValidViaApi($data['venue_address'] ?? null)) {
            return back()
                ->withInput()
                ->withErrors(['venue_address' => 'Venue address could not be validated by the external API. Please enter a real address.']);
        }

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

        if (!$this->addressIsValidViaApi($data['venue_address'] ?? null)) {
            return back()
                ->withInput()
                ->withErrors(['venue_address' => 'Venue address could not be validated by the external API. Please enter a real address.']);
        }

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
            'venue_address' => ['required', 'string', 'max:255'],

            'title' => ['required', 'string', 'max:255'],
            'genre' => ['required', 'string', 'max:255'],
            'starts_at' => ['required', 'date'],
            'description' => ['nullable', 'string', 'max:1000'],
        ]);
    }

    private function addressIsValidViaApi(?string $address): bool
    {
        if (!$address) {
            return false;
        }

        try {
            $response = Http::withHeaders([
                'User-Agent' => 'JamSesh Laravel Student App',
            ])->get('https://nominatim.openstreetmap.org/search', [
                'q' => $address,
                'format' => 'json',
                'limit' => 1,
            ]);

            if (!$response->ok()) {
                return true;
            }

            $data = $response->json();
            return is_array($data) && count($data) > 0;
        } catch (\Throwable $e) {
            return true;
        }
    }
}
