@extends('main')

@section('content')

@foreach($locais as $equipamentos)
    @foreach($equipamentos as $equipamento)
        {{ $equipamento->hostname }} <br>
    @endforeach
@endforeach

@endsection