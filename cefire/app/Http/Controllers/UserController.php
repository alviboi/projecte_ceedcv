<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{


    /**
     * Get the comments cefire data.
     */
    public function cefire()
    {
        return $this->hasMany('App\Models\cefire');
    }
    /**
     * Get the comments permis data.
     */
    public function permis()
    {
        return $this->hasMany('App\Models\permis');
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
