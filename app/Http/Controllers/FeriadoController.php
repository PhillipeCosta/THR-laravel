<?php

namespace App\Http\Controllers;

use App\Models\Feriado;
use App\Http\Requests\{StoreRequest, UpdateRequest};
use Illuminate\Support\Facades\{Redirect, Request};
use Inertia\Inertia;

class FeriadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Feriado/Index', [
            'items' => Feriado::orderBy('data')
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
        return Inertia::render('Feriado/Store');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        Feriado::create($request->all());
        return Redirect::route('feriado.index')->with('success', 'Feriado criado com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Feriado  $feriado
     * @return \Illuminate\Http\Response
     */
    public function show(Feriado $feriado)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Feriado  $feriado
     * @return \Illuminate\Http\Response
     */
    public function edit(Feriado $feriado)
    {
        return Inertia::render('Feriado/Edit', [
            'item' => $feriado
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateRequest  $request
     * @param  \App\Models\Feriado  $feriado
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, Feriado $feriado)
    {
        $feriado->update($request->all());
        return Redirect::route('feriado.index')->with('success', 'Feriado alterado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Feriado  $feriado
     * @return \Illuminate\Http\Response
     */
    public function destroy(Feriado $feriado)
    {
        $feriado->delete();
        return Redirect::route('feriado.index')->with('success', 'Feriado deletado com sucesso!');
    }
}
