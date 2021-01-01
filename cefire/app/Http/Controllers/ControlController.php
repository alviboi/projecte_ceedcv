<?php

namespace App\Http\Controllers;
use App\Models\control;

use Illuminate\Http\Request;


use Illuminate\Support\Facades\Route;




class ControlController extends Controller
{
    // public function welcome (){
    //     $reg = control::find(1)->registra;
    //     if ($reg == 0){
    //         Auth::routes(['register' => false]);
    //     }
    //     Auth::routes(['register' => false]);
    //     return view('welcome');
    // }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return control::find(1);

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
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $con = control::find(1);
        if (isset($request->aparell)){
            $con->aparell = $request->aparell;
        }
        if (isset($request->registra)){
            $con->registra = $request->registra;
        }
        $con->save();
        return "S'han actualitzat les dades";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
