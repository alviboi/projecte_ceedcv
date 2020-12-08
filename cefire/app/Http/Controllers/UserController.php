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


    public function este(Request $request, $num)
    {
        //
        return User::find(auth()->id())->cefire()->get();
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
