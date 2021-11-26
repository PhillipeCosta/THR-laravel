<?php

namespace App\Http\Controllers;

use App\Models\Beneficio;
use App\Http\Requests\StoreBeneficioRequest;
use App\Http\Requests\UpdateBeneficioRequest;
use Illuminate\Support\Facades\Redirect;
use Spatie\QueryBuilder\QueryBuilder;
use Illuminate\Support\Facades\Request;
use Inertia\Inertia;

class BeneficiosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Beneficios', [
            'filters' => Request::all('beneficio'),
            'items' => QueryBuilder::for(Beneficio::class)
                ->allowedFilters('beneficio')
                ->allowedSorts('beneficio')
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreBeneficioRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBeneficioRequest $request)
    {
        Beneficio::create($request->all());
        return Redirect::route('beneficios.index')->with('success', 'Benefício criado.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Beneficio  $beneficios
     * @return \Illuminate\Http\Response
     */
    public function show(Beneficio $beneficios)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Beneficio  $beneficios
     * @return \Illuminate\Http\Response
     */
    public function edit(Beneficio $beneficios)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBeneficioRequest  $request
     * @param  \App\Models\Beneficio  $beneficio
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBeneficioRequest $request, Beneficio $beneficio)
    {

        $beneficio->update($request->all());
        return Redirect::route('beneficios.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Beneficio  $Beneficio
     * @return \Illuminate\Http\Response
     */
    public function destroy(Beneficio $beneficio)
    {
        $beneficio->delete();
        return Redirect::route('beneficios.index')->with('success', 'Benefício deletado.');;
    }
}