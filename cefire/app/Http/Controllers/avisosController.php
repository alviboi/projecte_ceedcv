<?php

namespace App\Http\Controllers;

use App\Models\avisos;
use Illuminate\Http\Request;

class avisosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return avisos::orderby('id','DESC')->get();
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
        //Validem en el component, no seria necessari esta part
        $this->validate($request, [
            'cap' => 'required',
            'avis' => 'required',
         ]);
        $avis = new avisos();
        $avis->cap = $request->cap;
        $avis->avis = $request->avis;
        $avis->data = date("Y-m-d");
        //  Store data in database
        $avis->save();
        //
        return 'Avís gravat correctament ';

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\avisos  $avisos
     * @return \Illuminate\Http\Response
     */
    public function show(avisos $avisos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\avisos  $avisos
     * @return \Illuminate\Http\Response
     */
    public function edit(avisos $avisos)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\avisos  $avisos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, avisos $avisos)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\avisos  $avisos
     * @return \Illuminate\Http\Response
     */
    public function destroy(avisos $avisos)
    {
        //
    }
}
