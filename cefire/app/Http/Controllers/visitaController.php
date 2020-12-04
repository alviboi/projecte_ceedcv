<?php

namespace App\Http\Controllers;

use App\Models\visita;
use Illuminate\Http\Request;

class visitaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return visita::get();
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $dat = new visita();
        $dat->data = $request->data;
        $dat->inici = $request->inici;
        $dat->fi = $request->fi;
        $dat->user_id = auth()->id();
        $dat->centre = $request->motiu;
        $dat->save();
        return $dat->toArray();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\visita  $visita
     * @return \Illuminate\Http\Response
     */
    public function show(visita $visita)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\visita  $visita
     * @return \Illuminate\Http\Response
     */
    public function edit(visita $visita)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\visita  $visita
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, visita $visita)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\visita  $visita
     * @return \Illuminate\Http\Response
     */
    public function destroy(visita $visita)
    {
        //
        $visita->delete();
    }
}
