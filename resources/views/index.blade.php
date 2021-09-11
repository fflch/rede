@extends('main')

@section('content')

@include('partials.search')
<br>

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
                            <a href="/equipamentos/{{ $equipamento->id }}">{{ $equipamento->hostname }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endforeach
    </div>
    <br><br>
@endforeach

@endsection