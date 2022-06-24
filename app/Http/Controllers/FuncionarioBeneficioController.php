<?php

namespace App\Http\Controllers;

use App\Models\{FuncionarioBeneficio, Fornecedor, Funcionario};
use App\Http\Requests\{StoreRequest, UpdateRequest};
use Illuminate\Support\Facades\{Redirect,Request};
use Inertia\Inertia;

class FuncionarioBeneficioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('FuncionarioBeneficio/Index', [
            'items' => FuncionarioBeneficio::latest()
                ->with('fornecedor')
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
        return Inertia::render('FuncionarioBeneficio/Store', [
            'fornecedores' => Fornecedor::get(),
            'funcionario' => Funcionario::get()
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
        FuncionarioBeneficio::create($request->all());
        return Redirect::route('funcionario-beneficio.index')->with('success', 'Funcionário benefício criada com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FuncionarioBeneficio  $funcionario_beneficio
     * @return \Illuminate\Http\Response
     */
    public function show(FuncionarioBeneficio $funcionario_beneficio)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FuncionarioBeneficio  $funcionario_beneficio
     * @return \Illuminate\Http\Response
     */
    public function edit(FuncionarioBeneficio  $funcionario_beneficio)
    {
        return Inertia::render('FuncionarioBeneficio/Edit', [
            'item' => $funcionario_beneficio,
            'fornecedores' => Fornecedor::get(),
            'funcionario' => Funcionario::get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateRequest  $request
     * @param  \App\Models\FuncionarioBeneficio  $funcionario_beneficio
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, FuncionarioBeneficio  $funcionario_beneficio)
    {
        $funcionario_beneficio->update($request->all());
        return Redirect::route('funcionario-beneficio.index')->with('success', 'Funcionário Benefício alterado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FuncionarioBeneficio  $funcionario_beneficio
     * @return \Illuminate\Http\Response
     */
    public function destroy(FuncionarioBeneficio  $funcionario_beneficio)
    {
        $funcionario_beneficio->delete();
        return Redirect::route('funcionario-beneficio.index')->with('success', 'Funcionário Benefício deletado com sucesso!');
    }
}
