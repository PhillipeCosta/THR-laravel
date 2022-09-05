<?php

namespace App\Http\Controllers;

use App\Models\{FaixaSalarial, CompraBeneficio, Lotacao, Empresa};
use App\Http\Requests\{StoreRequest, UpdateRequest};
use Illuminate\Support\Facades\{Redirect, Request};
use Inertia\Inertia;

class FaixaSalarialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('FaixaSalarial/Index', [
            'items' => FaixaSalarial::orderBy('inicio')
                ->with('compra_beneficio')
                ->with('lotacao')
                ->with('cliente')
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
        return Inertia::render('FaixaSalarial/Store', [
            'lotacao' => Lotacao::get(),
            'compra_beneficio' => CompraBeneficio::get(),
            'empresa' => Empresa::get()
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
        FaixaSalarial::create($request->all());
        return Redirect::route('faixa-salarial.index')->with('success', 'Faixa salarial criada com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Beneficio  $faixaSalarial
     * @return \Illuminate\Http\Response
     */
    public function show(FaixaSalarial $faixaSalarial)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FaixaSalarial  $faixaSalarial
     * @return \Illuminate\Http\Response
     */
    public function edit(FaixaSalarial $faixaSalarial)
    {
        return Inertia::render('FaixaSalarial/Edit', [
            'item' => $faixaSalarial,
            'lotacao' => Lotacao::get(),
            'compra_beneficio' => CompraBeneficio::get(),
            'empresa' => Empresa::get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateRequest  $request
     * @param  \App\Models\FaixaSalarial  $beneficio
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, FaixaSalarial $faixaSalarial)
    {
        $faixaSalarial->update($request->all());
        return Redirect::route('faixa-salarial.index')->with('success', 'Faixa salarial alterada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FaixaSalarial  $faixaSalarial
     * @return \Illuminate\Http\Response
     */
    public function destroy(FaixaSalarial $faixaSalarial)
    {
        $faixaSalarial->delete();
        return Redirect::route('faixa-salarial.index')->with('success', 'Faixa salarial deletada com sucesso!');
    }
}
