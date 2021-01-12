<?php

namespace App\Http\Controllers;
use App\Events\GuardiaBorrada;

use App\Events\GuardiaAfegida;
use App\Events\GuardiaBorradaGeneral;

use App\Events\GuardiaAfegidaGeneral;
use App\Mail\EnviarGuardia;

use App\Models\guardia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Jobs\SendGuardiaMail;
use Carbon\Carbon;


class guardiaController extends Controller
{
    /**
     * Mostra un llistat de tot el recurs
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return guardia::get();
    }
    /**
     * Extrau totes les dades de fitxar del guardia amb el nom
     *
     * @return \Illuminate\Http\Response
     */
    public function get_data_index($any, $mes)
    {
        $ret = array();
        $els = guardia::whereMonth('data', '=', date($mes))->whereYear('data', '=', date($any))->get();
        foreach ($els as $el) {
            $item=array("id"=>$el->id, "name"=>$el->user['name'], "data"=>$el->data, "inici"=>$el->inici, "fi"=>$el->fi);
            array_push($ret, $item);
        }
        return $ret;
    }
    /**
     * Mostra un llistat de tot el recurs
     *
     * @return \Illuminate\Http\Response
     */
    public function get_data_index2($mes, $any)
    {

        $ret = array();
        $guardies = guardia::whereMonth('data', '=', date($mes))->whereYear('data', '=', date($any))->get();
        foreach ($guardies as $guardia) {
            array_push($ret, [$guardia->user['name'],$guardia->data,$guardia->inici,$guardia->id]);
        }
        return $ret;
    }

    /**
     * Mostra un llistat de tot el recurs
     *
     * @return \Illuminate\Http\Response
     */
    public function put_guardia_id(Request $request)
    {
        $guardia = new guardia();
        $guardia->user_id=$request->id;
        $guardia->data=$request->data;
        if ($request->mati=="m"){
            $guardia->inici="09:00:00";
            $guardia->fi="14:00:00";
            $txt_rato="MATÍ";
        } else {
            $guardia->inici="16:00:00";
            $guardia->fi="20:00:00";
            $txt_rato="VESPRADA";
        }

        $guardia->save();

        $env=$guardia->toArray();
        $env['nom']=$guardia->user['name'];

        broadcast(new GuardiaAfegida(auth()->id(), $guardia->toArray(),$request->mati))->toOthers();
        broadcast(new GuardiaAfegidaGeneral($env))->toOthers();



        $link="https://calendar.google.com/calendar/render?action=TEMPLATE&text=GUARDIA+CEFIRE&dates=".$guardia->data."T".$guardia->inici."/".$guardia->data."T".$guardia->fi."&details=Guardia+del+Cefire+de+Valencia&location=Valencia&trp=false#eventpage_6";

        $datos = [
            'nombre' => $guardia->user['name'],
            'fecha' => date("d/m/Y", strtotime($guardia->data)),
            'rato' => $txt_rato,
            'link' => $link
        ];
        // SendGuardiaMail::dispatch($guardia->user['email'],$datos);
        // Mail::to($guardia->user['email'])->send(new EnviarGuardia($datos));

        $emailJob = (new SendGuardiaMail($guardia->user['email'],$datos))->delay(Carbon::now()->addSeconds(120));
   		dispatch($emailJob);
        return $guardia;



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
        $dat = new guardia();
        $dat->data = $request->data;
        $dat->inici = $request->inici;
        $dat->fi = $request->fi;
        $dat->user_id = auth()->id();
        $dat->save();
        return $dat->toArray();
    }

    /**
     * Mostra l'element del curs
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
     * Actualitza l'element del recurs a la base de dades
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
     * Elimina l'element  del recurs de la base de dades
     *
     * @param  \App\Models\cefire  $cefire
     * @return \Illuminate\Http\Response
     */
    public function destroy($guardia)
    {
        //
        $guardia = guardia::find($guardia);
        if($guardia->inici == "09:00:00"){
            $m='m';
        }else{
            $m='v';
        }
        broadcast(new GuardiaBorrada(auth()->id(), $guardia->toArray(),$m))->toOthers();
        broadcast(new GuardiaBorradaGeneral($guardia->toArray()))->toOthers();

        $guardia->delete();

    }
}
