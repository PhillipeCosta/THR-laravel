<?php

namespace App\Http\Controllers;

use App\Models\{EmpresaBeneficio, Fornecedor, Lotacao};
use App\Http\Requests\{StoreRequest, UpdateRequest};
use Illuminate\Support\Facades\{Redirect,Request};
use Inertia\Inertia;

class EmpresaBeneficioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('EmpresaBeneficio/Index', [
            'items' => EmpresaBeneficio::orderBy('percentual_valor_funcionario')
                ->with('fornecedor')
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
        return Inertia::render('EmpresaBeneficio/Store', [
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
        EmpresaBeneficio::create($request->all());
        return Redirect::route('empresa-beneficio.index')->with('success', 'empresa-beneficio criada com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EmpresaBeneficio  $beneficio
     * @return \Illuminate\Http\Response
     */
    public function show(EmpresaBeneficio $empresa_beneficio)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EmpresaBeneficio  $empresa_beneficio
     * @return \Illuminate\Http\Response
     */
    public function edit(EmpresaBeneficio $empresa_beneficio)
    {
        return Inertia::render('EmpresaBeneficio/Edit', [
            'item' => $empresa_beneficio,
            'fornecedores' => Fornecedor::orderBy('razao_social')->get(),
            'lotacao' => Lotacao::orderBy('lotacao')->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateRequest  $request
     * @param  \App\Models\EmpresaBeneficio $empresa_beneficio
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, EmpresaBeneficio $empresa_beneficio)
    {
        $empresa_beneficio->update($request->all());
        return Redirect::route('empresa-beneficio.index')->with('success', 'Benefício empresa alterado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EmpresaBeneficio $empresa_beneficio
     * @return \Illuminate\Http\Response
     */
    public function destroy(EmpresaBeneficio $empresa_beneficio)
    {
        $empresa_beneficio->delete();
        return Redirect::route('empresa-beneficio.index')->with('success', 'Benefício empresa deletado com sucesso!');
    }
}
