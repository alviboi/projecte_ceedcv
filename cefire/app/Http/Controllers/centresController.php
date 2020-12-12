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
        $centres=centres::get()->values();
        $ret=array();
        array_push($ret,array("id","assessor","nom","codi","situacio","CP","ciutat","contacte","mail_contacte","tlf_contacte"));
        foreach ($centres as $el) {
            //["id","nom","codi","situacio","CP","ciutat","user_id","contacte","mail_contacte","tlf_contacte","Observacions"]
            $item=array($el->id,$el->user['name'],$el->nom,$el->codi,$el->situacio,$el->CP,$el->ciutat,$el->contacte,$el->mail_contacte,$el->tlf_contacte);
            array_push($ret, $item);
        }
        return $ret;
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
