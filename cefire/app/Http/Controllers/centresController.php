<?php

namespace App\Http\Controllers;

use App\Models\centres;
use Illuminate\Http\Request;

class centresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return centres::get();
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
     * @param  \App\Models\centres  $centres
     * @return \Illuminate\Http\Response
     */
    public function show(centres $centres)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\centres  $centres
     * @return \Illuminate\Http\Response
     */
    public function edit(centres $centres)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\centres  $centres
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, centres $centres)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\centres  $centres
     * @return \Illuminate\Http\Response
     */
    public function destroy(centres $centres)
    {
        //
    }
}
