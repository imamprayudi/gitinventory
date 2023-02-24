<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Http;

class DashboardController extends Controller
{
    //  index
    public function index(Request $request)
    {
        //  menghapus session
        //  **
        $request->session()->forget('session_gitinventory_id');
        $request->session()->forget('session_gitinventory_userid');
        $request->session()->forget('session_gitinventory_username');

        //  cek ip access
        //  **
        if (str_contains($_SERVER['SERVER_NAME'], '136.198.117.') || str_contains($_SERVER['SERVER_NAME'], 'localhost'))
        { 
            //  mengambil data dari json
            //  **
            $response           = Http::get('http://136.198.117.118/api_invesa_test/json_version_sync.php');
            $obj                = json_decode($response);
            $gitversions        = $obj->version;
        }
        else
        {
            //  mengambil data dari json
            //  **
            $response           = Http::get('https://svr1.jvc-jein.co.id/api_invesa_test/json_version_sync.php');
            $obj                = json_decode($response);
            $gitversions        = $obj->version;
        }

        //  return view
        //  **
        return view('dashboard', compact('gitversions'));
    }
}
