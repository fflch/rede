<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Mac;
use Uspdev\Utils\Generic;

class MacController extends Controller
{
    public function store(Request $request){
        if($request->header('Authorization') != env('authorization_key')){
            return response('Unauthorized action.', 403);
        }

        $request->validate([
            'snapshot_id' => 'required',
            'vlan' => 'required',
            'mac' => 'required',
        ]);

        $mac = new Mac;

        $mac->snapshot_id = $request->snapshot_id;
        $mac->vlan = $request->vlan;
        $mac->mac = Generic::format_mac(strtoupper($request->mac));
        $mac->save();

        return response()->json($mac);
    }
}
