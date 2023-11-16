<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Helper;

class GudangumumController extends Controller
{
    protected $domain = "https://svr1.jkei.jvckenwood.com/";
    protected $url = "api_invesa_test/";

    public function __construct(){
        if (str_contains($_SERVER['SERVER_NAME'], '136.198.117.') || str_contains($_SERVER['SERVER_NAME'], 'localhost'))
        {
            $this->domain ="http://136.198.117.118/";
        }
    }
    //  **
    //  index
    public function index(Request $request)
    {
        $gitversions = Http::get($this->domain.$this->url."json_version_sync.php");
        $gitversions = $gitversions['version'];
        return view('admins.gudangumum', compact('gitversions'));
    }

    //  ***
    //  loaddata
    public function loaddata(Request $request,$valjmlhal=1,$jumlahDataPerHalaman=10)
    {
        if($request->ajax())
        {
            // parameter
            $halamanAktif   = intval($valjmlhal);
            $stdate         = $request->get('stdate');
            $endate         = $request->get('endate');
            $partno         = $request->get('partno');
            $awalData       = (($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman);

            $data = Http::get($this->domain.$this->url.'json_gudangumum.php',[
                'valstdate' => $stdate,
                'valendate' => $endate,
                'valpartno' => $partno,
                'start' => $awalData,
                'limit' => $jumlahDataPerHalaman
            ]);
            // return $data;
            $totalcount = $data['totalCount'];
            $jumlahHalaman  = ceil($totalcount / $jumlahDataPerHalaman);
            $header = Helper::return_data_header($data['rows']);

            if($data['totalCount'] == 0){
                $halamanAktif   = $halamanAktif - 1;
                $awalData       = $awalData + 1;
                $output         = Helper::no_data();
            }
            else{
                $output = Helper::return_data_mutate($awalData,$data['rows']);
            }

            return [
                'header'        => $header,
                'table_data'    => $output,
                'totalcount'    => $totalcount,
                'halamanAktif'  => $halamanAktif,
                'jumlahHalaman' => $jumlahHalaman
            ];
        }
        else{
           //  menghapus session
           $request->session()->forget('session_gitinventory_id');
           $request->session()->forget('session_gitinventory_userid');
           $request->session()->forget('session_gitinventory_username');
           return redirect('/login');
        }
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
        //  global variable
        $stdate     = $request->get('stdate');
        $endate     = $request->get('endate');
        // $jnsdokbc   = $request->get('jnsdokbc');
        // $nodokbc    = $request->get('nodokbc');
        $partno     = $request->get('partno');
        $filename   = 'Laporan Mutasi Gudang Umum';

        //  execute database
        // $datas  = DB::select("call sync_down_input('{$stdate}', '{$endate}', '{$jnsdokbc}', '{$nodokbc}', '{$partno}');");
        $datas = Http::get($this->domain.$this->url.'json_gudangumum.php',[
                    'valstdate' => $stdate,
                    'valednate' => $endate,
                    'valpartno' => $partno
                ]);
        //  untuk meyimpan data di excel
        header("Content-type: application/vnd-ms-excel");
        header("Content-Disposition: attachment; filename=". $filename .".xls");
        echo '<table>';
            echo '<tr>';
            echo '<th colspan="6" style="font-size:18pt;" align="left">LAPORAN MUTASI GUDANG UMUM</th>';
            echo '</tr>';
            echo '<tr>';
                echo '<th></th>';
            echo '</tr>';
        echo '</table>';
        echo '<table border="1">';
            echo '<tr>';
                echo '<th bgcolor="#C0C0C0" rowspan="2">No</th>';
                echo '<th bgcolor="#C0C0C0" colspan="3">Dokumen Pabean</th>';
                echo '<th bgcolor="#C0C0C0" colspan="2">Bukti Penerimaan Barang</th>';
                echo '<th bgcolor="#C0C0C0" colspan="2">Invoice</th>';
                echo '<th bgcolor="#C0C0C0" rowspan="2">Pengirim</th>';
                echo '<th bgcolor="#C0C0C0" rowspan="2">Kode Barang</th>';
                echo '<th bgcolor="#C0C0C0" rowspan="2">Nama Barang</th>';
                echo '<th bgcolor="#C0C0C0" rowspan="2">Jumlah</th>';
                echo '<th bgcolor="#C0C0C0" rowspan="2">Satuan</th>';
                echo '<th bgcolor="#C0C0C0" rowspan="2">Nilai</th>';
                echo '<th bgcolor="#C0C0C0" rowspan="2">Mata Uang</th>';
                echo '<th bgcolor="#C0C0C0" rowspan="2">User</th>';
            echo '</tr>';
            echo '<tr>';
                echo '<th bgcolor="#C0C0C0">Jenis</th>';
                echo '<th bgcolor="#C0C0C0">No</th>';
                echo '<th bgcolor="#C0C0C0">TGL</th>';
                echo '<th bgcolor="#C0C0C0">No</th>';
                echo '<th bgcolor="#C0C0C0">TGL</th>';
                echo '<th bgcolor="#C0C0C0">No</th>';
                echo '<th bgcolor="#C0C0C0">TGL</th>';
            echo '</tr>';
        $no = 1;
        for ($i = 0; $i < count($datas); $i++) {
            $rowdata = $datas[$i];

            echo '<tr>';
                echo '<td align="right">'.$no.'</td>';
                echo '<td>'.$rowdata->jnsdokbc.'</td>';
                echo '<td>'.$rowdata->nodokbc.'</td>';
                echo '<td>'.$rowdata->datedokbc.'</td>';
                echo '<td>'.$rowdata->buktiterima.'</td>';
                echo '<td>'.$rowdata->dateterima.'</td>';
                echo '<td>'.$rowdata->buktiinvoice.'</td>';
                echo '<td>'.$rowdata->dateinvoice.'</td>';
                echo '<td>'.$rowdata->supplier.'</td>';
                echo '<td>'.$rowdata->partno.'</td>';
                echo '<td>'.$rowdata->partname.'</td>';
                echo '<td align="right">'.number_format($rowdata->qty, 0).'</td>';
                echo '<td>'.$rowdata->unit.'</td>';
                echo '<td align="right">'.number_format($rowdata->price, 0).'</td>';
                echo '<td>'.$rowdata->currency.'</td>';
                echo '<td>'.$rowdata->input_user.'<br>'.$rowdata->input_date.'</td>';
            echo '</tr>';
            $no++;
        }
        echo '</table>';
    }
}
