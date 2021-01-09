<?php

namespace App\Http\Controllers;

use App\Models\avisos;
use Illuminate\Http\Request;

class avisosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $avisos=avisos::orderby('id','DESC')->get();
        $ret=array();
        foreach ($avisos as $avis) {
            # code...
            $el = ["nom"=>$avis->user['name'],"cap"=>$avis->cap,"data"=>$avis->data,"avis"=>$avis->avis,"id"=>$avis->id];
            array_push($ret,$el);
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
        //Validem en el component, no seria necessari esta part
        $this->validate($request, [
            'cap' => 'required',
            'avis' => 'required',
         ]);
        $avis = new avisos();
        $avis->cap = $request->cap;
        $avis->avis = $request->avis;
        $avis->data = date("Y-m-d");
        $avis->user_id = auth()->id();
        //  Store data in database
        $avis->save();
        //
        return 'Avís gravat correctament ';

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\avisos  $avisos
     * @return \Illuminate\Http\Response
     */
    public function show(avisos $avisos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\avisos  $avisos
     * @return \Illuminate\Http\Response
     */
    public function edit(avisos $avisos)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\avisos  $avisos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, avisos $avisos)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\avisos  $avisos
     * @return \Illuminate\Http\Response
     */
    public function destroy($avisos)
    {
        //

        $avis=avisos::find($avisos);
        if ($avis->id == auth()->id() || auth()->user()->Perfil == 1){
            $avis->delete();
            return "Borrat correctament";
        } else {
            abort(403,"No tens permís per a borrar aquest avís");
        }
    }
}
