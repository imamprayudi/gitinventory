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
        $kategori_data = [
            "active_menu" => "active_bahan_baku_gm",
            "title" => "Bahan Baku - ".$this->gudang,
            "kategori" => "Bahan baku",
            "gudang" => $this->gudang,
        ];
        return view('admins.index', compact('gitversions','kategori_data'));
    }
    public function gudang_umum(Request $request)
    {
        $this->gudang = 'Gudang Umum';
        $gitversions =$this->version;
        $kategori_data = [
            "active_menu" => "active_bahan_baku_gu",
            "title" => "Bahan Baku - ".$this->gudang,
            "kategori" => "Bahan baku",
            "gudang" => $this->gudang,
        ];
        return view('admins.index', compact('gitversions','kategori_data'));
    }
    public function bahan_penolong(Request $request)
    {
        $this->gudang = 'Gudang Umum';
        $gitversions =$this->version;
        $kategori_data = [
            "active_menu" => "active_bahan_penolong",
            "title" => "Bahan Penolong",
            "kategori" => "Bahan penolong",
            "gudang" => $this->gudang,
        ];
        return view('admins.index', compact('gitversions','kategori_data'));
    }
    public function mesin(Request $request)
    {
        $this->gudang = 'Gudang Umum';
        $gitversions =$this->version;
        $kategori_data = [
            "active_menu" => "active_mesin",
            "title" => "Barang Modal - Mesin",
            "kategori" => "Barang modal - Mesin",
            "gudang" => $this->gudang,
        ];
        return view('admins.index', compact('gitversions','kategori_data'));
    }
    public function sparepart(Request $request)
    {
        $this->gudang = 'Gudang Umum';
        $gitversions =$this->version;
        $kategori_data = [
            "active_menu" => "active_sparepart",
            "title" => "Barang Modal - Spare Part",
            "kategori" => "Barang modal - Spare part",
            "gudang" => $this->gudang,
        ];
        return view('admins.index', compact('gitversions','kategori_data'));
    }
    public function mold(Request $request)
    {
        $this->gudang = 'Gudang Umum';
        $gitversions =$this->version;
        $kategori_data = [
            "active_menu" => "active_mold",
            "title" => "Barang Modal - Cetakan ( Moulding )",
            "kategori" => "Barang modal - Mould / Cetakan",
            "gudang" => $this->gudang,
        ];
        return view('admins.index', compact('gitversions','kategori_data'));
    }
    public function peralatan_pabrik(Request $request)
    {
        $this->gudang = 'Gudang Umum';
        $gitversions =$this->version;
        $kategori_data = [
            "active_menu" => "active_peralatan_parbrik",
            "title" => "Barang Modal - Peralatan Pabrik",
            "kategori" => "Barang modal - Peralatan pabrik",
            "gudang" => $this->gudang,
        ];
        return view('admins.index', compact('gitversions','kategori_data'));
    }
    public function konstruksi(Request $request)
    {
        $this->gudang = 'Gudang Umum';
        $gitversions =$this->version;
        $kategori_data = [
            "active_menu" => "active_kontruksi",
            "title" => "Barang Modal - Peralatan Konstruksi",
            "kategori" => "Barang modal - Peralatan konstruksi",
            "gudang" => $this->gudang,
        ];
        return view('admins.index', compact('gitversions','kategori_data'));
    }
    public function kantor(Request $request)
    {
        $this->gudang = 'Gudang Umum';
        $gitversions =$this->version;
        $kategori_data = [
            "active_menu" => "active_kantor",
            "title" => "Peralatan perkantoran",
            "kategori" => "Peralatan perkantoran",
            "gudang" => $this->gudang,
        ];
        return view('admins.index', compact('gitversions','kategori_data'));
    }
    public function finishgood_gfg(Request $request)
    {
        $this->gudang = 'Gudang Finished Goods';
        $gitversions =$this->version;
        $kategori_data = [
            "active_menu" => "activefinishgood_gfg",
            "title" => "Hasil Produksi - Gudang Finished Goods",
            "kategori" => "Hasil produksi",
            "gudang" => $this->gudang,
        ];
        return view('admins.index', compact('gitversions','kategori_data'));
    }
    public function finishgood_gu(Request $request)
    {
        $this->gudang = 'Gudang Umum';
        $gitversions =$this->version;
        $kategori_data = [
            "active_menu" => "activefinishgood_gu",
            "title" => "Hasil Produksi - Gudang Umum",
            "kategori" => "Hasil produksi",
            "gudang" => $this->gudang,
        ];
        return view('admins.index', compact('gitversions','kategori_data'));
    }
    public function pengemas(Request $request)
    {
        $this->gudang = 'Gudang Umum';
        $gitversions =$this->version;
        $kategori_data = [
            "active_menu" => "active_pengemas",
            "title" => "Pengemas atau Alat Bantu pengemas",
            "kategori" => "Barang Pengemas atau Alat bantu pengemas",
            "gudang" => $this->gudang,
        ];
        return view('admins.index', compact('gitversions','kategori_data'));
    }
    public function bahan_baku_contoh(Request $request)
    {
        $this->gudang = 'Gudang Umum';
        $gitversions =$this->version;
        $kategori_data = [
            "active_menu" => "active_bahan_baku_contoh",
            "title" => "Barang Contoh - Bahan Baku",
            "kategori" => "Bahan baku - Contoh",
            "gudang" => $this->gudang,
        ];
        return view('admins.index', compact('gitversions','kategori_data'));
    }
    public function finishgood_contoh(Request $request)
    {
        $this->gudang = 'Gudang Umum';
        $gitversions =$this->version;
        $kategori_data = [
            "active_menu" => "active_finishgood_contoh",
            "title" => "Barang Contoh - Barang Jadi",
            "kategori" => "Hasil produksi - Contoh",
            "gudang" => $this->gudang,
        ];
        return view('admins.index', compact('gitversions','kategori_data'));
    }
    public function service(Request $request)
    {
        $this->gudang = 'Gudang Service Part';
        $gitversions =$this->version;
        $kategori_data = [
            "active_menu" => "active_service",
            "title" => "Service Part",
            "kategori" => "",
            "gudang" => $this->gudang,
        ];
        return view('admins.index', compact('gitversions','kategori_data'));
    }
    public function scrap(Request $request)
    {
        $this->gudang = 'Gudang Scrap';
        $gitversions =$this->version;
        $kategori_data = [
            "active_menu" => "activescrap",
            "title" => "Scrap",
            "kategori" => "",
            "gudang" => $this->gudang,
        ];
        return view('admins.index', compact('gitversions','kategori_data'));
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

        // return $sql;
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
    
}
