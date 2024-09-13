<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Http;

class DashboardController extends Controller
{
    protected $domain = env('API_BACKEND', 'http://localhost/api_invesa_test/');
    
    public function __construct()
    {
        $serverName = $_SERVER['SERVER_NAME'] ?? null;
        if (str_contains($serverName, '136.198.117.') || str_contains($serverName, 'localhost')) {
            $this->domain = env('API_BACKEND_TEST', 'http://localhost/api_invesa_test/');
        }
    }
    //  index
    public function index(Request $request)
    {
        //  menghapus session
        //  **
        $request->session()->forget('session_gitinventory_id');
        $request->session()->forget('session_gitinventory_userid');
        $request->session()->forget('session_gitinventory_username');

        //  mengambil data dari json
        //  **
        $response           = Http::get($this->domain . 'json_version_sync.php');
        $obj                = json_decode($response);
        $gitversions        = $obj->version;
        
        //  return view
        //  **
        return view('dashboard', compact('gitversions'));
    }
}
