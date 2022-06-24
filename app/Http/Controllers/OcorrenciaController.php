<?php

namespace App\Http\Controllers;

use App\Models\{Ocorrencia, Funcionario, Ausencia};
use App\Http\Requests\{StoreRequest, UpdateRequest};
use Illuminate\Support\Facades\{Redirect, Request};
use Inertia\Inertia;

class OcorrenciaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Ocorrencia/Index', [
            'items' => Ocorrencia::latest()
                ->with('ausencia')
                ->with('funcionario')
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
        return Inertia::render('Ocorrencia/Store', [
            'funcionario' => Funcionario::get(),
            'ausencia' => Ausencia::get()
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
        Ocorrencia::create($request->all());
        return Redirect::route('ocorrencia.index')->with('success', 'Ocorrência criado com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ocorrencia  $ocorrencium
     * @return \Illuminate\Http\Response
     */
    public function show(Ocorrencia $ocorrencium)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ocorrencia $ocorrencium
     * @return \Illuminate\Http\Response
     */
    public function edit(Ocorrencia $ocorrencium)
    {
        return Inertia::render('Ocorrencia/Edit', [
            'item' => $ocorrencium,
            'funcionario' => Funcionario::get(),
            'ausencia' => Ausencia::get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateRequest  $request
     * @param  \App\Models\Ocorrencia  $ocorrencia
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, Ocorrencia $ocorrencia)
    {
        $ocorrencia->update($request->all());
        return Redirect::route('ocorrencia.index')->with('success', 'Ocorrência alterado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ocorrencia  $ocorrencocorrenciumia
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ocorrencia $ocorrencium)
    {
        $ocorrencium->delete();
        return Redirect::route('ocorrencia.index')->with('success', 'Ocorrência deletado com sucesso!');
    }
}
