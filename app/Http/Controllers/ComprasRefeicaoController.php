<?php

namespace App\Http\Controllers;

use App\Models\{ComprasRefeicao, Cliente, Lotacao};
use App\Http\Requests\{StoreComprasRefeicaoRequest, UpdateComprasRefeicaoRequest};
use Illuminate\Support\Facades\{Redirect,Request};
use App\Enum\ComprasRefeicaoTipo;
use Inertia\Inertia;

class ComprasRefeicaoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('ComprasRefeicao/Index', [
            'items' => ComprasRefeicao::orderBy('inicio')
                ->with('cliente')
                ->with('lotacao')
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
        return Inertia::render('ComprasRefeicao/Store', [
            'clientes' => Cliente::where('ativo', 1)->orderBy('cliente')->get(),
            'lotacao' => Lotacao::where('ativo', 1)->orderBy('lotacao')->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreComprasRefeicaoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreComprasRefeicaoRequest $request)
    {
        ComprasRefeicao::create($request->all());
        return Redirect::route('compras-refeicao.index')->with('success', 'Compras refeição criada com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ComprasRefeicao  $comprasRefeicao
     * @return \Illuminate\Http\Response
     */
    public function show(ComprasRefeicao $comprasRefeicao)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ComprasRefeicao  $comprasRefeicao
     * @return \Illuminate\Http\Response
     */
    public function edit(ComprasRefeicao $comprasRefeicao)
    {
        return Inertia::render('ComprasRefeicao/Edit', [
            'item' => $comprasRefeicao,
            'clientes' => Cliente::where('ativo', 1)->orderBy('cliente')->get(),
            'lotacao' => Lotacao::where('ativo', 1)->orderBy('lotacao')->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateComprasRefeicaoRequest  $request
     * @param  \App\Models\ComprasRefeicao  $comprasRefeicao
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateComprasRefeicaoRequest $request, ComprasRefeicao $comprasRefeicao)
    {
        $comprasRefeicao->update($request->all());
        return Redirect::route('compras-refeicao.index')->with('success', 'Compras refeição alterada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ComprasRefeicao  $comprasRefeicao
     * @return \Illuminate\Http\Response
     */
    public function destroy(ComprasRefeicao $comprasRefeicao)
    {
        $comprasRefeicao->delete();
        return Redirect::route('compras-refeicao.index')->with('success', 'Compras refeição deletada com sucesso!');
    }
}
