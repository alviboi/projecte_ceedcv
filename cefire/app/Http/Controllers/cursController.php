<?php

namespace App\Http\Controllers;

use App\Models\curs;
use Illuminate\Http\Request;

class cursController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return curs::get();
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
        $dat = new curs();
        $dat->data = $request->data;
        $dat->inici = $request->inici;
        $dat->fi = $request->fi;
        $dat->user_id = auth()->id();
        $dat->curs = $request->motiu;
        $dat->save();
        return $dat->toArray();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\curs  $curs
     * @return \Illuminate\Http\Response
     */
    public function show(curs $curs)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\curs  $curs
     * @return \Illuminate\Http\Response
     */
    public function edit(curs $curs)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\curs  $curs
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, curs $curs)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\curs  $curs
     * @return \Illuminate\Http\Response
     */
    public function destroy($curs)
    {
        //
        curs::find($curs)->delete();
    }
}
