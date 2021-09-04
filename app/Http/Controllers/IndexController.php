<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Equipamento;

class IndexController extends Controller
{

    public function index(Request $request){
        $locais = Equipamento::select('local')->distinct()->get(); # errado
        dd($locais);    # errado

        return view('index',[
           'locais' => $locais, 
        ]);
    }
}
