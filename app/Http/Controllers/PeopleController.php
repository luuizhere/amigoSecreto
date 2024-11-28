<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\People;
use App\Models\Event;

class PeopleController extends Controller
{
    public function store(Request $request, Event $event)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'age' => 'required|integer|min:1',
            'gender' => 'required|in:M,F,other',
        ]);

        $event->people()->create($validated);
        return redirect()->route('events.show', $event)->with('success', 'Participante adicionado com sucesso!');
    }

    public function destroy(Event $event, People $person)
    {
        $person->delete();
        return redirect()->route('events.show', $event)->with('success', 'Participante removido com sucesso!');
    }
}
