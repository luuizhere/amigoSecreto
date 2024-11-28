<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{EventController,PeopleController,GiftLinkController};

// Página inicial redireciona para a listagem de eventos
Route::get('/', function () {
    return redirect()->route('events.index');
});


Route::resource('events', EventController::class);

Route::post('events/{event}/people', [PeopleController::class, 'store'])->name('people.store');
Route::delete('events/{event}/people/{person}', [PeopleController::class, 'destroy'])->name('people.destroy');

Route::post('people/{person}/gift-links', [GiftLinkController::class, 'store'])->name('gift-links.store');
Route::delete('people/{person}/gift-links/{giftLink}', [GiftLinkController::class, 'destroy'])->name('gift-links.destroy');