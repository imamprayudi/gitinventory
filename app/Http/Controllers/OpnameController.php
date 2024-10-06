<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Helper;

class OpnameController extends Controller
{
    protected $domain = "https://svr1.jkei.jvckenwood.com/";
    protected $url = "api_invesa_test/";
    
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
        return view('opname.bahan_baku_gm', compact('gitversions'));
    }
    public function gudang_umum(Request $request)
    {
        $this->gudang = 'Gudang Umum';
        $gitversions =$this->version;
        return view('opname.bahan_baku_gu', compact('gitversions'));
    }
    public function bahan_penolong(Request $request)
    {
        $this->gudang = 'Gudang Umum';
        $gitversions =$this->version;
        return view('opname.bahan_penolong', compact('gitversions'));
    }
    public function mesin(Request $request)
    {
        $this->gudang = 'Gudang Umum';
        $gitversions =$this->version;
        return view('opname.mesin', compact('gitversions'));
    }
    public function sparepart(Request $request)
    {
        $this->gudang = 'Gudang Umum';
        $gitversions =$this->version;
        return view('opname.sparepart', compact('gitversions'));
    }
    public function mold(Request $request)
    {
        $this->gudang = 'Gudang Umum';
        $gitversions =$this->version;
        return view('opname.mold', compact('gitversions'));
    }
    public function peralatan_pabrik(Request $request)
    {
        $this->gudang = 'Gudang Umum';
        $gitversions =$this->version;
        return view('opname.peralatan_pabrik', compact('gitversions'));
    }
    public function konstruksi(Request $request)
    {
        $this->gudang = 'Gudang Umum';
        $gitversions =$this->version;
        return view('opname.konstruksi', compact('gitversions'));
    }
    public function kantor(Request $request)
    {
        $this->gudang = 'Gudang Umum';
        $gitversions =$this->version;
        return view('opname.kantor', compact('gitversions'));
    }
    public function finishgood_gfg(Request $request)
    {
        $this->gudang = 'Gudang Umum';
        $gitversions =$this->version;
        return view('opname.finishgood_gfg', compact('gitversions'));
    }
    public function finishgood_gu(Request $request)
    {
        $this->gudang = 'Gudang Umum';
        $gitversions =$this->version;
        return view('opname.finishgood_gu', compact('gitversions'));
    }
    public function pengemas(Request $request)
    {
        $this->gudang = 'Gudang Umum';
        $gitversions =$this->version;
        return view('opname.pengemas', compact('gitversions'));
    }
    public function bahan_baku_contoh(Request $request)
    {
        $this->gudang = 'Gudang Umum';
        $gitversions =$this->version;
        return view('opname.bahan_baku_contoh', compact('gitversions'));
    }
    public function finishgood_contoh(Request $request)
    {
        $this->gudang = 'Gudang Umum';
        $gitversions =$this->version;
        return view('opname.finishgood_contoh', compact('gitversions'));
    }
    public function service(Request $request)
    {
        $this->gudang = 'Gudang Service Part';
        $gitversions =$this->version;
        return view('opname.service', compact('gitversions'));
    }
    public function scrap(Request $request)
    {
        $this->gudang = 'Gudang Scrap';
        $gitversions =$this->version;
        return view('opname.scrap', compact('gitversions'));
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
        
        if($request->gudang=='Gudang Service Part' || $request->gudang=='Gudang Scrap')
        {
            $request->validate([
                'periode' => 'required|date_format:Y-m',
                'gudang' => 'required'
            ]);
        }
        else{
            $request->validate([
                'periode' => 'required|date_format:Y-m',
                'kategori' => 'required',
                'gudang' => 'required'
            ]);
        }

        $parameter = $request;
        $parameter['page'] = 0;
        $parameter['limit'] = 1;

        $counts = Http::get($this->domain . $this->url . "json_opname.php", $parameter->toArray());
        
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
        
        $sql    = Http::get($this->domain . $this->url . "json_opname.php", $params->toArray());
        
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
        $sql    = Http::get($this->domain . $this->url . "json_download_opname.php", $params->toArray());
        // return $this->domain . $this->url . "json_download_incoming.php";
        $data = $sql['rows'];
        // return $data;
        //  menampilkan view
        return view('download.opname', compact('data'));
    }
    
}
