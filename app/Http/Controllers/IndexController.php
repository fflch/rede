<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Equipamento;
use App\Models\Mac;

class IndexController extends Controller
{

    public function index(Request $request){

        if(isset($request->search)) {
            $macs = Mac::where('mac','LIKE',"%{$request->search}%")->paginate(30);
            return view('macs.index',[
                'macs' => $macs, 
            ]);
        }

        $locais = Equipamento::all()->groupBy('local');

        return view('index',[
           'locais' => $locais, 
        ]);
    }
}
