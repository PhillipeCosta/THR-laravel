<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\StoreLotacaoRequest;
use App\Http\Requests\UpdateLotacaoRequest;
use App\Models\Lotacao;
use App\Models\Cliente;
use Inertia\Inertia;


class LotacaoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Lotacao/Index', [
            'filters' => Request::all('search'),
            'items' => Lotacao::orderBy('lotacao')
                ->filter(Request::only('search'))
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
        return Inertia::render('Lotacao/Store', [
            'clientes' => Cliente::where('ativo', 1)->orderBy('cliente')->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreLotacaoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreLotacaoRequest $request)
    {
        Lotacao::create($request->all());
        return Redirect::route('lotacao.index')->with('success', 'Lotação criada com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Lotacao  $lotacao
     * @return \Illuminate\Http\Response
     */
    public function show(Lotacao $lotacao)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Lotacao  $lotacao
     * @return \Illuminate\Http\Response
     */
    public function edit(Lotacao $lotacao)
    {
        return Inertia::render('Lotacao/Edit', [
            'item' => $lotacao,
            'clientes' => Cliente::where('ativo', 1)->orderBy('cliente')->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateLotacaoRequest  $lotacao
     * @param  \App\Models\Lotacao  $lotacao
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateLotacaoRequest $request, Lotacao $lotacao)
    {
        $lotacao->update($request->all());
        return Redirect::route('lotacao.index')->with('success', 'Lotação alterado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Lotacao  $lotacao
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lotacao $lotacao)
    {
        $lotacao->delete();
        return Redirect::route('lotacao.index')->with('success', 'Lotação deletado com sucesso!');
    }
}
