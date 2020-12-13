<?php

namespace App\Http\Controllers;

use App\Models\cefire;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
     * Extrau totes les dades de fitxar del cefire amb el nom
     *
     * @return \Illuminate\Http\Response
     */
    public function get_data_index($any, $mes)
    {
        $ret = array();
        $els = cefire::whereMonth('data', '=', date($mes))->whereYear('data', '=', date($any))->get();
        foreach ($els as $el) {
            $item=array("id"=>$el->id, "name"=>$el->user['name'], "data"=>$el->data, "inici"=>$el->inici->format('H:i'), "fi"=>$el->fi->format('H:i'));
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

        /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\cefire  $cefire
     * @return \Illuminate\Http\Response
     */
    public function contar_cefires($desde,$fins)
    {
        //
        $cefire=cefire::where('user_id','=',auth()->id())->whereBetween('data', [$desde, $fins])->orderBy('data','ASC')->get();
        $total=0;
        $labels=array();
        $data=array();
        $data_ant=new DateTime();
        foreach($cefire as $cef){
            if ($data_ant == $cef->data) {
                $duration = $cef->inici->diffInMinutes($cef->fi);
                $valor = array_pop($data);
                array_push($data,($valor+$duration));
            } else {
                $duration = $cef->inici->diffInMinutes($cef->fi);
                array_push($labels,$cef->data);
                array_push($data,$duration);
                $total=$total+$duration;
            }
            $data_ant=$cef->data;
        }
        $ret=array('labels' => $labels, 'data' => $data, 'total' => $total);
        return ($ret);
    }
}
