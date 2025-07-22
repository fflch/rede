<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Predio;
use App\Http\Requests\PredioRequest;

class PredioController extends Controller
{
    public function create()
    {
        return view('predios.create');
    }

    public function store(PredioRequest $request)
    {
        Predio::create($request->validated());

        return redirect('/');
    }

    public function show(Predio $predio)
    {
        return view('predios.show', [
            'predio' => $predio,
            'racks' => $predio->racks,
            'salas' => $predio->salas,
        ]);
    }

    public function edit(Predio $predio)
    {
        return view('predios.edit', ['predio' => $predio]);
    }

    public function update(PredioRequest $request, Predio $predio)
    {
        $predio->update($request->validated());

        return redirect('/');
    }

    public function destroy(Predio $predio)
    {
        $predio->delete();
        
        return redirect('/');
    }
}
