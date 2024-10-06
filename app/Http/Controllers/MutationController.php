<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Helper;

class MutationController extends Controller
{
    protected $domain = "https://svr1.jkei.jvckenwood.com/";
    protected $url = "api_invesa_test/";
    
    protected $gudang = 'Gudang Umum';
    
     public function __construct()
    {
        $serverName = $_SERVER['SERVER_NAME'] ?? null;
        if (str_contains($serverName, '136.198.117.') || str_contains($serverName, 'localhost') || str_contains($serverName, '.test')) {
            $this->domain = "http://136.198.117.118/";
        }

        $getVersion = Http::get($this->domain . $this->url . "json_version_sync.php");
        $this->version = $getVersion['version'];
    }
   
    public function gudang_material(Request $request)
    {
        $this->gudang = 'Gudang Material';
        $gitversions =$this->version;
        return view('admins.bahan_baku_gm', compact('gitversions'));
    }
    public function gudang_umum(Request $request)
    {
        $this->gudang = 'Gudang Umum';
        $gitversions =$this->version;
        return view('admins.bahan_baku_gu', compact('gitversions'));
    }
    public function bahan_penolong(Request $request)
    {
        $this->gudang = 'Gudang Umum';
        $gitversions =$this->version;
        return view('admins.bahan_penolong', compact('gitversions'));
    }
    public function mesin(Request $request)
    {
        $this->gudang = 'Gudang Umum';
        $gitversions =$this->version;
        return view('admins.mesin', compact('gitversions'));
    }
    public function sparepart(Request $request)
    {
        $this->gudang = 'Gudang Umum';
        $gitversions =$this->version;
        return view('admins.sparepart', compact('gitversions'));
    }


    //  ***
    //  loaddata
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
            'periode' => 'required|date_format:Y-m',
            'kategori' => 'required'
        ]);
        $parameter = $request;
        $parameter['page'] = 0;
        $parameter['limit'] = 1;

        $counts = Http::get($this->domain . $this->url . "json_mutation.php", $parameter->toArray());
        
        // return $counts;
        empty($counts['totalCount']) ? $totalcount = 0 : $totalcount = $counts['totalCount'];

        if($totalcount == 0){

            $jumlahHalaman          = ceil($totalcount / $jumlahDataPerHalaman);
            $halamanAktif           = 0;
            $awalData               = (($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman) + 1;
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
        // $totalcount = 32987;
        $jumlahHalaman          = ceil($totalcount / $jumlahDataPerHalaman);
        $halamanAktif           = intval($valjmlhal);
        $awalData               = (($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman);

        $params['page'] = $awalData;
        $params['limit'] = $jumlahDataPerHalaman;
        
        $sql    = Http::get($this->domain . $this->url . "json_mutation.php", $params->toArray());
        
        $nomor  = $awalData;
        foreach ($sql['rows'] as $rowdata) {
            $no = ++$nomor;
            $output .= Helper::return_data_mutasi($no, $rowdata);
        }

        $data = [
            'table_data'    => $output,
            'totalcount'    => $totalcount,
            'halamanAktif'  => $halamanAktif,
            'jumlahHalaman' => $jumlahHalaman
        ];
        return response()->json($data);
        
    }

    //  ***
    //  pagination
    public function pagination(Request $request)
    {
        return $this->loaddata($request, $request->get('jumlahHalaman'));
    }

    public function download(Request $request)
    {
        // $periode     = $request->get('periode');
        // $kategori     = $request->get('kategori');
        // $gudang     = $request->get('gudang');
        $params = $request;
        // dd($params);
        //  mengambil data table
        $sql    = Http::get($this->domain . $this->url . "json_download_mutation.php", $params->toArray());
        // return $this->domain . $this->url . "json_download_incoming.php";
        $data = $sql['rows'];
        // return $data;
        //  menampilkan view
        return view('download.mutation', compact('data'));
    }

     public function download_gudang(Request $request)
    {
        $periode     = $request->get('periode');
        $gudang     = $request->get('gudang');
        // return $this->domain . $this->url . "json_download_mutation_gudang.php";
       
        //  mengambil data table
        $sql    = Http::get($this->domain . $this->url . "json_download_mutation_gudang.php", [
            'periode' => $periode,
            'gudang' => $gudang
        ]);
        // return $this->domain . $this->url . "json_download_incoming.php";
        $data = $sql['rows'];
        // return $data;
        //  menampilkan view
        return view('download.mutation_gudang', compact('data'));
    }
    
}
