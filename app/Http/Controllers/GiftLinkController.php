<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GiftLink;
use App\Models\People;

class GiftLinkController extends Controller
{
    public function store(Request $request, People $person)
    {
        $validated = $request->validate([
            'link' => 'required|url',
            'observation' => 'nullable|string',
        ]);
        
        $validated['link'] = $this->shortenUrl($validated['link']);
        $person->giftLinks()->create($validated);
        
        return redirect()->back()->with('success', 'Link adicionado com sucesso!');
    }

    public function destroy(People $person, GiftLink $giftLink)
    {
        $giftLink->delete();
        return redirect()->back()->with('success', 'Link de presente removido com sucesso!');
    }

    private function shortenUrl($url) {
        if (strlen($url) > 100) {
            // Usando TinyURL API
            $tiny = file_get_contents('https://tinyurl.com/api-create.php?url=' . urlencode($url));
            return $tiny ?: $url;
        }
        return $url;
    }

    public function edit(Person $person, GiftLink $giftLink)
    {
        return view('gift-links.edit', compact('person', 'giftLink'));
    }

    public function update(Request $request, Person $person, GiftLink $giftLink)
    {
        $validated = $request->validate([
            'link' => 'required|url',
            'observation' => 'nullable|string',
        ]);

        $validated['link'] = strlen($validated['link']) > 100 ? 
            file_get_contents('https://tinyurl.com/api-create.php?url=' . urlencode($validated['link'])) : 
            $validated['link'];

        $giftLink->update($validated);
        return redirect()->route('events.show', $person->event_id)->with('success', 'Link atualizado com sucesso!');
    }
}
