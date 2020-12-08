<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return User::orderBy('name', 'ASC')->get();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function dia_cefire($dia,$mati)
    {
        //
        if ($mati == 'm') $control='<'; else $control='>';
        $cefire = User::find(auth()->id())->cefire()->where('data','=',$dia)->where('fi',$control,'15:00:00')->get();
        return $cefire;
    }
    public function dia_guardia($dia,$mati)
    {
        //
        if ($mati == 'm') $control='<'; else $control='>';
        $cefire = User::find(auth()->id())->guardia()->where('data','=',$dia)->where('fi',$control,'15:00:00')->get();
        return $cefire;
    }
    public function dia_curs($dia,$mati)
    {
        //
        if ($mati == 'm') $control='<'; else $control='>';
        $cefire = User::find(auth()->id())->curs()->where('data','=',$dia)->where('fi',$control,'15:00:00')->get();
        return $cefire;
    }
    public function dia_compensa($dia,$mati)
    {
        //
        if ($mati == 'm') $control='<'; else $control='>';
        $cefire = User::find(auth()->id())->compensa()->where('data','=',$dia)->where('fi',$control,'15:00:00')->get();
        return $cefire;
    }
    public function dia_visita($dia,$mati)
    {
        //
        if ($mati == 'm') $control='<'; else $control='>';
        $cefire = User::find(auth()->id())->visita()->where('data','=',$dia)->where('fi',$control,'15:00:00')->get();
        return $cefire;
    }
    public function dia_permis($dia,$mati)
    {
        //
        if ($mati == 'm') $control='<'; else $control='>';
        $cefire = User::find(auth()->id())->permis()->where('data','=',$dia)->where('fi',$control,'15:00:00')->get();
        return $cefire;
    }
    /**
     * Torna totes les etiquetes cefire d'un mes determinat
     * @num id de l'assessspr
     * @any any que volem conèixer
     * @mes mes que volem conèixer
     *
     */

    public function get_cefire(Request $request, $num,$any,$mes)
    {
        //
        return User::find($num)->cefire()->whereMonth('data', '=', date($mes))->whereYear('data', '=', date($any))->get();
    }

    /**
     * Torna totes les etiquetes cefire d'un mes determinat
     * @num id de l'assessspr
     * @any any que volem conèixer
     * @mes mes que volem conèixer
     *
     */

    public function get_guardia(Request $request, $num,$any,$mes)
    {
        //
        return User::find($num)->cefire()->whereMonth('data', '=', date($mes))->whereYear('data', '=', date($any))->get();
    }

        /**
     * Torna totes les etiquetes cefire d'un mes determinat
     * @num id de l'assessspr
     * @any any que volem conèixer
     * @mes mes que volem conèixer
     *
     */

    public function get_curs(Request $request, $num,$any,$mes)
    {
        //
        return User::find($num)->curs()->whereMonth('data', '=', date($mes))->whereYear('data', '=', date($any))->get();
    }

        /**
     * Torna totes les etiquetes cefire d'un mes determinat
     * @num id de l'assessspr
     * @any any que volem conèixer
     * @mes mes que volem conèixer
     *
     */

    public function get_compensa(Request $request, $num,$any,$mes)
    {
        //
        return User::find($num)->compensa()->whereMonth('data', '=', date($mes))->whereYear('data', '=', date($any))->get();
    }

        /**
     * Torna totes les etiquetes cefire d'un mes determinat
     * @num id de l'assessspr
     * @any any que volem conèixer
     * @mes mes que volem conèixer
     *
     */

    public function get_visita(Request $request, $num,$any,$mes)
    {
        //
        return User::find($num)->visita()->whereMonth('data', '=', date($mes))->whereYear('data', '=', date($any))->get();
    }

        /**
     * Torna totes les etiquetes cefire d'un mes determinat
     * @num id de l'assessspr
     * @any any que volem conèixer
     * @mes mes que volem conèixer
     *
     */

    public function get_permis(Request $request, $num,$any,$mes)
    {
        //
        return User::find($num)->permis()->whereMonth('data', '=', date($mes))->whereYear('data', '=', date($any))->get();
    }
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        //
    }
}
