<?php

namespace App\Http\Controllers;

use App\Events\MailEntrada;
use App\Models\notificacions;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use App\Jobs\SendMissatgeMail;
use Carbon\Carbon;

use App\Mail\EnviarMissatge;


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
        $els = notificacions::where('user_id','=',auth()->id())->get();
        foreach ($els as $el) {
            $user=user::find($el->From);
            $item=array("id"=>$el->id, "name"=>$user->name, "From"=>$el->From, "user_id"=>$el->user_id, "cap"=>$el->cap, "missatge"=>$el->missatge);
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

        $datos = [
            'De' => Auth::user()->name,
            'Cap' => $notificacio->cap,
            'missatge' => $notificacio->missatge
        ];


        $item=array("id"=>$notificacio->id, "name"=>$notificacio->user['name'], "From"=>$notificacio->From, "user_id"=>$notificacio->user_id, "cap"=>$notificacio->cap, "missatge"=>$notificacio->missatge);
        broadcast(new MailEntrada($notificacio->user_id, $item))->toOthers();

        $emailJob = (new SendMissatgeMail($notificacio->user['email'],$datos))->delay(Carbon::now()->addSeconds(120));
   		dispatch($emailJob);



        if ($err && $emailJob){
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
