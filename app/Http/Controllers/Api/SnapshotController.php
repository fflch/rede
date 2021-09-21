<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Snapshot;

class SnapshotController extends Controller
{
    public function store(Request $request){
        if($request->header('Authorization') != env('authorization_key')){
            return response('Unauthorized action.', 403);
        }

        $request->validate([
            'porta_id' => 'required',
            'status' => 'required',
        ]);

        $snapshot = new Snapshot;

        $snapshot->porta_id = $request->porta_id;
        $snapshot->status = $request->status;
        $snapshot->save();

        return response()->json($snapshot);
    }
}
