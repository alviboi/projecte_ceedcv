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
        // $centres=centres::get()->values();
        // $ret=array();
        // array_push($ret,array("id","assessor","nom","codi","situacio","CP","ciutat","contacte","mail_contacte","tlf_contacte","Observacions"));
        // foreach ($centres as $el) {
        //     //["id","nom","codi","situacio","CP","ciutat","user_id","contacte","mail_contacte","tlf_contacte","Observacions"]
        //     $item=array($el->id,$el->user['name'],$el->nom,$el->codi,$el->situacio,$el->CP,$el->ciutat,$el->contacte,$el->mail_contacte,$el->tlf_contacte,$el->Observacions);
        //     array_push($ret, $item);
        // }
        // return $ret;
        $centres=centres::get()->values();
        $ret=array();
        // array_push($ret,array("id","assessor","nom","codi","situacio","CP","ciutat","contacte","mail_contacte","tlf_contacte","Observacions"));
        foreach ($centres as $el) {
            //["id","nom","codi","situacio","CP","ciutat","user_id","contacte","mail_contacte","tlf_contacte","Observacions"]
            $item=array("id" => $el->id,"assessor" => $el->user['name'],"nom" => $el->nom,"codi"=>$el->codi,"situacio"=>$el->situacio,"CP"=>$el->CP,"ciutat"=>$el->ciutat,"contacte"=>$el->contacte,"mail_contacte"=>$el->mail_contacte,"tlf_contacte"=>$el->tlf_contacte,"Observacions"=>$el->Observacions);
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
    public function update(Request $request, $centres)
    {
        //
        $centre = centres::find($centres);
        $centre->user_id = $request->user_id;
        $centre->nom = $request->nom;
        $centre->codi = $request->codi;
        $centre->situacio = $request->situacio;
        $centre->CP = $request->CP;
        $centre->ciutat = $request->ciutat;
        $centre->contacte = $request->contacte;
        $centre->mail_contacte = $request->mail_contacte;
        $centre->tlf_contacte = $request->tlf_contacte;
        $centre->Observacions = $request->Observacions;
        $centre->save();
        return $centre;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\centres  $centres
     * @return \Illuminate\Http\Response
     */
    public function destroy($centres)
    {
        //
        centres::find($centres)->delete();

    }
}
