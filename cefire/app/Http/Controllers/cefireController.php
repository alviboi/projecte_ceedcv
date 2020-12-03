<?php

namespace App\Http\Controllers;

use App\Models\cefire;
use Illuminate\Http\Request;

class cefireController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return cefire::get();

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
        $dat = new cefire();
        $dat->data = $request->data;
        $dat->inici = $request->inici;
        $dat->fi = $request->fi;
        $dat->user_id = auth()->id();
        $dat->save();
        return $dat->toArray();

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\cefire  $cefire
     * @return \Illuminate\Http\Response
     */
    public function show(cefire $cefire)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\cefire  $cefire
     * @return \Illuminate\Http\Response
     */
    public function edit(cefire $cefire)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\cefire  $cefire
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, cefire $cefire)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\cefire  $cefire
     * @return \Illuminate\Http\Response
     */
    public function destroy(cefire $cefire)
    {
        //
        $cefire->delete();
    }
}
