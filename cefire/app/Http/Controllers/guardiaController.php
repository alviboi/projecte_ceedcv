<?php

namespace App\Http\Controllers;

use App\Models\guardia;
use Illuminate\Http\Request;

class guardiaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return guardia::get();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function get_data_index($mes, $any)
    {
        //
        // return guardia::whereMonth('data', '=', date($mes))->whereYear('data', '=', date($any))->user()->get();
        $ret = array();
        $guardies = guardia::whereMonth('data', '=', date($mes))->whereYear('data', '=', date($any))->get();
        foreach ($guardies as $guardia) {
            array_push($ret, [$guardia->user['name'],$guardia->data,$guardia->inici,$guardia->id]);
        }
        return $ret;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function put_guardia_id(Request $request)
    {
        $guardia = new guardia();
        $guardia->user_id=$request->id;
        $guardia->data=$request->data;
        if ($request->mati="m"){
            $guardia->inici="09:00:00";
            $guardia->fi="14:00:00";
        } else {
            $guardia->inici="16:00:00";
            $guardia->fi="20:00:00";
        }
        $guardia->save();
        return $guardia;

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
        $dat = new guardia();
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
     * @param  \App\Models\guardia  $guardia
     * @return \Illuminate\Http\Response
     */
    public function show(guardia $guardia)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\guardia  $guardia
     * @return \Illuminate\Http\Response
     */
    public function edit(guardia $guardia)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\guardia  $guardia
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, guardia $guardia)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\cefire  $cefire
     * @return \Illuminate\Http\Response
     */
    public function destroy($guardia)
    {
        //
        guardia::find($guardia)->delete();
    }
}
