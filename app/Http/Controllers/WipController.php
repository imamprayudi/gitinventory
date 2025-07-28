<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Helper;
use App\Http\Traits\ApiConfigurationTrait;

class WipController extends Controller
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
        $gitversions = $this->getVersionSafely(); // Ganti dari getVersion()
        $fullnames = $request->session()->get('session_gitinventory_username');
        return view('admins.wip', compact('gitversions','fullnames'));
    }

    public function loaddata(Request $request, $valjmlhal = 1, $jumlahDataPerHalaman = 14)
    {
        if($request->ajax() == false){
            $request->session()->forget('session_gitinventory_id');
            $request->session()->forget('session_gitinventory_userid');
            $request->session()->forget('session_gitinventory_username');
            return redirect('/login');
        }
        
        $output = '';
        
        $request->validate([
            'periode' => 'required|date_format:Ymd'
        ]);
        
        $parameter = $request;
        $parameter['page'] = 0;
        $parameter['limit'] = 1;
        
        $counts = $this->makeApiRequest('json_wip.php', $parameter->toArray());
        
        $totalcount = $counts['totalCount'] ?? 0;

        if($totalcount == 0){
            $jumlahHalaman = ceil($totalcount / $jumlahDataPerHalaman);
            $halamanAktif = 0;
            $awalData = (($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman) + 1;
            $output = '
            <tr>
            <td class="text-center" colspan="16">No Data Found</td>
            </tr>
            ';

            $data = [
                'table_data'    => $output,
                'totalcount'    => $totalcount,
                'halamanAktif'  => $halamanAktif,
                'jumlahHalaman' => $jumlahHalaman
            ];
            return response()->json($data);
        }

        $params = $request;
        $jumlahHalaman = ceil($totalcount / $jumlahDataPerHalaman);
        $halamanAktif = intval($valjmlhal);
        $awalData = (($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman);

        $params['page'] = $awalData;
        $params['limit'] = $jumlahDataPerHalaman;
        
        $sql = $this->makeApiRequest('json_wip.php', $params->toArray());
        
        if ($sql && isset($sql['rows'])) {
            $nomor = $awalData;
            foreach ($sql['rows'] as $rowdata) {
                $no = ++$nomor;
                $output .= Helper::return_data_wip($no, $rowdata);
            }
        }

        $data = [
            'table_data'    => $output,
            'totalcount'    => $totalcount,
            'halamanAktif'  => $halamanAktif,
            'jumlahHalaman' => $jumlahHalaman
        ];
        return response()->json($data);
    }

    public function pagination(Request $request)
    {
        return $this->loaddata($request, $request->get('jumlahHalaman'));
    }

    public function download(Request $request)
    {
        $params = $request;
        
        $sql = $this->makeApiRequest('json_download_wip.php', $params->toArray());
        $data = $sql['rows'] ?? [];
        return view('download.wip', compact('data'));
    }
}
