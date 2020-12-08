<?php

namespace App\Http\Controllers;

use App\Models\permis;
use Illuminate\Http\Request;

class permisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return permis::get();
    }
    /**
     * Extrau totes les dades de fitxar del cefire amb el nom
     *
     * @return \Illuminate\Http\Response
     */
    public function get_data_index($any, $mes)
    {
        $ret = array();
        $els = permis::whereMonth('data', '=', date($mes))->whereYear('data', '=', date($any))->get();
        foreach ($els as $el) {
            $item=array("id"=>$el->id, "name"=>$el->user['name'], "data"=>$el->data, "inici"=>$el->inici, "fi"=>$el->fi, "motiu"=>$el->motiu);
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
        $dat = new permis();
        $dat->data = $request->data;
        $dat->inici = $request->inici;
        $dat->fi = $request->fi;
        $dat->user_id = auth()->id();
        $dat->motiu = $request->motiu;
        $dat->save();
        return $dat->toArray();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\permis  $permis
     * @return \Illuminate\Http\Response
     */
    public function show(permis $permis)
    {
        //

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\permis  $permis
     * @return \Illuminate\Http\Response
     */
    public function edit(permis $permis)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\permis  $permis
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, permis $permis)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\permis  $permis
     * @return \Illuminate\Http\Response
     */
    public function destroy($permis)
    {
        //
        permis::find($permis)->delete();
    }
}
