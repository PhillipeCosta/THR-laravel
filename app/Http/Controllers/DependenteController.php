<?php

namespace App\Http\Controllers;

use App\Models\{Dependente, FaixaEtaria, GrauParentesco};
use App\Http\Requests\{StoreRequest, UpdateRequest};
use Illuminate\Support\Facades\{Redirect, Request};
use Inertia\Inertia;

class DependenteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Dependente/Index', [
            'items' => Dependente::latest()
                ->with('faixa_etaria')
                ->with('grau_parentesco')
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
        return Inertia::render('Dependente/Store', [
            'faixa_etaria' => FaixaEtaria::get(),
            'grau_parentesco' => GrauParentesco::get()
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
        Dependente::create($request->all());
        return Redirect::route('dependente.index')->with('success', 'Dependente criado com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Dependente  $dependente
     * @return \Illuminate\Http\Response
     */
    public function show(Dependente $dependente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Dependente  $dependente
     * @return \Illuminate\Http\Response
     */
    public function edit(Dependente $dependente)
    {
        return Inertia::render('Dependente/Edit', [
            'item' => $dependente,
            'faixa_etaria' => FaixaEtaria::get(),
            'grau_parentesco' => GrauParentesco::get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateRequest  $request
     * @param  \App\Models\Dependente  $dependente
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, Dependente $dependente)
    {
        $dependente->update($request->all());
        return Redirect::route('dependente.index')->with('success', 'Dependente alterado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Dependente  $dependente
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dependente $dependente)
    {
        $dependente->delete();
        return Redirect::route('dependente.index')->with('success', 'Dependente deletado com sucesso!');
    }
}
