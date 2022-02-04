<?php

namespace App\Http\Controllers;

use App\Models\{DescontoTransporte, Cliente, FaixaSalarial};
use App\Http\Requests\{StoreDescontoTransporteRequest, UpdateDescontoTransporteRequest};
use Illuminate\Support\Facades\{Redirect,Request};
use Inertia\Inertia;

class DescontoTransporteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('DescontoTransporte/Index', [
            'items' => DescontoTransporte::orderBy('ativo')
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
        return Inertia::render('DescontoTransporte/Store', [
            'clientes' => Cliente::where('ativo', 1)->orderBy('cliente')->get(),
            'faixa' => FaixaSalarial::where('ativo', 1)->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreDescontoTransporteRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDescontoTransporteRequest $request)
    {
        DescontoTransporte::create($request->all());
        return Redirect::route('desconto-transporte.index')->with('success', 'Desconto transporte criado com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DescontoTransporte  $descontoTransporte
     * @return \Illuminate\Http\Response
     */
    public function show(DescontoTransporte $descontoTransporte)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DescontoTransporte  $descontoTransporte
     * @return \Illuminate\Http\Response
     */
    public function edit(DescontoTransporte $descontoTransporte)
    {
        return Inertia::render('DescontoTransporte/Edit', [
            'item' => $descontoTransporte,
            'clientes' => Cliente::where('ativo', 1)->orderBy('cliente')->get(),
            'faixa' => FaixaSalarial::where('ativo', 1)->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDescontoTransporteRequest  $request
     * @param  \App\Models\UpdateDescontoTransporteRequest  $descontoTransporte
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDescontoTransporteRequest $request, DescontoTransporte $descontoTransporte)
    {
        $descontoTransporte->update($request->all());
        return Redirect::route('desconto-transporte.index')->with('success', 'Desconto transporte alterado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DescontoTransporte  $descontoTransporte
     * @return \Illuminate\Http\Response
     */
    public function destroy(DescontoTransporte $descontoTransporte)
    {
        $descontoTransporte->delete();
        return Redirect::route('desconto-transporte.index')->with('success', 'Desconto transporte deletado com sucesso!');
    }
}
