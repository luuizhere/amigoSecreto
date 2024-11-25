<?php

// app/Http/Controllers/EventController.php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    // Exibe todos os eventos
    public function index()
    {
        $events = Event::all();
        return view('events.index', compact('events'));
    }

    // Mostra o formulário para criar um novo evento
    public function create()
    {
        return view('events.create');
    }

    // Armazena o novo evento
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'date' => 'required|date',
            'status' => 'required|in:Ativo,Inativo',
        ]);

        Event::create($request->all());

        return redirect()->route('events.index')->with('success', 'Evento criado com sucesso!');
    }

    // Exibe os detalhes de um evento específico
    public function show($id)
{
    $event = Event::with('people')->findOrFail($id);
    return view('events.show', compact('event'));
}

    // Exibe o formulário para editar um evento
    public function edit(Event $event)
    {
        return view('events.edit', compact('event'));
    }

    // Atualiza os dados de um evento
    public function update(Request $request, Event $event)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'date' => 'required|date',
            'status' => 'required|in:Ativo,Inativo',
        ]);

        $event->update($request->all());

        return redirect()->route('events.index')->with('success', 'Evento atualizado com sucesso!');
    }

    // Exclui um evento
    public function destroy(Event $event)
    {
        $event->delete();
        return redirect()->route('events.index')->with('success', 'Evento excluído com sucesso!');
    }
}
