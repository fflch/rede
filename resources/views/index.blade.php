@extends('main')

@section('content')
<div class="row mb-3">
    <div class="col">
        <h1>Prédios</h1>
    </div>
    @can('user')
        @include('partials.search')
        <div class="col text-end">
            <a href="/predios/create" class="btn btn-success">
                <i class="fas fa-plus"></i> Novo Prédio
            </a>
        </div>
    @endcan
</div>

@if($predios->isEmpty())
<div class="alert alert-info">Nenhum prédio cadastrado ainda.</div>
@else
<div class="card">
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <tbody>
                @foreach($predios as $predio)
                <tr class="clickable-row" onclick="window.location='/predios/{{ $predio->id }}'" style="cursor: pointer;">
                    <td>
                        <h5 class="mb-0">{{ $predio->nome }}</h5>
                        @if($predio->descricao)
                        <p class="text-muted mb-0">{{ $predio->descricao }}</p>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endif

@endsection