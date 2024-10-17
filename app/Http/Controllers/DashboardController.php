<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Http;

class DashboardController extends Controller
{
    protected $domain = "https://svr1.jkei.jvckenwood.com/";
    protected $url = "api_invesa_test/";
    protected $version = "versioning..";
    
    public function __construct()
    {
        $serverName = $_SERVER['SERVER_NAME'] ?? null;
        if (str_contains($serverName, '136.198.117.') || str_contains($serverName, 'localhost') || str_contains($serverName, '.test')) {
            $this->domain = "http://136.198.117.118/";
        }

        $getVersion = Http::get($this->domain . $this->url . "json_version_sync.php");
        $this->version = $getVersion['version'];
    }

    //  index
    public function index(Request $request)
    {
        //  mengambil data dari database
        $gitversions   = $this->version;

        $get_info           = Http::get($this->domain . $this->url . "json_information.php");

        $lastsyncinvesaweb  = $get_info['lastsyncinvesaweb'][0]['sync_date'];

        $sql_bar_twomonth       = $get_info['sql_bar_twomonth'];
        $sql_docin_twomonth     = $get_info['sql_docin_twomonth'];
        $sql_docout_twomonth    = $get_info['sql_docout_twomonth'];

        $sql_bar_onemonth       = $get_info['sql_bar_onemonth'];
        $sql_docin_onemonth     = $get_info['sql_docin_onemonth'];
        $sql_docout_onemonth    = $get_info['sql_docout_onemonth'];

        $sql_bar_currmonth      = $get_info['sql_bar_currmonth'];
        $sql_docin_currmonth    = $get_info['sql_docin_currmonth'];
        $sql_docout_currmonth   = $get_info['sql_docout_currmonth'];

        //  menampilkan view
        return view('dashboard', compact('gitversions','lastsyncinvesaweb', 
                    'sql_bar_twomonth', 'sql_docin_twomonth', 'sql_docout_twomonth',
                    'sql_bar_onemonth', 'sql_docin_onemonth', 'sql_docout_onemonth',
                    'sql_bar_currmonth', 'sql_docin_currmonth', 'sql_docout_currmonth'));
    }

    public function index_old(Request $request)
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
            $response           = Http::get('https://svr1.jkei.jvckenwood.com/api_invesa_test/json_version_sync.php');
            $obj                = json_decode($response);
            $gitversions        = $obj->version;
        }

        //  return view
        //  **
        return view('dashboard', compact('gitversions'));
    }
}
