@extends('main')

@section('content')
<div class="card">
    <div class="card-header bg-usp">
        <h1 class="h4 mb-0 text-dark">
            Selecionar Rack para Vincular Porta
            <small class="text-muted d-block">Local: {{ $sala->nome }} - Prédio: {{ $sala->predio->nome }}</small>
        </h1>
    </div>
    <div class="card-body">
        <div class="list-group">
            @foreach($racks as $rack)
            <a href="/salas/{{ $sala->id }}/selecionar-patchpanel/{{ $rack->id }}" class="list-group-item list-group-item-action">
                {{ $rack->nome }}
                <small class="text-muted float-right">{{ $rack->patchPanels->count() }} patch panels</small>
            </a>
            @endforeach
        </div>
        
        <div class="mt-3">
            <a href="/salas/{{ $sala->id }}" class="btn btn-secondary">Voltar</a>
        </div>
    </div>
</div>
@endsection