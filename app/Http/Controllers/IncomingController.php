<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Traits\ApiConfigurationTrait;

class IncomingController extends Controller
{
    use ApiConfigurationTrait;
    
    /**
     * Constructor - inisialisasi konfigurasi API
     */
    public function __construct()
    {
        $this->initializeApiConfiguration();
    }

    /**
     * ✅ PERBAIKAN: Tambahkan userid ke view
     * 
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $fullnames = $request->session()->get('session_gitinventory_username');
        $userid = $request->session()->get('session_gitinventory_userid'); // ✅ TAMBAHAN
        $gitversions = $this->getVersionSafely();
        
        // ✅ PERBAIKAN: Sertakan userid dalam compact
        return view('admins.input', compact('gitversions', 'fullnames', 'userid'));
    }

    /**
     * Load data dengan pagination
     * 
     * @param Request $request
     * @param int $valjmlhal
     * @return void
     */
    public function loaddata(Request $request, $valjmlhal = 1)
    {
        if ($request->ajax()) {
            $output = '';
            $jumlahDataPerHalaman = 10;
            $stdate = $request->get('stdate');
            $endate = $request->get('endate');
            $jnsdokbc = $request->get('jnsdokbc');
            $nodokbc = $request->get('nodokbc');
            $partno = $request->get('partno');

            // Gunakan method dari trait untuk API call
            $counts = $this->makeApiRequest('json_input_sync.php', [
                'valstdate' => $stdate,
                'valendate' => $endate,
                'valjnsdok' => $jnsdokbc,
                'valnodok' => $nodokbc,
                'valpartno' => $partno,
                'page' => 0,
                'limit' => 1
            ]);

            $totalcount = $counts['totalCount'] ?? 0;

            if ($totalcount > 0) {
                $jumlahHalaman = ceil($totalcount / $jumlahDataPerHalaman);
                $halamanAktif = intval($valjmlhal);
                $awalData = (($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman);

                // Ambil data dengan pagination
                $sql = $this->makeApiRequest('json_input_sync.php', [
                    'valstdate' => $stdate,
                    'valendate' => $endate,
                    'valjnsdok' => $jnsdokbc,
                    'valnodok' => $nodokbc,
                    'valpartno' => $partno,
                    'page' => $awalData,
                    'limit' => $jumlahDataPerHalaman
                ]);

                $nomor = $awalData;
                foreach ($sql['rows'] as $rowdata) {
                    $no = ++$nomor;
                    $output .= $this->return_data($no, $rowdata);
                }
            } else {
                $jumlahHalaman = ceil($totalcount / $jumlahDataPerHalaman);
                $halamanAktif = 0;
                $awalData = (($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman) + 1;
                $output = '<tr><td class="text-center" colspan="16">No Data Found</td></tr>';
            }

            $data = [
                'table_data' => $output,
                'totalcount' => $totalcount,
                'halamanAktif' => $halamanAktif,
                'jumlahHalaman' => $jumlahHalaman
            ];
            
            echo json_encode($data);
        }
    }

    public function return_data($no,$rowdata)
    {
        // <td>'.$rowdata['dateinvoice'].'</td>
        return '<tr>
                    <td align="right"><medium class="text-muted">'.$no.'</medium></td>
                    <td>'.$rowdata['jnsdokbc'].'</td>
                    <td>'.$rowdata['nodokbc'].'</td>
                    <td>'.$rowdata['datedokbc'].'</td>
                    <td>'.$rowdata['buktiterima'].'</td>
                    <td>'.$rowdata['dateterima'].'</td>
                    <td>'.$rowdata['buktiinvoice'].'</td>
                    <td>'.$rowdata['supplier'].'</td>
                    <td>'.$rowdata['partno'].'</td>
                    <td>'.$rowdata['partname'].'</td>
                    <td align="right">'.$rowdata['qty'].'</td>
                    <td>'.$rowdata['unit'].'</td>
                    <td>'.$rowdata['currency'].'</td>
                    <td align="right">'.$rowdata['price'].'</td>
                    </tr>';
                    // <td>'.$rowdata['input_user'].'<br>'.$rowdata['input_date'].'</td>
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
        // return $request;
        $stdate     = $request->get('stdate') ?? null;
        $endate     = $request->get('endate')?? null;
        $jnsdokbc   = $request->get('jnsdokbc')?? null;
        $nodokbc    = $request->get('nodokbc')?? null;
        $partno     = $request->get('partno')?? null;
        ($jnsdokbc === 'null') ? null : $jnsdokbc;
        $params = [
            'valstdate' => $stdate,
            'valendate' => $endate,
            'valjnsdok' => $jnsdokbc,
            'valnodok' => $nodokbc,
            'valpartno' => $partno,
        ];
        // return $this->domain . $this->url . "json_download_incoming.php?valstdate={$stdate}&valendate={$endate}&valjnsdok={$jnsdokbc}&valnodok={$nodokbc}&valpartno={$partno}";
        //  mengambil data table
        $sql    = Http::get($this->domain . $this->url . "json_download_incoming.php?valstdate={$stdate}&valendate={$endate}&valjnsdok={$jnsdokbc}&valnodok={$nodokbc}&valpartno={$partno}");
        // $sql    = Http::get($this->domain . $this->url . "json_download_incoming.php", $params);
        // return $this->domain . $this->url . "json_download_incoming.php";
        $data = $sql['rows'];
        // return $data;
        //  menampilkan view
        // return view('download.incoming', compact('sql'));
        return view('download.incoming', compact('data'));
    }
}
