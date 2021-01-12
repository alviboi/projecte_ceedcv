<?php

namespace App\Http\Controllers;

use App\Models\visita;
use Illuminate\Http\Request;

class visitaController extends Controller
{
    /**
     * Mostra un llistat de tot el recurs
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return visita::get();
    }
    /**
     * Extrau totes les dades de fitxar del cefire amb el nom
     *
     * @return \Illuminate\Http\Response
     */
    public function get_data_index($any, $mes)
    {
        $ret = array();
        $els = visita::whereMonth('data', '=', date($mes))->whereYear('data', '=', date($any))->get();
        foreach ($els as $el) {
            $item=array("id"=>$el->id, "name"=>$el->user['name'], "data"=>$el->data, "inici"=>$el->inici, "fi"=>$el->fi, "centre"=>$el->centre);
            array_push($ret, $item);
        }
        return $ret;
    }

    /**
     * Crea un element del recurs
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Guarda l'elememt creat.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $dat = new visita();
        $dat->data = $request->data;
        $dat->inici = $request->inici;
        $dat->fi = $request->fi;
        $dat->user_id = auth()->id();
        $dat->centre = $request->motiu;
        $dat->save();
        return $dat->toArray();
    }

    /**
     * Mostra l'element del curs
     *
     * @param  \App\Models\visita  $visita
     * @return \Illuminate\Http\Response
     */
    public function show(visita $visita)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\visita  $visita
     * @return \Illuminate\Http\Response
     */
    public function edit(visita $visita)
    {
        //
    }

    /**
     * Actualitza l'element del recurs a la base de dades
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\visita  $visita
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, visita $visita)
    {
        //
    }

    /**
     * Elimina l'element  del recurs de la base de dades
     *
     * @param  \App\Models\visita  $visita
     * @return \Illuminate\Http\Response
     */
    public function destroy($visita)
    {
        //
        visita::find($visita)->delete();    }
}
