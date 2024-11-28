<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::with('people')->latest()->get();
        return view('events.index', compact('events'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'event_date' => 'required|date',
            'status' => 'required|in:active,inactive',
        ]);

        Event::create($validated);
        return redirect()->route('events.index')->with('success', 'Evento criado com sucesso!');
    }

    public function show(Event $event)
    {
        $event->load('people.giftLinks');
        return view('events.show', compact('event'));
    }

    public function update(Request $request, Event $event)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'event_date' => 'required|date',
            'status' => 'required|in:active,inactive',
        ]);

        $event->update($validated);
        return redirect()->route('events.show', $event)->with('success', 'Evento atualizado com sucesso!');
    }
}