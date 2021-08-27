<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SnapshotController extends Controller
{
    public function snapshot(Request $request){

        if($request->header('Authorization') != env('authorization_key')){
            return response('Unauthorized action.', 403);
        }

        return response('teste')->header('Content-Type', 'text/plain');

    }
}
