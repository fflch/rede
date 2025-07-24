@extends('main')

@section('content')
<div class="card">
    <div class="card-header bg-usp">
        <div class="d-flex justify-content-between align-items-center">
            <h1 class="h4 mb-0 text-dark">
                <i class="fas fa-network-wired"></i> Patch Panel: {{ $patchPanel->nome }}
                <small class="text-muted d-block">
                    Rack: {{ $patchPanel->rack->nome }} | Prédio: {{ $patchPanel->rack->predio->nome }} | Portas: {{ $patchPanel->qtde_portas }}
                </small>
            </h1>
            @can('user')
            <div class="btn-group">
                <a href="/patch-panels/{{ $patchPanel->id }}/edit" class="btn btn-warning">
                    <i class="fas fa-edit"></i> Editar
                </a>
                <form action="/patch-panels/{{ $patchPanel->id }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Tem certeza que deseja excluir este patch panel?')">
                        <i class="fas fa-trash"></i> Excluir
                    </button>
                </form>
            </div>
            @endcan
        </div>
    </div>

    <div class="card-body">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4>Portas Vinculadas</h4>
                @can('user')
                    <a href="/patch-panels/{{ $patchPanel->id }}/selecionar-sala" class="btn btn-success btn-sm">
                        <i class="fas fa-plus"></i> Vincular Porta
                    </a>
                @endcan
            </div>
            <div class="card-body">
                @if($patchPanel->salas->isNotEmpty())
                    <ul class="list-group">
                        @foreach($patchPanel->salas as $sala)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Porta {{ $sala->pivot->porta }} → Sala {{ $sala->nome }}
                                @can('user')
                                    <form action="/patch-panels/{{ $patchPanel->id }}/desvincular-sala/{{ $sala->id }}?porta={{ $sala->pivot->porta }}" method="POST">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza que deseja desvincular esta porta?')">
                                            <i class="fas fa-unlink"></i> Desvincular
                                        </button>
                                    </form>
                                @endcan
                            </li>
                        @endforeach
                    </ul>
                @else
                    <div class="alert alert-info mb-0">Nenhuma porta vinculada a este patch panel</div>
                @endif
            </div>
        </div>
        <a href="/racks/{{ $patchPanel->rack->id }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Voltar
        </a>
    </div>
</div>
@endsection