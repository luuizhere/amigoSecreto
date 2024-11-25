@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10 col-12">
            <div class="card shadow-sm border-light rounded">
                <div class="card-header bg-primary text-white text-center">
                    <h3>Criar Pessoa</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('people.store',$event) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Nome</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>

                        <div class="mb-3">
                            <label for="age" class="form-label">Idade</label>
                            <input type="number" class="form-control" id="age" name="age" required>
                        </div>

                        <div class="mb-3">
                            <label for="gender" class="form-label">Sexo</label>
                            <select class="form-select" id="gender" name="gender" required>
                                <option value="">Selecione...</option>
                                <option value="Masculino">Masculino</option>
                                <option value="Feminino">Feminino</option>
                                <option value="Outro">Outro</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="gift_links" class="form-label">Links dos Presentes</label>
                            <div id="link-container">
                                <div class="input-group mb-2">
                                    <input type="url" name="gift_links[]" class="form-control" placeholder="https://exemplo.com" required>
                                    <button type="button" class="btn btn-success btn-add-link" title="Adicionar Link">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">
                            <i class="fas fa-save"></i> Salvar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function () {
        // Adicionar campo de link
        $('#link-container').on('click', '.btn-add-link', function () {
            const newInputGroup = `
                <div class="input-group mb-2">
                    <input type="url" name="gift_links[]" class="form-control" placeholder="https://exemplo.com" required>
                    <button type="button" class="btn btn-danger btn-remove-link" title="Remover Link">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            `;
            $('#link-container').append(newInputGroup);
        });

        // Remover campo de link
        $('#link-container').on('click', '.btn-remove-link', function () {
            $(this).closest('.input-group').remove();
        });
    });
</script>
@endsection
