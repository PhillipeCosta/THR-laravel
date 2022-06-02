<?php

namespace App\Http\Controllers;

use App\Models\{Fornecedor, Lotacao, CompraBeneficio};
use App\Http\Requests\{StoreCompraBeneficioRequest, UpdateCompraBeneficioRequest};
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
     * @param  \App\Http\Requests\StoreCompraBeneficioRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCompraBeneficioRequest $request)
    {
        CompraBeneficio::create($request->all());
        return Redirect::route('compras-beneficios.index')->with('success', 'Benefício criado com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CompraBeneficio  $compraBeneficio
     * @return \Illuminate\Http\Response
     */
    public function show(CompraBeneficio $compraBeneficio)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CompraBeneficio  $compraBeneficio
     * @return \Illuminate\Http\Response
     */
    public function edit(CompraBeneficio $compraBeneficio)
    {
        return Inertia::render('ComprasBeneficios/Edit', [
            'item' => $compraBeneficio,
            'fornecedores' => Fornecedor::orderBy('razao_social')->get(),
            'lotacao' => Lotacao::orderBy('lotacao')->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCompraBeneficioRequest  $request
     * @param  \App\Models\CompraBeneficio  $compraBeneficio
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCompraBeneficioRequest $request, CompraBeneficio $compraBeneficio)
    {
        $compraBeneficio->update($request->all());
        return Redirect::route('compras-beneficios.index')->with('success', 'Benefício alterado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CompraBeneficio  $compraBeneficio
     * @return \Illuminate\Http\Response
     */
    public function destroy(CompraBeneficio $compraBeneficio)
    {
        $compraBeneficio->delete();
        return Redirect::route('compras-beneficios.index')->with('success', 'Benefício deletado com sucesso!');
    }
}
