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
            'observation' => 'nullable|string|max:500',
        ]);

        $person->giftLinks()->create($validated);
        return redirect()->back()->with('success', 'Link de presente adicionado com sucesso!');
    }

    public function destroy(People $person, GiftLink $giftLink)
    {
        $giftLink->delete();
        return redirect()->back()->with('success', 'Link de presente removido com sucesso!');
    }
}
