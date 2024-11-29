<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GiftLink;
use App\Models\People;

class GiftLinkController extends Controller
{
    public function store(Request $request, Person $person)
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
}
