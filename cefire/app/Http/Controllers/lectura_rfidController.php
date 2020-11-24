<?php

namespace App\Http\Controllers;

use App\Models\lectura_rfid;
use Illuminate\Http\Request;

class lectura_rfidController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return lectura_rfid::get();
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
     * @param  \App\Models\lectura_rfid  $lectura_rfid
     * @return \Illuminate\Http\Response
     */
    public function show(lectura_rfid $lectura_rfid)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\lectura_rfid  $lectura_rfid
     * @return \Illuminate\Http\Response
     */
    public function edit(lectura_rfid $lectura_rfid)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\lectura_rfid  $lectura_rfid
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, lectura_rfid $lectura_rfid)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\lectura_rfid  $lectura_rfid
     * @return \Illuminate\Http\Response
     */
    public function destroy(lectura_rfid $lectura_rfid)
    {
        //
    }
}
