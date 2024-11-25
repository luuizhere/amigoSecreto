@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10 col-12">
            <div class="card shadow-sm border-light rounded">
                <div class="card-header bg-primary text-white text-center">
                    <h3>Presentes de {{ $person->name }}</h3>
                </div>
                <div class="card-body">
                    <h4>Links de Presentes</h4>
                    <ul class="list-group">
                        @foreach($person->gift_links as $link)
                            <li class="list-group-item">
                                <a href="{{ $link }}" target="_blank">{{ $link }}</a>
                            </li>
                        @endforeach
                    </ul>
                    <a href="{{ route('people.edit', ['event' => $event->id, 'person' => $person->id]) }}" class="btn btn-warning btn-sm mt-3">
                        Editar Presentes
                    </a>
                    <a href="{{ route('events.show', $event->id) }}" class="btn btn-secondary btn-sm mt-3">Voltar ao Evento</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
