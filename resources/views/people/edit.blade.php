@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10 col-12">
            <div class="card shadow-sm border-light rounded">
                <div class="card-header bg-primary text-white text-center">
                    <h3>Editar Participante: {{ $person->name }}</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('people.update', ['event' => $event->id, 'person' => $person->id]) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="name" class="form-label">Nome</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ $person->name }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="age" class="form-label">Idade</label>
                            <input type="number" name="age" id="age" class="form-control" value="{{ $person->age }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="gender" class="form-label">Sexo</label>
                            <select name="gender" id="gender" class="form-select" required>
                                <option value="Masculino" {{ $person->gender == 'Masculino' ? 'selected' : '' }}>Masculino</option>
                                <option value="Feminino" {{ $person->gender == 'Feminino' ? 'selected' : '' }}>Feminino</option>
                                <option value="Outro" {{ $person->gender == 'Outro' ? 'selected' : '' }}>Outro</option>
                            </select>
                        </div>

                        <!-- Links de presentes -->
                        <div class="mb-3">
                            <label for="gift_links" class="form-label">Links de Presentes</label>
                            <div id="gift-links-container">
                                @foreach($person->gift_links as $index => $link)
                                    <div class="gift-link-input mb-2">
                                        <input type="url" name="gift_links[]" class="form-control" value="{{ $link }}" placeholder="Insira o link do presente" required>
                                        <button type="button" class="btn btn-danger btn-remove-link" style="margin-top: 5px;">Remover</button>
                                    </div>
                                @endforeach
                                <div id="gift-links-container">
                                    <!-- Aqui os links serão adicionados dinamicamente -->
                                </div>
                            </div>
                            <button type="button" class="btn btn-success" id="add-link">Adicionar Link</button>
                        </div>

                        <button type="submit" class="btn btn-primary">Salvar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#add-link').click(function() {
            const newLinkInput = `
                <div class="gift-link-input mb-2">
                    <input type="url" name="gift_links[]" class="form-control" placeholder="Insira o link do presente" required>
                    <button type="button" class="btn btn-danger btn-remove-link" style="margin-top: 5px;">Remover</button>
                </div>
            `;
            $('#gift-links-container').append(newLinkInput);
        });

        $(document).on('click', '.btn-remove-link', function() {
            $(this).parent().remove();
        });
    });
</script>
@endsection
