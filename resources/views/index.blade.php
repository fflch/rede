@extends('main')

@section('content')

@can('user')
    @include('partials.search')
    <br>
@endcan


@foreach($locais as $local=>$positions)
    <div class="row">
        <div class="col col-sm text-center">
            <h3>Prédio: {{ $local }} </h3>
        </div>
        
    </div>
    <div class="row">
        @foreach($positions->groupBy('position') as $position=>$equipamentos)
            <div class="col col-sm">
                <b>{{ $position }}</b>
                <ul class="list-group">
                    @foreach($equipamentos as $equipamento)
                        <li class="list-group-item">
                            @can('user') 
                                <a href="/equipamentos/{{ $equipamento->id }}">{{ $equipamento->hostname }}</a>
                            @else 
                                {{ $equipamento->hostname }}
                            @endcan
                        </li>
                    @endforeach
                </ul>
            </div>
        @endforeach
    </div>
    <br><br>
@endforeach

@endsection