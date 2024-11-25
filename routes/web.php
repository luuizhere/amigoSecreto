<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\PersonController;

// Página inicial redireciona para a listagem de eventos
Route::get('/', function () {
    return redirect()->route('events.index');
});

// Rotas para eventos
Route::resource('events', EventController::class);
// Rota para editar pessoa
Route::get('events/{event}/people/{person}/edit', [PersonController::class, 'edit'])->name('people.edit');
Route::put('events/{event}/people/{person}', [PersonController::class, 'update'])->name('people.update');
// Rota para exibir os presentes de uma pessoa
Route::get('events/{event}/people/{person}/gifts', [PersonController::class, 'showGifts'])->name('people.gifts');



// Rotas para pessoas (relacionadas a eventos)
Route::prefix('events/{event}')->group(function () {
    Route::get('/people', [PersonController::class, 'index'])->name('people.index'); // Listar pessoas do evento
    Route::get('/people/create', [PersonController::class, 'create'])->name('people.create'); // Formulário para criar pessoa
    Route::post('/people', [PersonController::class, 'store'])->name('people.store'); // Salvar pessoa
    Route::get('/people/{person}', [PersonController::class, 'show'])->name('people.show'); // Exibir pessoa específica
    Route::get('/people/{person}/edit', [PersonController::class, 'edit'])->name('people.edit'); // Formulário para editar pessoa
    Route::put('/people/{person}', [PersonController::class, 'update'])->name('people.update'); // Atualizar pessoa
    Route::delete('/people/{person}', [PersonController::class, 'destroy'])->name('people.destroy'); // Remover pessoa
});