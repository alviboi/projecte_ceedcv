<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;

class UserController extends Controller
{
    public function home (){
        $conta = User::find(auth()->id())->notificacions()->count();
        return view('home', ['conta' => $conta]);
    }

    public function get_usuaris_ldap(Request $request)
    {

            //Cal identificar-se amb l'usuari netadmin
            //uid=alfredo@alfredo.es,ou=Teachers,ou=People,dc=ma5,dc=lliurex,dc=net
            $pwd=$request->contrasenya;
            $conn = ldap_connect($request->ip, '389');
            $bindDn = "uid=netadmin,ou=Admins,ou=People,dc=ma5,dc=lliurex,dc=net";
            ldap_set_option($conn, LDAP_OPT_PROTOCOL_VERSION, 3);

            $ldaptree="ou=Teachers,ou=People,dc=ma5,dc=lliurex,dc=net";


            if($conn) {

                $ldapbind = ldap_bind($conn, $bindDn, $pwd) or die ("Ha hagut un error: ".ldap_error($conn));

                if ($ldapbind) {

                    $result = ldap_search($conn,$ldaptree, "(cn=*)") or die ("Ha hagut un error: ".ldap_error($conn));
                    $data = ldap_get_entries($conn, $result);

                    $usuaris=array();
                    for ($i=0; $i<$data["count"]; $i++) {
                        $el=['email' => $data[$i]["uid"][0], 'name' =>  $data[$i]["description"][0]];
                        array_push($usuaris,$el);
                        }
                    return $usuaris;
                    ldap_close($conn);
                } else {
                    ldap_close($conn);
                    return "El servidor no està ben configurat. Revisa la configuració";
                }


            }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function get_user()
    {
        //
        return User::find(auth()->id());
    }
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
    public function destroy($user)
    {
        //
        User::find($user)->delete();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        $user=User::find($request->id);
        $user->name=$request->nom;
        $user->email=$request->mail;
        $user->Perfil=$request->perfil;
        $user->rfid=$request->rfid;
        if($user->contrasenya != ""){
            $user->password=$request->contrasenya;
        }
        $user->save();



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
        if(!empty($cefire[0])){
            $ret1 = array("id" => $cefire[0]->id, "user_id" => $cefire[0]->user_id,"inici" => $cefire[0]->inici->format('H:i'),"fi" => $cefire[0]->fi->format('H:i'));
            $ret2=[$ret1];
            return $ret2;
        } else {
            return "0";
        }

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
        return User::find($num)->guardia()->whereMonth('data', '=', date($mes))->whereYear('data', '=', date($any))->get();
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
    public function get_all($de,$fins)
    {
        //
        $cefire = User::find(auth()->id())->cefire()->where('data','>',$de)->where('fi','<',$fins)->get();
        $compensa = User::find(auth()->id())->compensa()->where('data','>',$de)->where('fi','<',$fins)->get();
        $curs = User::find(auth()->id())->curs()->where('data','>',$de)->where('fi','<',$fins)->get();
        $guardia = User::find(auth()->id())->guardia()->where('data','>',$de)->where('fi','<',$fins)->get();
        $permis = User::find(auth()->id())->permis()->where('data','>',$de)->where('fi','<',$fins)->get();
        $visita = User::find(auth()->id())->visita()->where('data','>',$de)->where('fi','<',$fins)->get();
        $ret=[
            'cefire' => $cefire,
            'compensa' => $compensa,
            'curs' => $curs,
            'guardia' => $guardia,
            'permis' => $permis,
            'visita' => $visita
        ];
        return $ret;



    }
}
