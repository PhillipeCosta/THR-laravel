<?php

namespace App\Http\Controllers;

use App\Models\{Fornecedor, Lotacao, CompraBeneficio};
use App\Http\Requests\{StoreRequest, UpdateRequest};
use Illuminate\Support\Facades\{Redirect,Request};
use Inertia\Inertia;

class CompraBeneficioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('ComprasBeneficios/Index', [
            'items' => CompraBeneficio::orderBy('tipo_beneficio')
                ->with('lotacao')
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
        return Inertia::render('ComprasBeneficios/Store', [
            'fornecedores' => Fornecedor::orderBy('razao_social')->get(),
            'lotacao' => Lotacao::orderBy('lotacao')->get()
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
        CompraBeneficio::create($request->all());
        return Redirect::route('compras-beneficios.index')->with('success', 'Benefício criado com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\compras_beneficio  $compras_beneficio
     * @return \Illuminate\Http\Response
     */
    public function show(CompraBeneficio $compras_beneficio)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CompraBeneficio  $compras_beneficio
     * @return \Illuminate\Http\Response
     */
    public function edit(CompraBeneficio $compras_beneficio)
    {
        return Inertia::render('ComprasBeneficios/Edit', [
            'item' => $compras_beneficio,
            'fornecedores' => Fornecedor::orderBy('razao_social')->get(),
            'lotacao' => Lotacao::orderBy('lotacao')->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateRequest  $request
     * @param  \App\Models\CompraBeneficio  $compras_beneficio
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, CompraBeneficio $compras_beneficio)
    {
        $compras_beneficio->update($request->all());
        return Redirect::route('compras-beneficios.index')->with('success', 'Benefício alterado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CompraBeneficio  $compras_beneficio
     * @return \Illuminate\Http\Response
     */
    public function destroy(CompraBeneficio $compras_beneficio)
    {
        $compras_beneficio->delete();
        return Redirect::route('compras-beneficios.index')->with('success', 'Benefício deletado com sucesso!');
    }
}
