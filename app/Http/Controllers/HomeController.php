<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
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

    public function index(Request $request)
    {
        //  mengambil data dari database
        $gitversions   = $this->version;
        $fullnames          = $request->session()->get('session_gitinventory_username');

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

        // dd($get_info);
        
        //  menampilkan view
        return view('admin.home', compact('gitversions', 'fullnames', 'lastsyncinvesaweb', 
                    'sql_bar_twomonth', 'sql_docin_twomonth', 'sql_docout_twomonth',
                    'sql_bar_onemonth', 'sql_docin_onemonth', 'sql_docout_onemonth',
                    'sql_bar_currmonth', 'sql_docin_currmonth', 'sql_docout_currmonth'));
    }
}
