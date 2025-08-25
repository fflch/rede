@extends('main')

@section('content')
<div class="card">
    <div class="card-header bg-usp">
        <h1 class="h4 mb-0 text-dark">
            Vincular Porta {{ $porta }} do Patch Panel: {{ $patchPanel->nome }}
            <small class="text-muted d-block">Rack: {{ $patchPanel->rack->nome }} - Prédio: {{ $patchPanel->rack->predio->nome }}</small>
        </h1>
    </div>
    <div class="card-body">
        <div class="list-group">
            @foreach($salasPredio as $sala)
            <form action="/patch-panels/{{ $patchPanel->id }}/vincular-sala" method="POST" class="list-group-item list-group-item-action p-0">
                @csrf
                <input type="hidden" name="sala_id" value="{{ $sala->id }}">
                <input type="hidden" name="porta" value="{{ $porta }}">
                <button type="submit" class="btn btn-link text-left w-100 text-decoration-none text-dark">
                    Local: {{ $sala->nome }}
                </button>
            </form>
            @endforeach
        </div>
        
        <div class="mt-3">
            <a href="/patch-panels/{{ $patchPanel->id }}" class="btn btn-secondary">Voltar</a>
        </div>
    </div>
</div>
@endsection