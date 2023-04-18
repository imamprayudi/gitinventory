<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ProductionController extends Controller
{
    //  **
    //  index
    public function index(Request $request)
    {
        //  **
        //  mengambil data version
        //  **
        if (str_contains($_SERVER['SERVER_NAME'], '136.198.117.') || str_contains($_SERVER['SERVER_NAME'], 'localhost'))
        { 
            //  mengambil data dari json
            //  **
            $gitversions = Http::get('http://136.198.117.118/api_invesa_test/json_version_sync.php');
        }
        else
        {
            //  mengambil data dari json
            //  **
            $gitversions = Http::get('https://svr1.jvc-jein.co.id/api_invesa_test/json_version_sync.php');
        }
        
        
        // $gitversions = DB::table('tbl_sync_version')->get();

        //  **
        //  return view
        return view('admins.production', compact('gitversions'));
    }

    //  ***
    //  loaddata
    public function loaddata(Request $request)
    {
        // return $request;
        // return $request->ajax();
        //  action ajax
        if($request->ajax())
        {
            //  variable
            $output     = '';
            $jumlahDataPerHalaman = 10;
            $halamanAktif= 1;
            $awalData   = (($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman);
            $stdate     = $request->get('stdate');
            $endate     = $request->get('endate');
            $jnsdokbc   = $request->get('jnsdokbc');
            $nodokbc    = $request->get('nodokbc');
            $partno     = $request->get('partno');

            //  konfigurasi pagination
            // $totalcount = DB::select("call sync_disp_input(0, 1, '{$stdate}', '{$endate}', '{$jnsdokbc}', '{$nodokbc}', '{$partno}');");
            if (str_contains($_SERVER['SERVER_NAME'], '136.198.117.') || str_contains($_SERVER['SERVER_NAME'], 'localhost'))
            { 
                //  mengambil data dari json
                //  **
                $data = Http::get('http://136.198.117.118/api_invesa_test/json_production.php',[
                    'valstdate' => $stdate,
                    'valednate' => $endate,
                    'valjnsdok' => $jnsdokbc,
                    'valnodok' => $nodokbc,
                    'valpartno' => $partno,
                    'start' => $awalData,
                    'limit' => $jumlahDataPerHalaman
                ]);
            }
            else
            {
                //  mengambil data dari json
                //  **
                $data = Http::get('https://svr1.jvc-jein.co.id/api_invesa_test/json_production.php',[
                    'valstdate' => $stdate,
                    'valednate' => $endate,
                    'valjnsdok' => $jnsdokbc,
                    'valnodok' => $nodokbc,
                    'valpartno' => $partno,
                    'start' => $awalData,
                    'limit' => $jumlahDataPerHalaman
                ]);
            }
            // return $data;
            $totalcount = $data['totalCount'];
            if($totalcount > 0){
                $jumlahHalaman          = ceil($totalcount / $jumlahDataPerHalaman);
                // $halamanAktif           = 1;
                // $awalData               = (($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman);

                // //  mengambil data table
                // $sql    = DB::select("call sync_disp_input({$awalData}, {$jumlahDataPerHalaman}, '{$stdate}', '{$endate}', '{$jnsdokbc}', '{$nodokbc}', '{$partno}');");
                $nomor  = $awalData;
                foreach($data['rows'] as $rowdata)
                {
                    $no = ++$nomor;
                    $output .= '
                    <tr>
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
                        <td align="right">'.number_format($rowdata['qty'], 0).'</td>
                        <td>'.$rowdata['unit'].'</td>
                        <td align="right">'.number_format($rowdata['price'], 0).'</td>
                        <td>'.$rowdata['currency'].'</td>
                        <td class="text-center">'.$rowdata['input_user'].'<br>'.$rowdata['input_date'].'</td>
                    </tr>
                    ';
                }
            }
            else{
                $jumlahHalaman          = ceil($totalcount / $jumlahDataPerHalaman);
                // $halamanAktif           = 0;
                // $awalData               = (($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman) + 1;
                $output = '
                <tr>
                <td class="text-center" colspan="16">No Data Found</td>
                </tr>
                ';
            }
            // if(empty($totalcount))
            // {
            //     $totalcount = 0;
            // }
            // else
            // {
            //     foreach($counts as &$row)
            //     {
            //         $row        = get_object_vars($row);
            //         $totalcount = $row['totalcount'];
            //     } 
            // }
            
            // //  check total data
            // if($totalcount > 0)
            // {
            //     $jumlahHalaman          = ceil($totalcount / $jumlahDataPerHalaman);
            //     $halamanAktif           = 1;
            //     $awalData               = (($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman);

            //     //  mengambil data table
            //     $sql    = DB::select("call sync_disp_input({$awalData}, {$jumlahDataPerHalaman}, '{$stdate}', '{$endate}', '{$jnsdokbc}', '{$nodokbc}', '{$partno}');");
            //     $nomor  = $awalData;
            //     foreach($sql as $rowdata)
            //     {
            //         $no = ++$nomor;
            //         $output .= '
            //         <tr>
            //             <td align="right"><medium class="text-muted">'.$no.'</medium></td>
            //             <td>'.$rowdata->jnsdokbc.'</td>
            //             <td>'.$rowdata->nodokbc.'</td>
            //             <td>'.$rowdata->datedokbc.'</td>
            //             <td>'.$rowdata->buktiterima.'</td>
            //             <td>'.$rowdata->dateterima.'</td>
            //             <td>'.$rowdata->buktiinvoice.'</td>
            //             <td>'.$rowdata->dateinvoice.'</td>
            //             <td>'.$rowdata->supplier.'</td>
            //             <td>'.$rowdata->partno.'</td>
            //             <td>'.$rowdata->partname.'</td>
            //             <td align="right">'.number_format($rowdata->qty, 0).'</td>
            //             <td>'.$rowdata->unit.'</td>
            //             <td align="right">'.number_format($rowdata->price, 0).'</td>
            //             <td>'.$rowdata->currency.'</td>
            //             <td class="text-center">'.$rowdata->input_user.'<br>'.$rowdata->input_date.'</td>
            //         </tr>
            //         ';
            //     }
            // }
            // else
            // {
            //     $jumlahHalaman          = ceil($totalcount / $jumlahDataPerHalaman);
            //     $halamanAktif           = 0;
            //     $awalData               = (($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman) + 1;
            //     $output = '
            //     <tr>
            //     <td class="text-center" colspan="16">No Data Found</td>
            //     </tr>
            //     ';
            // }
            
            // //  mengirim data ke view
            $data = array(
                'table_data'    => $output,
                'totalcount'    => $totalcount,
                'halamanAktif'  => $halamanAktif,
                'jumlahHalaman' => $jumlahHalaman
            );
            echo json_encode($data);
        }
        else{
           //  menghapus session
           $request->session()->forget('session_gitinventory_id');
           $request->session()->forget('session_gitinventory_userid');
           $request->session()->forget('session_gitinventory_username');
           return redirect('/logins');
        }
    }

    //  ***
    //  pagination
    public function pagination(Request $request)
    {
        //  action ajax
        if($request->ajax())
        {
            //  variable
            $output     = '';
            $jumlahDataPerHalaman = 10;
            $valjmlhal  = $request->get('jumlahHalaman');
            $stdate     = $request->get('stdate');
            $endate     = $request->get('endate');
            $jnsdokbc   = $request->get('jnsdokbc');
            $nodokbc    = $request->get('nodokbc');
            $partno     = $request->get('partno');

            //  konfigurasi pagination
            $counts = DB::select("call sync_disp_input(0, 1, '{$stdate}', '{$endate}', '{$jnsdokbc}', '{$nodokbc}', '{$partno}');");
            if(empty($counts))
            {
                $totalcount = 0;
            }
            else
            {
                foreach($counts as &$row)
                {
                    $row        = get_object_vars($row);
                    $totalcount = $row['totalcount'];
                } 
            }
            
            //  check total data
            if($totalcount > 0)
            {
                $jumlahHalaman          = ceil($totalcount / $jumlahDataPerHalaman);
                $halamanAktif           = intval($valjmlhal);
                $awalData               = (($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman);

                //  mengambil data table
                $sql    = DB::select("call sync_disp_input({$awalData}, {$jumlahDataPerHalaman}, '{$stdate}', '{$endate}', '{$jnsdokbc}', '{$nodokbc}', '{$partno}');");
                $nomor  = $awalData;
                foreach($sql as $rowdata)
                {
                    $no = ++$nomor;
                    $output .= '
                    <tr>
                        <td align="right"><medium class="text-muted">'.$no.'</medium></td>
                        <td>'.$rowdata->jnsdokbc.'</td>
                        <td>'.$rowdata->nodokbc.'</td>
                        <td>'.$rowdata->datedokbc.'</td>
                        <td>'.$rowdata->buktiterima.'</td>
                        <td>'.$rowdata->dateterima.'</td>
                        <td>'.$rowdata->buktiinvoice.'</td>
                        <td>'.$rowdata->dateinvoice.'</td>
                        <td>'.$rowdata->supplier.'</td>
                        <td>'.$rowdata->partno.'</td>
                        <td>'.$rowdata->partname.'</td>
                        <td align="right">'.number_format($rowdata->qty, 0).'</td>
                        <td>'.$rowdata->unit.'</td>
                        <td align="right">'.number_format($rowdata->price, 0).'</td>
                        <td>'.$rowdata->currency.'</td>
                        <td class="text-center">'.$rowdata->input_user.'<br>'.$rowdata->input_date.'</td>
                    </tr>
                    ';
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
            
            //  mengirim data ke view
            $data = array(
                'table_data'    => $output,
                'totalcount'    => $totalcount,
                'halamanAktif'  => $halamanAktif,
                'jumlahHalaman' => $jumlahHalaman
            );
            echo json_encode($data);
        }
        else{
           //  menghapus session
           $request->session()->forget('session_gitinventory_id');
           $request->session()->forget('session_gitinventory_userid');
           $request->session()->forget('session_gitinventory_username');
           return redirect('/logins');
        }
    }

    //  ***
    //  download
    public function download(Request $request)
    {
        //  global variable
        $stdate     = $request->get('stdate');
        $endate     = $request->get('endate');
        $jnsdokbc   = $request->get('jnsdokbc');
        $nodokbc    = $request->get('nodokbc');
        $partno     = $request->get('partno');
        $filename   = 'Laporan Pemasukkan';

        //  execute database
        $datas  = DB::select("call sync_down_input('{$stdate}', '{$endate}', '{$jnsdokbc}', '{$nodokbc}', '{$partno}');");

        //  untuk meyimpan data di excel
        header("Content-type: application/vnd-ms-excel");
        header("Content-Disposition: attachment; filename=". $filename .".xls");
        echo '<table>';
            echo '<tr>';
            echo '<th colspan="6" style="font-size:18pt;" align="left">LAPORAN PEMASUKAN PER DOKUMEN</th>';
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
