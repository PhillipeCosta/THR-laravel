<?php

namespace App\Http\Controllers;

use App\Models\{DescontoRefeicao, Cliente, FaixaSalarial};
use App\Http\Requests\{StoreDescontoRefeicaoRequest, UpdateDescontoRefeicaoRequest};
use Illuminate\Support\Facades\{Redirect,Request};
use Inertia\Inertia;

class DescontoRefeicaoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('DescontoRefeicao/Index', [
            'items' => DescontoRefeicao::orderBy('ativo')
                ->with('cliente')
                ->with('faixa')
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
        return Inertia::render('DescontoRefeicao/Store', [
            'clientes' => Cliente::where('ativo', 1)->orderBy('cliente')->get(),
            'faixa' => FaixaSalarial::where('ativo', 1)->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreDescontoRefeicaoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDescontoRefeicaoRequest $request)
    {
        DescontoRefeicao::create($request->all());
        return Redirect::route('desconto-refeicao.index')->with('success', 'Desconto refeição criado com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DescontoRefeicao  $descontoRefeicao
     * @return \Illuminate\Http\Response
     */
    public function show(DescontoRefeicao $descontoRefeicao)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DescontoRefeicao  $descontoRefeicao
     * @return \Illuminate\Http\Response
     */
    public function edit(DescontoRefeicao $descontoRefeicao)
    {
        return Inertia::render('DescontoRefeicao/Edit', [
            'item' => $descontoRefeicao,
            'clientes' => Cliente::where('ativo', 1)->orderBy('cliente')->get(),
            'faixa' => FaixaSalarial::where('ativo', 1)->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDescontoRefeicaoRequest  $request
     * @param  \App\Models\DescontoRefeicao  $descontoRefeicao
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDescontoRefeicaoRequest $request, DescontoRefeicao $descontoRefeicao)
    {
        $descontoRefeicao->update($request->all());
        return Redirect::route('desconto-refeicao.index')->with('success', 'Desconto refeição alterado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DescontoRefeicao  $descontoRefeicao
     * @return \Illuminate\Http\Response
     */
    public function destroy(DescontoRefeicao $descontoRefeicao)
    {
        $descontoRefeicao->delete();
        return Redirect::route('desconto-refeicao.index')->with('success', 'Desconto refeição deletado com sucesso!');
    }
}
