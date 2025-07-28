<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Http;
use App\Http\Traits\ApiConfigurationTrait;

class HomeController extends Controller
{
    use ApiConfigurationTrait;
    
    /**
     * Constructor - inisialisasi konfigurasi API
     */
    public function __construct()
    {
        $this->initializeApiConfiguration();
    }

    public function index(Request $request)
    {
        //  mengambil data dari database
        $gitversions = $this->getVersionSafely(); // Ganti dari getVersion()
        $fullnames          = $request->session()->get('session_gitinventory_username');
        $userid          = $request->session()->get('session_gitinventory_userid');

        $get_info = $this->makeApiRequest('json_information.php');

        if ($get_info) {
            $lastsyncinvesaweb  = $get_info['lastsyncinvesaweb'][0]['sync_date'] ?? 'N/A';

            $sql_bar_twomonth       = $get_info['sql_bar_twomonth'] ?? [];
            $sql_docin_twomonth     = $get_info['sql_docin_twomonth'] ?? [];
            $sql_docout_twomonth    = $get_info['sql_docout_twomonth'] ?? [];

            $sql_bar_onemonth       = $get_info['sql_bar_onemonth'] ?? [];
            $sql_docin_onemonth     = $get_info['sql_docin_onemonth'] ?? [];
            $sql_docout_onemonth    = $get_info['sql_docout_onemonth'] ?? [];

            $sql_bar_currmonth      = $get_info['sql_bar_currmonth'] ?? [];
            $sql_docin_currmonth    = $get_info['sql_docin_currmonth'] ?? [];
            $sql_docout_currmonth   = $get_info['sql_docout_currmonth'] ?? [];
        } else {
            // Fallback data jika API gagal
            $lastsyncinvesaweb = 'Data tidak tersedia';
            $sql_bar_twomonth = $sql_docin_twomonth = $sql_docout_twomonth = [];
            $sql_bar_onemonth = $sql_docin_onemonth = $sql_docout_onemonth = [];
            $sql_bar_currmonth = $sql_docin_currmonth = $sql_docout_currmonth = [];
        }
        
        //  menampilkan view
        return view('admin.home', compact('gitversions', 'fullnames', 'lastsyncinvesaweb', 
                    'sql_bar_twomonth', 'sql_docin_twomonth', 'sql_docout_twomonth',
                    'sql_bar_onemonth', 'sql_docin_onemonth', 'sql_docout_onemonth',
                    'sql_bar_currmonth', 'sql_docin_currmonth', 'sql_docout_currmonth',
                    'userid'));
    }
}
