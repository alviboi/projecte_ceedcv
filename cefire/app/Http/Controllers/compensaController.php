<?php

namespace App\Http\Controllers;

use App\Models\compensa;
use Illuminate\Http\Request;

class compensaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return compensa::get();
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\compensa  $compensa
     * @return \Illuminate\Http\Response
     */
    public function show(compensa $compensa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\compensa  $compensa
     * @return \Illuminate\Http\Response
     */
    public function edit(compensa $compensa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\compensa  $compensa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, compensa $compensa)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\compensa  $compensa
     * @return \Illuminate\Http\Response
     */
    public function destroy(compensa $compensa)
    {
        //
    }
}
