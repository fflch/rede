@extends('main')

@section('content')
<div class="card">
    <div class="card-header">
        <h1>Editar Tipo de Porta: {{ $tipoPorta->nome }}</h1>
    </div>
    <div class="card-body">
        <form action="/tipo-portas/{{ $tipoPorta->id }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="mb-3">
                <label for="nome" class="form-label">Nome *</label>
                <input type="text" class="form-control" id="nome" name="nome" value="{{ $tipoPorta->nome }}">
            </div>
            
            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-success">Atualizar</button>
                <a href="/tipo-portas" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
</div>
@endsection