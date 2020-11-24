<?php

namespace App\Http\Controllers;

use App\Models\notificacions;
use Illuminate\Http\Request;

class notificacionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return notificacions::get();
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
     * @param  \App\Models\notificacions  $notificacions
     * @return \Illuminate\Http\Response
     */
    public function show(notificacions $notificacions)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\notificacions  $notificacions
     * @return \Illuminate\Http\Response
     */
    public function edit(notificacions $notificacions)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\notificacions  $notificacions
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, notificacions $notificacions)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\notificacions  $notificacions
     * @return \Illuminate\Http\Response
     */
    public function destroy(notificacions $notificacions)
    {
        //
    }
}
