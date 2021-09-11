@extends('main')

@section('content')
@include('partials.search')

<br>

{{ $macs->appends(request()->query())->links() }}
<ul class="list-group">
    @foreach($macs->sortByDesc('created_at') as $mac)
        <li class="list-group-item">
            {{ $mac->mac }} -
            {{ $mac->snapshot->coletado_em }} -
            <a href="/equipamentos/{{ $mac->snapshot->porta->equipamento->id }}">
                {{ $mac->snapshot->porta->equipamento->hostname }}
            </a> -
            {{ $mac->snapshot->porta->porta }} -
            vlan: {{ $mac->vlan }}
        </li>
    @endforeach
</ul>
{{ $macs->appends(request()->query())->links() }}

@endsection