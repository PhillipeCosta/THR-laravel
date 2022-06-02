<?php

namespace App\Http\Controllers;

use App\Models\{FaixaEtaria, Fornecedor};
use App\Http\Requests\{StoreRequest, UpdateRequest};
use Illuminate\Support\Facades\{Redirect,Request};
use Inertia\Inertia;

class FaixaEtariaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('FaixaEtaria/Index', [
            'items' => FaixaEtaria::orderBy('tipo_plano')
                ->with('fornecedor')
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
        return Inertia::render('FaixaEtaria/Store', [
            'fornecedores' => Fornecedor::orderBy('razao_social')->get()
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
        FaixaEtaria::create($request->all());
        return Redirect::route('faixa-etaria.index')->with('success', 'Faixa etária criada com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FaixaEtaria  $faixa
     * @return \Illuminate\Http\Response
     */
    public function show(FaixaEtaria $faixa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FaixaEtaria  $faixa
     * @return \Illuminate\Http\Response
     */
    public function edit(FaixaEtaria $faixa)
    {
        return Inertia::render('FaixaEtaria/Edit', [
            'item' => $faixa,
            'fornecedores' => Fornecedor::orderBy('razao_social')->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateRequest  $request
     * @param  \App\Models\FaixaEtaria  $faixa
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, FaixaEtaria $faixa)
    {
        $faixa->update($request->all());
        return Redirect::route('empresa.index')->with('success', 'Faixa etária alterada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FaixaEtaria  $faixa
     * @return \Illuminate\Http\Response
     */
    public function destroy(FaixaEtaria $faixa)
    {
        $faixa->delete();
        return Redirect::route('empresa.index')->with('success', 'Faixa etária deletada com sucesso!');
    }
}
