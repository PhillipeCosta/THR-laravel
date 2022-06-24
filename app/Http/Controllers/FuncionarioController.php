<?php

namespace App\Http\Controllers;

use App\Models\{Funcionario, FaixaSalarial, Lotacao, FaixaEtaria, Jornada};
use App\Http\Requests\{StoreRequest, UpdateRequest};
use Illuminate\Support\Facades\{Redirect,Request};
use Inertia\Inertia;

class FuncionarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Funcionario/Index', [
            'items' => Funcionario::latest()
                ->with('lotacao')
                ->with('jornada')
                ->with('faixa_salarial')
                ->with('faixa_etaria')
                ->paginate(10)
                ->withQueryString()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Funcionario/Store', [
            'faixa_salarial' => FaixaSalarial::get(),
            'faixa_etaria' => FaixaEtaria::get(),
            'lotacao' => Lotacao::get(),
            'jornada' => Jornada::get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        Funcionario::create($request->all());
        return Redirect::route('funcionario.index')->with('success', 'Funcionário criado com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Funcionario  $funcionario
     * @return \Illuminate\Http\Response
     */
    public function show(Funcionario $funcionario)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Funcionario  $funcionario
     * @return \Illuminate\Http\Response
     */
    public function edit(Funcionario $funcionario)
    {
        return Inertia::render('Funcionario/Edit', [
            'item' => $funcionario,            
            'faixa_salarial' => FaixaSalarial::get(),
            'faixa_etaria' => FaixaEtaria::get(),
            'lotacao' => Lotacao::get(),
            'jornada' => Jornada::get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateRequest  $request
     * @param  \App\Models\Funcionario  $funcionario
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, Funcionario $funcionario)
    {
        $funcionario->update($request->all());
        return Redirect::route('funcionario.index')->with('success', 'Funcionário alterado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Funcionario  $funcionario
     * @return \Illuminate\Http\Response
     */
    public function destroy(Funcionario $funcionario)
    {
        $funcionario->delete();
        return Redirect::route('funcionario.index')->with('success', 'Funcionário deletado com sucesso!');
    }
}
