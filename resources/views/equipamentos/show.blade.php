@extends('main')

@section('content')

<div class="row">
    <div class="col col-lg-3">
        <ul class="list-group">
            <li class="list-group-item"> patrimônio: {{ $equipamento->hostname }}</li>
            <li class="list-group-item"> ip: {{ $equipamento->ip }}</li>
            <li class="list-group-item"> <b>tipo: {{ $equipamento->poe_type }}</b></li>
            <li class="list-group-item"> portas trunk: {{ $equipamento->uplink_extra_ports }}</li>
            <li class="list-group-item"> portas rep: {{ $equipamento->rep_ports }}</li>
            <li class="list-group-item"> portas impressoras: {{ $equipamento->printer_ports }}</li>
            <li class="list-group-item"> portas exceção: {{ $equipamento->ignore_ports }}</li>
        </ul>    
    </div>

    <div class="col">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Porta</th>
                    <th scope="col">MacAddress - Vlan</th>
                    <th scope="col">Status</th>
                    <th scope="col">Coletado em</th>
                </tr>
            </thead>
            <tbody>
                @foreach($equipamento->portas as $porta)
                <tr>
                    <td> {{ $porta->porta }} </td>

                    @if($porta->latest_snapshot)
                        <td>
                            @foreach($porta->latest_snapshot->macs as $mac)
                            {{ $mac->mac }} - {{ $mac->vlan }} <br>
                            @endforeach
                        </td>

                        <td> {{ $porta->latest_snapshot->status }} </td>
                        <td> {{ $porta->latest_snapshot->coletado_em }} </td>
                    @else 
                        <td></td><td></td><td></td>
                    @endif
                </tr>
                @endforeach
                
            </tbody>
        </table>
    </div>
</div>
@endsection