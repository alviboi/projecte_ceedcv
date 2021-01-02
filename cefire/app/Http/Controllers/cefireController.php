<?php

namespace App\Http\Controllers;

use App\Models\cefire;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ControlController;

class cefireController extends Controller
{

    //protected $Control_data;
    protected $aparell;
    public function __construct(ControlController $Control_data)
    {
        //$this->Control_data = $Control_data;
        $this->aparell = $Control_data->index()->aparell;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $ret = cefire::get();
        return $ret->toArray();

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
            $item=array("id"=>$el->id, "name"=>$el->user['name'], "data"=>$el->data, "inici"=>$el->inici->format('H:i:s'), "fi"=>$el->fi->format('H:i:s'));
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
        $data_hui = date('Y-m-d');
        if ($this->aparell == 1){
            if ($request->data != $data_hui){
                return response("Està habilitat el fitxatge per dies. Has de fitxar cada dia", 403);
                //abort(403, 'Està habilitat el fitxatge per dies. Has de fitxar cada dia');
            } else {
                $hora = date('H:i:s');
                if ($request->id == 0){
                    $dat = new cefire();
                    $dat->data = $request->data;
                    $dat->inici = $hora;
                    $dat->fi = "00:00:00";
                    $dat->user_id = auth()->id();
                    $dat->save();
                    $ret = array("id" => $dat->id,"inici" => $dat->inici->format('H:i:s'),"fi" => $dat->fi->format('H:i:s'));
                    return $ret;
                    // return cefire::where('data','=',$request->data)->where('user_id','=',auth()->id())->get();
                } else {
                    $cef=cefire::where('id','=',$request->id)->first();
                    $cef->fi = $hora;
                    $cef->save();
                    $ret = array("id" => $cef->id,"inici" => $cef->inici->format('H:i:s'),"fi" => $cef->fi->format('H:i:s'));
                    return $ret;
                    // return cefire::where('data','=',$request->data)->where('user_id','=',auth()->id())->get();

                }
            }
        } else {
            $hi_ha=cefire::where('user_id','=',auth()->id())->where('data','=',$request->data)->where('inici','=',$request->inici)->first();
            if ($hi_ha) {
                //abort(403, "Ja has fitxat el dia de hui");
                return response("Ja has fitxat", 403);
            } else {
                $dat = new cefire();
                $dat->data = $request->data;
                $dat->inici = $request->inici;
                $dat->fi = $request->fi;
                $dat->user_id = auth()->id();
                $dat->save();
                $ret = array("id" => $dat->id,"inici" => $dat->inici->format('H:i:s'),"fi" => $dat->fi->format('H:i:s'));
                return $ret;
                // return cefire::where('data','=',$request->data)->where('user_id','=',auth()->id())->get();

            }
        }
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
        $comp = new DateTime("00:00:00");
        foreach($cefire as $cef){
            if($cef->fi == $comp) {

            } else {
                if ($cef->data == $data_ant) {
                    $duration = $cef->inici->diffInMinutes($cef->fi);
                    $valor = array_pop($data);
                    array_push($data,($valor+$duration));
                } else {
                    $duration = $cef->inici->diffInMinutes($cef->fi);
                    array_push($labels,$cef->data);
                    array_push($data,$duration);
                }
                $total=$total+$duration;
                $data_ant=$cef->data;
            }

        }
        $ret=array('labels' => $labels, 'data' => $data, 'total' => $total);
        return ($ret);
    }
}
