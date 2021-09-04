<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Porta;

class PortaController extends Controller
{
    public function store(Request $request){
        if($request->header('Authorization') != env('authorization_key')){
            return response('Unauthorized action.', 403);
        }

        $request->validate([
            'porta' => 'required',
            'equipamento_id' => 'required',
        ]);

        $porta = Porta::where('porta',$request->porta)
                       ->where('equipamento_id',$request->equipamento_id)->first();

        if(!$porta) $porta = new Porta;

        $porta->porta = $request->porta;
        $porta->equipamento_id = $request->equipamento_id;
        $porta->save();

        return response()->json($porta);
    } 
}
