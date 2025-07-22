@extends('main')

@section('content')
<div class="card">
    <div class="card-header bg-usp">
        <div class="d-flex justify-content-between align-items-center">
            <h1 class="h4 mb-0 text-dark">
                <i class="fas fa-server"></i> Rack: {{ $rack->nome }}
                <small class="text-muted d-block">{{ $rack->predio->nome }}</small>
            </h1>
            @can('user')
            <div class="btn-group">
                <a href="/racks/{{ $rack->id }}/edit" class="btn btn-warning">
                    <i class="fas fa-edit"></i> Editar
                </a>
                <form action="/racks/{{ $rack->id }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Tem certeza que deseja excluir este rack? Todos os patch panels vinculados serão excluídos.')">
                        <i class="fas fa-trash"></i> Excluir
                    </button>
                </form>
            </div>
            @endcan
        </div>
    </div>

    <div class="card-body">
        <div class="row">

            <div class="col-12 mb-4">
                <div class="card">
                    <div class="card-header bg-light d-flex justify-content-between align-items-center">
                        <h2 class="h5 mb-0">Equipamentos</h2>
                        @can('user')
                        <a href="/equipamentos/create" class="btn btn-sm btn-success">
                            <i class="fas fa-plus"></i> Novo Equipamento
                        </a>
                        @endcan
                    </div>
                    <div class="card-body">
                        @if($equipamentos->isEmpty())
                        <div class="alert alert-info">Nenhum equipamento cadastrado neste rack.</div>
                        @else
                        <div class="list-group">
                            @foreach($equipamentos as $equipamento)
                            <a href="/equipamentos/{{ $equipamento->id }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                {{ $equipamento->hostname }}
                                <span class="badge bg-secondary">{{ $equipamento->model }}</span>
                            </a>
                            @endforeach
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-light d-flex justify-content-between align-items-center">
                        <h2 class="h5 mb-0">Patch Panels</h2>
                        @can('user')
                        <a href="/patch-panels/create?rack_id={{ $rack->id }}" class="btn btn-sm btn-success">
                            <i class="fas fa-plus"></i> Novo Patch Panel
                        </a>
                        @endcan
                    </div>
                    <div class="card-body">
                        @if($patchPanels->isEmpty())
                        <div class="alert alert-info">Nenhum patch panel cadastrado neste rack.</div>
                        @else
                        <div class="list-group">
                            @foreach($patchPanels as $patchPanel)
                            <a href="/patch-panels/{{ $patchPanel->id }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                {{ $patchPanel->nome }}
                                <span class="badge bg-primary">{{ $patchPanel->qtde_portas }} portas</span>
                            </a>
                            @endforeach
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-3">
            <a href="/predios/{{ $rack->predio->id }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Voltar
            </a>
        </div>
    </div>
</div>
@endsection