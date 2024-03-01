<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Maatwebsite\Excel\Facades\Excel;

class IncomingController extends Controller
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

            // echo $this->domain.$this->url."json_input_sync.php";
            // die();
            $counts = Http::get($this->domain.$this->url."json_input_sync.php",[
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
                $sql    = Http::get($this->domain.$this->url."json_input_sync.php",[
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
            // return [
            //     "datas" => $totalcount
            // ];

            /*  // dd($totalcount);
                // return $totalcount;
                //  konfigurasi pagination
                // $totalcount = DB::select("call sync_disp_input(0, 1, '{$stdate}', '{$endate}', '{$jnsdokbc}', '{$nodokbc}', '{$partno}');");
                // if (str_contains($_SERVER['SERVER_NAME'], '136.198.117.') || str_contains($_SERVER['SERVER_NAME'], 'localhost'))
                // {
                    //  mengambil data dari json
                    //  **
                //     $totalcount = Http::get('http://136.198.117.118/api_invesa_test/json_input_sync.php');
                // }
                // else
                // {
                    //  mengambil data dari json
                    //  **
                //     $totalcount = Http::get('https://svr1.jkei.jvckenwood.com/api_invesa_test/json_input_sync.php');
                // }
                // return $totalcount;
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
            */

            //  check total data
            /* if($totalcount > 0)
                {
                    $jumlahHalaman          = ceil($totalcount / $jumlahDataPerHalaman);
                    $halamanAktif           = 1;
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
            } */

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
        // //  action ajax
        // if($request->ajax())
        // {
        //     //  variable
        //     $output     = '';
        //     $jumlahDataPerHalaman = 10;
        //     $valjmlhal  = $request->get('jumlahHalaman');
        //     $stdate     = $request->get('stdate');
        //     $endate     = $request->get('endate');
        //     $jnsdokbc   = $request->get('jnsdokbc');
        //     $nodokbc    = $request->get('nodokbc');
        //     $partno     = $request->get('partno');

        //     //  konfigurasi pagination
        //     $counts = DB::select("call sync_disp_input(0, 1, '{$stdate}', '{$endate}', '{$jnsdokbc}', '{$nodokbc}', '{$partno}');");
        //     if(empty($counts))
        //     {
        //         $totalcount = 0;
        //     }
        //     else
        //     {
        //         foreach($counts as &$row)
        //         {
        //             $row        = get_object_vars($row);
        //             $totalcount = $row['totalcount'];
        //         }
        //     }

        //     //  check total data
        //     if($totalcount > 0)
        //     {
        //         $jumlahHalaman          = ceil($totalcount / $jumlahDataPerHalaman);
        //         $halamanAktif           = intval($valjmlhal);
        //         $awalData               = (($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman);

        //         //  mengambil data table
        //         $sql    = DB::select("call sync_disp_input({$awalData}, {$jumlahDataPerHalaman}, '{$stdate}', '{$endate}', '{$jnsdokbc}', '{$nodokbc}', '{$partno}');");
        //         $nomor  = $awalData;
        //         foreach($sql as $rowdata)
        //         {
        //             $no = ++$nomor;
        //             $output .= '
        //             <tr>
        //                 <td align="right"><medium class="text-muted">'.$no.'</medium></td>
        //                 <td>'.$rowdata->jnsdokbc.'</td>
        //                 <td>'.$rowdata->nodokbc.'</td>
        //                 <td>'.$rowdata->datedokbc.'</td>
        //                 <td>'.$rowdata->buktiterima.'</td>
        //                 <td>'.$rowdata->dateterima.'</td>
        //                 <td>'.$rowdata->buktiinvoice.'</td>
        //                 <td>'.$rowdata->dateinvoice.'</td>
        //                 <td>'.$rowdata->supplier.'</td>
        //                 <td>'.$rowdata->partno.'</td>
        //                 <td>'.$rowdata->partname.'</td>
        //                 <td align="right">'.number_format($rowdata->qty, 0).'</td>
        //                 <td>'.$rowdata->unit.'</td>
        //                 <td align="right">'.number_format($rowdata->price, 0).'</td>
        //                 <td>'.$rowdata->currency.'</td>
        //                 <td class="text-center">'.$rowdata->input_user.'<br>'.$rowdata->input_date.'</td>
        //             </tr>
        //             ';
        //         }
        //     }
        //     else
        //     {
        //         $jumlahHalaman          = ceil($totalcount / $jumlahDataPerHalaman);
        //         $halamanAktif           = 0;
        //         $awalData               = (($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman) + 1;
        //         $output = '
        //         <tr>
        //         <td class="text-center" colspan="16">No Data Found</td>
        //         </tr>
        //         ';
        //     }

        //     //  mengirim data ke view
        //     $data = array(
        //         'table_data'    => $output,
        //         'totalcount'    => $totalcount,
        //         'halamanAktif'  => $halamanAktif,
        //         'jumlahHalaman' => $jumlahHalaman
        //     );
        //     echo json_encode($data);
        // }
        // else{
        //    //  menghapus session
        //    $request->session()->forget('session_gitinventory_id');
        //    $request->session()->forget('session_gitinventory_userid');
        //    $request->session()->forget('session_gitinventory_username');
        //    return redirect('/login');
        // }
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
        $sql    = Http::get($this->domain . $this->url . "json_download_incoming.php", [
            'valstdate' => $stdate,
            'valendate' => $endate,
            'valjnsdok' => $jnsdokbc,
            'valnodok' => $nodokbc,
            'valpartno' => $partno
        ]);
        // return $this->domain . $this->url . "json_download_incoming.php";
        $data = $sql['rows'];
        //  menampilkan view
        // return view('download.incoming', compact('sql'));
        return view('download.incoming', compact('data'));
    }
}
