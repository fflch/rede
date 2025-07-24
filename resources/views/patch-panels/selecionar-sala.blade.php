@extends('main')

@section('content')
<div class="card">
    <div class="card-header bg-usp">
        <h1 class="h4 mb-0 text-dark">
            Vincular Porta do Patch Panel: {{ $patchPanel->nome }}
            <small class="text-muted d-block">Rack: {{ $patchPanel->rack->nome }} - Prédio: {{ $patchPanel->rack->predio->nome }}</small>
        </h1>
    </div>
    <div class="card-body">
        <div class="list-group">
            @foreach($salasPredio as $sala)
            <a href="/patch-panels/{{ $patchPanel->id }}/vincular-porta/{{ $sala->id }}" class="list-group-item list-group-item-action">
                Sala {{ $sala->nome }}
            </a>
            @endforeach
        </div>
        
        <div class="mt-3">
            <a href="/patch-panels/{{ $patchPanel->id }}" class="btn btn-secondary">Voltar</a>
        </div>
    </div>
</div>
@endsection