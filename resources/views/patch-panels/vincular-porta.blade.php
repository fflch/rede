@extends('main')

@section('content')
<div class="card">
    <div class="card-header bg-usp">
        <h1 class="h4 mb-0 text-dark">
            Vincular Porta do Patch Panel: {{ $patchPanel->nome }}
            <small class="text-muted d-block">Sala: {{ $sala->nome }} - Prédio: {{ $sala->predio->nome }}</small>
        </h1>
    </div>
    <div class="card-body">
        <form action="/patch-panels/{{ $patchPanel->id }}/vincular-sala" method="POST">
            @csrf
            <input type="hidden" name="sala_id" value="{{ $sala->id }}">
            
            <div class="form-group">
                <label>Número da Porta</label>
                <input type="number" name="porta" class="form-control" min="1" max="{{ $patchPanel->qtde_portas }}" required>
            </div>
            
            <div class="d-flex justify-content-between mt-3">
                <a href="/patch-panels/{{ $patchPanel->id }}/selecionar-sala" class="btn btn-secondary">Voltar</a>
                <button type="submit" class="btn btn-primary">Vincular</button>
            </div>
        </form>
    </div>
</div>
@endsection