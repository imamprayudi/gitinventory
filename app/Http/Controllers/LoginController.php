<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Http;

class LoginController extends Controller
{
    //  index
    public function index(Request $request)
    {
        //  menghapus session
        //  **
        $request->session()->forget('session_gitinventory_id');
        $request->session()->forget('session_gitinventory_userid');
        $request->session()->forget('session_gitinventory_username');

        //  return view
        //  **
        return view('login');
    }

    //  post login
    public function postlogin(Request $request)
    {
        //  daftarpustaka
        //  https://www.parthpatel.net/php-json-decode-function/

        //  variable
        $userid     = $request->userid;
        $userpass   = $request->password;

        //  cek ip access
        //  **
        if (str_contains($_SERVER['SERVER_NAME'], '136.198.117.') || str_contains($_SERVER['SERVER_NAME'], 'localhost'))
        {
            //  mengambil data dari json
            //  **
            $response = Http::get('http://136.198.117.118/api_invesa_test/json_login_sync.php', [
                'valuserid' => $userid,
                'valuserpass' => $userpass,
                'valipaddress' => getenv("REMOTE_ADDR"),
                'sql'        => "call sync_check_login {$userid}, {$userpass}, {getenv(\"REMOTE_ADDR\")}"
            ]);
        }
        else
        {
            //  mengambil data dari json
            //  **
            // $response = Http::get('https://svr1.jvc-jein.co.id/api_invesa_test/json_login_sync.php', [
            $response = Http::get('https://svr1.jkei.jvckenwood.com/api_invesa_test/json_login_sync.php', [
                'valuserid' => $userid,
                'valuserpass' => $userpass,
                'valipaddress' => getenv("REMOTE_ADDR"),
                'sql'        => "call sync_check_login {$userid}, {$userpass}, {getenv(\"REMOTE_ADDR\")}"
            ]);
        }

        //  cek response message
        //  **
        $obj = json_decode($response);
        // return $obj;
        if ($obj->message == 'Failure')
        {
            return redirect('/login')->with('status', 'Wrong email and password combination.');
        }

        //  buat session
        //  **
        $request->session()->put('session_gitinventory_id',$obj->id);
        $request->session()->put('session_gitinventory_userid',$obj->login);
        $request->session()->put('session_gitinventory_username',$obj->name);

        //  return view
        //  **
        return redirect('/home');
    }
}
