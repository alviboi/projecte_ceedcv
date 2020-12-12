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
        // return notificacions::where('user_id','=',auth()->id())->get();
        $ret = array();
        $els = notificacions::get();
        foreach ($els as $el) {
            $item=array("id"=>$el->id, "name"=>$el->user['name'], "From"=>$el->From, "user_id"=>$el->user_id, "cap"=>$el->cap, "missatge"=>$el->missatge);
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
        //id 	From 	user_id 	missatge
        $notificacio = new notificacions();
        $notificacio->From=auth()->id();
        $notificacio->cap=$request->cap;
        $notificacio->user_id=$request->user_id;
        $notificacio->missatge=$request->avis;
        $err=$notificacio->save();
        if ($err){
            return "Missatge enviat  correctament";
        } else {
            return "Alguna cosa ha anar malament";
        }

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
    public function destroy($notificacions)
    {
        //
        notificacions::find($notificacions)->delete();

    }
}
