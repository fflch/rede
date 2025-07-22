@extends('main')

@section('content')
<div class="card">
    <div class="card-header bg-usp">
        <div class="d-flex justify-content-between align-items-center">
            <h1 class="h4 mb-0 text-dark"> 
                <i class="fas fa-building"></i> {{ $predio->nome }}
            </h1>
            @can('user')
            <div class="btn-group">
                <a href="/predios/{{ $predio->id }}/edit" class="btn btn-warning">
                    <i class="fas fa-edit"></i> Editar 
                </a>
                <form action="/predios/{{ $predio->id }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Tem certeza que deseja excluir este prédio?')">
                        <i class="fas fa-trash"></i> Excluir
                    </button>
                </form>
            </div>
            @endcan
        </div>
    </div>
    <div class="card-body">
        @if($predio->descricao)
        <p class="mb-4">{{ $predio->descricao }}</p>
        @endif

        <div class="row">
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-header bg-light d-flex justify-content-between align-items-center">
                        <h2 class="h5 mb-0">Racks</h2>
                        @can('user')
                        <a href="/racks/create?predio_id={{ $predio->id }}" class="btn btn-sm btn-success">
                            <i class="fas fa-plus"></i> Novo Rack
                        </a>
                        @endcan
                    </div>
                    
                    <div class="card-body">
                        @if($racks->isEmpty())
                            <div class="alert alert-info">Nenhum rack cadastrado.</div>
                        @else
                            <div class="list-group">
                                @foreach($racks as $rack)
                                <a href="/racks/{{ $rack->id }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                    {{ $rack->nome }}
                                </a>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-light d-flex justify-content-between align-items-center">
                        <h2 class="h5 mb-0">Salas</h2>
                        @can('user')
                        <a href="/salas/create?predio_id={{ $predio->id }}" class="btn btn-sm btn-success">
                            <i class="fas fa-plus"></i> Nova Sala
                        </a>
                        @endcan
                    </div>
                    <div class="card-body">
                        @if($salas->isEmpty())
                            <div class="alert alert-info">Nenhuma sala cadastrada.</div>
                        @else
                            <div class="list-group">
                                @foreach($salas as $sala)
                                <a href="/salas/{{ $sala->id }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                    {{ $sala->nome }}
                                </a>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>            
            <div class="mt-3">
                <a href="/" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Voltar
                </a>
            </div>
        </div>
    </div>
</div>
@endsection