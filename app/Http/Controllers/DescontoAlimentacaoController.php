<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\StoreDescontoAlimentacaoRequest;
use App\Http\Requests\UpdateDescontoAlimentacaoRequest;
use App\Models\{DescontoAlimentacao,Lotacao,Cliente};
use Inertia\Inertia;


class DescontoAlimentacaoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('DescontoAlimentacao/Index', [
            'filters' => Request::all('search'),
            'items' => DescontoAlimentacao::orderBy('inicio')
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
        return Inertia::render('DescontoAlimentacao/Store', [
            'clientes' => Cliente::where('ativo', 1)->orderBy('cliente')->get(),
            'lotacao' => Lotacao::orderBy('lotacao')->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreDescontoAlimentacaoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDescontoAlimentacaoRequest $request)
    {
        DescontoAlimentacao::create($request->all());
        return Redirect::route('desconto-alimentacao.index')->with('success', 'Desconto alimentação criado com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DescontoAlimentacao  $desconto_alimentacao
     * @return \Illuminate\Http\Response
     */
    public function show(DescontoAlimentacao $desconto_alimentacao)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DescontoAlimentacao  $desconto_alimentacao
     * @return \Illuminate\Http\Response
     */
    public function edit(DescontoAlimentacao $desconto_alimentacao)
    {
        return Inertia::render('DescontoAlimentacao/Edit', [
            'item' => $desconto_alimentacao,
            'clientes' => Cliente::where('ativo', 1)->orderBy('cliente')->get(),
            'lotacao' => Lotacao::orderBy('lotacao')->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDescontoAlimentacaoRequest  $desconto_alimentacao
     * @param  \App\Models\DescontoAlimentacao  $desconto_alimentacao
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDescontoAlimentacaoRequest $request, DescontoAlimentacao $desconto_alimentacao)
    {
        $desconto_alimentacao->update($request->all());
        return Redirect::route('desconto-alimentacao.index')->with('success', 'Desconto alimentação alterada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DescontoAlimentacao  $desconto_alimentacao
     * @return \Illuminate\Http\Response
     */
    public function destroy(DescontoAlimentacao $desconto_alimentacao)
    {
        $desconto_alimentacao->delete();
        return Redirect::route('desconto-alimentacao.index')->with('success', 'Desconto alimentação deletado com sucesso!');
    }
}
