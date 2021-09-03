<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Equipamento;

class EquipamentoController extends Controller
{
    public function store(Request $request){
        if($request->header('Authorization') != env('authorization_key')){
            return response('Unauthorized action.', 403);
        }

        $request->validate([
            'hostname' => 'required',
            'model' => 'required',
            'ip' => 'required',
            'poe_type' => 'required',
            'local' => 'required',
            'position' => 'required',

        ]);


        # uplink_extra_ports,rep_ports,printer_ports,ignore_ports

        $equipamento = Equipamento::where('hostname',$request->hostname)->first();
        if(!$equipamento) $equipamento = new Equipamento;

        $equipamento->hostname = $request->hostname;
        $equipamento->model = $request->model;
        $equipamento->poe_type = $request->poe_type;
        $equipamento->ip = $request->ip;
        $equipamento->local = $request->local;
        $equipamento->position = $request->position;
        $equipamento->save();

        return response()->json($equipamento);
    }   
}
