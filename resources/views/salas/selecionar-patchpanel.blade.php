@extends('main')

@section('content')
<div class="card">
    <div class="card-header bg-usp">
        <h1 class="h4 mb-0 text-dark">
            Vincular Porta da Sala: {{ $sala->nome }}
            <small class="text-muted d-block">Rack: {{ $rack->nome }} - Prédio: {{ $sala->predio->nome }}</small>
        </h1>
    </div>
    <div class="card-body">
        @if($patchPanels->isEmpty())
            <div class="alert alert-info">Nenhum patch panel disponível neste rack.</div>
        @else
            <form action="/salas/{{ $sala->id }}/vincular-patchpanel" method="POST">
                @csrf
                <input type="hidden" name="rack_id" value="{{ $rack->id }}">
                
                <div class="form-group">
                    <label>Patch Panel</label>
                    <select name="patch_panel_id" class="form-control" required>
                        @foreach($patchPanels as $pp)
                            <option value="{{ $pp->id }}">{{ $pp->nome }}</option>
                        @endforeach
                    </select>
                </div>
                
                <div class="form-group">
                    <label>Número da Porta</label>
                    <input type="number" name="porta" class="form-control" min="1" required>
                </div>
                
                <div class="d-flex justify-content-between">
                    <a href="/salas/{{ $sala->id }}/selecionar-rack" class="btn btn-secondary">Voltar</a>
                    <button type="submit" class="btn btn-primary">Vincular</button>
                </div>
            </form>
        @endif
    </div>
</div>
@endsection