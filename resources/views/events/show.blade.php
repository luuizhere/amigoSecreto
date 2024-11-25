@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10 col-12">
            <div class="card shadow-sm border-light rounded">
                <div class="card-header bg-primary text-white text-center">
                    <h3>{{ $event->name }}</h3>
                </div>
                <div class="card-body">
                    <!-- <p><strong>Data de Criação:</strong> {{ $event->created_at->format('d/m/Y') }}</p>
                    <p><strong>Status:</strong> 
                        @if($event->status === 'Ativo')
                            <span class="badge bg-success">Ativo</span>
                        @else
                            <span class="badge bg-danger">Inativo</span>
                        @endif
                    </p> -->

                    <h4>Participantes:</h4>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nome</th>
                                <th>Idade</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($event->people as $person)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $person->name }}</td>
                                    <td>{{ $person->age }}</td>
                                    <td>
                                        <a href="{{ route('people.gifts', ['event' => $event->id, 'person' => $person->id]) }}" class="btn btn-info btn-sm">Ver Presentes</a>
                                        <a href="{{ route('people.edit', ['event' => $event->id, 'person' => $person->id]) }}" class="btn btn-warning btn-sm">Editar</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    
                    <a href="{{ route('people.create', $event->id) }}" class="btn btn-primary mt-3">Adicionar Participante</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
