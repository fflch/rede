@extends('main')

@section('content')
<div class="card">
    <div class="card-header">
        <h1>Editar Sala: {{ $sala->nome }}</h1>
    </div>
    <div class="card-body">
        <form action="/salas/{{ $sala->id }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="mb-3">
                <label for="predio_id" class="form-label">Prédio *</label>
                <select class="form-select" id="predio_id" name="predio_id" required>
                    @foreach($predios as $predio)
                        <option value="{{ $predio->id }}" {{ $sala->predio_id == $predio->id ? 'selected' : '' }}>
                            {{ $predio->nome }}
                        </option>
                    @endforeach
                </select>
            </div>
            
            <div class="mb-3">
                <label for="nome" class="form-label">Nome/Número da Sala *</label>
                <input type="text" class="form-control" id="nome" name="nome" value="{{ $sala->nome }}">
            </div>
            
            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-success">Atualizar</button>
                <a href="{{ url()->previous() }}" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
</div>
@endsection