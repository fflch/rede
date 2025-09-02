@extends('main')

@section('content')
<div class="card">
    <div class="card-header bg-usp">
        <h1 class="h4 mb-0 text-dark">
            Editar Tipo de Porta - Porta {{ $porta }}
            <small class="text-muted d-block">Patch Panel: {{ $patchPanel->nome }} | Sala: {{ $sala->nome }}</small>
        </h1>
    </div>
    <div class="card-body">
        <form action="/patch-panels/{{ $patchPanel->id }}/atualizar-tipo-porta/{{ $sala->id }}" method="POST">
            @csrf
            @method('PUT')
            <input type="hidden" name="porta" value="{{ $porta }}">
            
            <div class="form-group">
                <label for="tipo_porta_id">Tipo de Porta:</label>
                <select class="form-control" name="tipo_porta_id" id="tipo_porta_id">
                    <option value="">-- Não informar tipo --</option>
                    @foreach($tipoPortas as $tipoPorta)
                        <option value="{{ $tipoPorta->id }}" {{ $tipoPortaAtual == $tipoPorta->id ? 'selected' : '' }}>
                            {{ $tipoPorta->nome }}
                        </option>
                    @endforeach
                </select>
            </div>
            
            <div class="mt-3">
                <button type="submit" class="btn btn-primary">Atualizar Tipo de Porta</button>
                <a href="/patch-panels/{{ $patchPanel->id }}" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
</div>
@endsection