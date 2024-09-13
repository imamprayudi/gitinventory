<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Maatwebsite\Excel\Facades\Excel;

class IncomingController extends Controller
{
    protected $domain = env('API_BACKEND', 'http://localhost/api_invesa_test/');
    

    public function __construct(){
        $serverName = $_SERVER['SERVER_NAME'] ?? null;
        if (str_contains($serverName, '136.198.117.') || str_contains($serverName, 'localhost'))
        {
            $this->domain =env('API_BACKEND_TEST', 'http://localhost/api_invesa_test/');
        }
    }

    //  **
    //  index
    public function index(Request $request)
    {
        $gitversions = Http::get($this->domain."json_version_sync.php");
        $gitversions = $gitversions['version'];
        return view('admins.input', compact('gitversions'));
    }

    //  ***
    //  loaddata
    public function loaddata(Request $request, $valjmlhal=1)
    {
        // return $valjmlhal;
        // return $request;
        //  action ajax
        if($request->ajax())
        {
            //  variable
            $output     = '';
            $jumlahDataPerHalaman = 10;
            $stdate     = $request->get('stdate');
            $endate     = $request->get('endate');
            $jnsdokbc   = $request->get('jnsdokbc');
            $nodokbc    = $request->get('nodokbc');
            $partno     = $request->get('partno');

            // echo $this->domain."json_input_sync.php";
            // die();
            $counts = Http::get($this->domain."json_input_sync.php",[
                'valstdate' => $stdate,
                'valendate' => $endate,
                'valjnsdok' => $jnsdokbc,
                'valnodok' => $nodokbc,
                'valpartno' => $partno,
                'page' => 0,
                'limit' => 1
            ]);
            // return $counts['totalCount'];
            if(empty($counts['totalCount']))
            {
                $totalcount = 0;
            }
            else
            {
                $totalcount = $counts['totalCount'];
                // foreach($counts as &$row)
                // {
                //     $row        = get_object_vars($row);
                //     $totalcount = $row['totalcount'];
                // }
            }

            if($totalcount > 0)
            {
                $jumlahHalaman          = ceil($totalcount / $jumlahDataPerHalaman);
                $halamanAktif           = intval($valjmlhal);
                $awalData               = (($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman);

                //  mengambil data table
                $sql    = Http::get($this->domain."json_input_sync.php",[
                    'valstdate' => $stdate,
                    'valendate' => $endate,
                    'valjnsdok' => $jnsdokbc,
                    'valnodok' => $nodokbc,
                    'valpartno' => $partno,
                    'page' => $awalData,
                    'limit' => $jumlahDataPerHalaman
                ]);
                // return $sql['rows'];
                $nomor  = $awalData;
                foreach($sql['rows'] as $rowdata)
                {
                    // return $rowdata;
                    $no = ++$nomor;
                    $output .= $this->return_data($no,$rowdata);
                }
            }
            else
            {
                $jumlahHalaman          = ceil($totalcount / $jumlahDataPerHalaman);
                $halamanAktif           = 0;
                $awalData               = (($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman) + 1;
                $output = '
                <tr>
                <td class="text-center" colspan="16">No Data Found</td>
                </tr>
                ';
            }

            $data = array(
                'table_data'    => $output,
                'totalcount'    => $totalcount,
                'halamanAktif'  => $halamanAktif,
                'jumlahHalaman' => $jumlahHalaman
            );
            echo json_encode($data);
            
            //  mengirim data ke view

        }
        else{
           //  menghapus session
           $request->session()->forget('session_gitinventory_id');
           $request->session()->forget('session_gitinventory_userid');
           $request->session()->forget('session_gitinventory_username');
           return redirect('/login');
        }
    }

    public function return_data($no,$rowdata)
    {
        return '<tr>
                    <td align="right"><medium class="text-muted">'.$no.'</medium></td>
                    <td>'.$rowdata['jnsdokbc'].'</td>
                    <td>'.$rowdata['nodokbc'].'</td>
                    <td>'.$rowdata['datedokbc'].'</td>
                    <td>'.$rowdata['buktiterima'].'</td>
                    <td>'.$rowdata['dateterima'].'</td>
                    <td>'.$rowdata['buktiinvoice'].'</td>
                    <td>'.$rowdata['dateinvoice'].'</td>
                    <td>'.$rowdata['supplier'].'</td>
                    <td>'.$rowdata['partno'].'</td>
                    <td>'.$rowdata['partname'].'</td>
                    <td align="right">'.$rowdata['qty'].'</td>
                    <td>'.$rowdata['unit'].'</td>
                    <td align="right">'.$rowdata['price'].'</td>
                    <td>'.$rowdata['currency'].'</td>
                    <td>'.$rowdata['input_user'].'<br>'.$rowdata['input_date'].'</td>
                </tr>';
    }
    //  ***
    //  pagination
    public function pagination(Request $request)
    {
        return $this->loaddata($request,$request->get('jumlahHalaman'));
        
    }

    //  ***
    //  download
    public function download(Request $request)
    {
        $stdate     = $request->get('stdate');
        $endate     = $request->get('endate');
        $jnsdokbc   = $request->get('jnsdokbc');
        $nodokbc    = $request->get('nodokbc');
        $partno     = $request->get('partno');

        //  mengambil data table
        $sql    = Http::get($this->domain . "json_download_incoming.php", [
            'valstdate' => $stdate,
            'valendate' => $endate,
            'valjnsdok' => $jnsdokbc,
            'valnodok' => $nodokbc,
            'valpartno' => $partno
        ]);
        // return $this->domain . "json_download_incoming.php";
        $data = $sql['rows'];
        return $data;
        //  menampilkan view
        return view('download.incoming', compact('data'));
    }
}
