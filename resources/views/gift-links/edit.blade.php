@extends('layouts.app')

@section('content')
<div class="py-6 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">
        <div class="bg-white rounded-lg shadow-sm p-6">
            <form action="{{ route('gift-links.update', [$person, $giftLink]) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="space-y-4">
                    <div>
                        <label for="link" class="block text-sm font-medium text-gray-700">Link do Presente</label>
                        <input type="url" name="link" id="link" value="{{ $giftLink->link }}" required 
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    </div>

                    <div>
                        <label for="observation" class="block text-sm font-medium text-gray-700">Observação</label>
                        <textarea name="observation" id="observation" rows="3" 
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">{{ $giftLink->observation }}</textarea>
                    </div>
                </div>

                <div class="mt-6 flex space-x-3">
                    <button type="submit" class="inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none">
                        Atualizar
                    </button>
                    <a href="{{ route('events.show', $person->event_id) }}" class="inline-flex justify-center rounded-md border border-gray-300 bg-white py-2 px-4 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50">
                        Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection