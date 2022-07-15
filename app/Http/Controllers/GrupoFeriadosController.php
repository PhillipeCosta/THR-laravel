<?php

namespace App\Http\Controllers;

use App\Models\GrupoFeriados;
use App\Http\Requests\{StoreRequest, UpdateRequest};
use Illuminate\Support\Facades\{Redirect, Request};
use Inertia\Inertia;

class GrupoFeriadosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('GrupoFeriados/Index', [
            'items' => GrupoFeriados::latest()
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
        return Inertia::render('GrupoFeriados/Store');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        GrupoFeriados::create($request->all());
        return Redirect::route('grupo-feriado.index')->with('success', 'Grupo de feriados criado com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\GrupoFeriados  $grupo_feriado
     * @return \Illuminate\Http\Response
     */
    public function show(GrupoFeriados $grupo_feriado)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\GrupoFeriados  $grupo_feriado
     * @return \Illuminate\Http\Response
     */
    public function edit(GrupoFeriados $grupo_feriado)
    {
        return Inertia::render('GrupoFeriados/Edit', [
            'item' => $grupo_feriado
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateRequest  $request
     * @param  \App\Models\GrupoFeriados  $grupo_feriado
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, GrupoFeriados $grupo_feriado)
    {
        $grupo_feriado->update($request->all());
        return Redirect::route('grupo-feriado.index')->with('success', 'Grupo de feriados alterado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\GrupoFeriados  $grupo_feriado
     * @return \Illuminate\Http\Response
     */
    public function destroy(GrupoFeriados $grupo_feriado)
    {
        $grupo_feriado->delete();
        return Redirect::route('grupo-feriado.index')->with('success', 'Grupo de feriados deletado com sucesso!');
    }
}
