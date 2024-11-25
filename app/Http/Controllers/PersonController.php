<?php

// app/Http/Controllers/PersonController.php

namespace App\Http\Controllers;

use App\Models\Person;
use App\Models\Event;
use Illuminate\Http\Request;

class PersonController extends Controller
{
    // Exibe o formulário para criar uma nova pessoa associada a um evento
    public function create(Event $event)
    {
        return view('people.create', compact('event'));
    }

    // Armazena a nova pessoa
    public function store(Request $request, Event $event)
    {
      
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'age' => 'required|integer|min:0',
            'gender' => 'required|string|in:Masculino,Feminino,Outro',
            'gift_links' => 'nullable|array',
            'gift_links.*' => 'nullable|url',
        ]);
        // dd($request->all(),$event);
        $validated['event_id'] = $event->id; // Associa o evento
        Person::create($validated);

        return redirect()->route('events.show', $event)->with('success', 'Pessoa adicionada com sucesso!');
    }


    // Exibe os detalhes de uma pessoa
    public function show(Person $person)
    {
        return view('people.show', compact('person'));
    }

    public function edit(Event $event, Person $person)
    {
        return view('people.edit', compact('event', 'person'));
    }

    public function update(Request $request, Event $event, Person $person)
    {
        // Validar os links de presentes
        $request->validate([
            'gift_links' => 'nullable|array',
            'gift_links.*' => 'nullable|url', // Garantir que cada link seja uma URL válida
        ]);

        // Atualizar os dados da pessoa
        $person->update([
            'name' => $request->name,
            'age' => $request->age,
            'gender' => $request->gender,
            'gift_links' => $request->gift_links, // Atualizar os links de presente
        ]);

        return redirect()->route('events.show', $event->id)->with('success', 'Participante atualizado com sucesso!');
    }

    public function showGifts($eventId, $personId)
    {
        $event = Event::findOrFail($eventId);
        $person = Person::findOrFail($personId);

        return view('people.gifts', compact('event', 'person'));
    }

}
