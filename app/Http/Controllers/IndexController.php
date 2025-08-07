<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mac;
use Uspdev\Utils\Generic;
use App\Models\Predio;

use Illuminate\Support\Facades\Gate;

class IndexController extends Controller
{

    public function index(Request $request){

        //Gate::authorize('admin');

        /*
        if(isset($request->search)) {
            $this->authorize('user');
            $mac = strtoupper($request->search);
            $macs = Mac::where('mac','LIKE',"%{$mac}%")->paginate(30);
            return view('macs.index',[
                'macs' => $macs, 
            ]);
        }
        */

        return view('index');


    }
}
