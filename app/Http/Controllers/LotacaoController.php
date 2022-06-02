<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\{StoreRequest, UpdateRequest};
use App\Models\{Lotacao, Empresa, Feriado};
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
                ->with('empresa')
                ->with('feriado')
                ->filter(Request::only('search'))
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
            'empresas' => Empresa::orderBy('razao_social')->get(),
            'feriados' => Feriado::orderBy('nome_grupo')->get(),
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
            'empresas' => Empresa::orderBy('razao_social')->get(),
            'feriados' => Feriado::orderBy('nome_grupo')->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateRequest  $lotacao
     * @param  \App\Models\Lotacao  $lotacao
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, Lotacao $lotacao)
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
