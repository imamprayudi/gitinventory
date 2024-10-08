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
        $kategori_data = [
            "active_menu" => "active_opname_bahan_baku_gm",
            "title" => "(Hasil Pencacahan) Bahan Baku - Gudang Material",
            "kategori_barang" => "Bahan baku",
            "gudang" => "Gudang Material",
        ];
        $gitversions =$this->version;
        return view('opname.index', compact('gitversions','kategori_data'));

    }
    public function gudang_umum(Request $request)
    {
        $this->gudang = 'Gudang Umum';
        $kategori_data = [
            "active_menu" => "active_opname_bahan_baku_gu",
            "title" => "(Hasil Pencacahan) Bahan Baku - Gudang Umum",
            "kategori_barang" => "Bahan baku",
            "gudang" => "Gudang Umum",
        ];
        $gitversions =$this->version;
        return view('opname.index', compact('gitversions','kategori_data'));
    }
    public function bahan_penolong(Request $request)
    {
        $this->gudang = 'Gudang Umum';
        $kategori_data = [
            "active_menu" => "active_opname_bahan_penolong",
            "title" => "(Hasil Pencacahan) Bahan Penolong",
            "kategori_barang" => "Bahan penolong",
            "gudang" => "Gudang Umum",
        ];
        $gitversions =$this->version;
        return view('opname.index', compact('gitversions','kategori_data'));
    }
    public function mesin(Request $request)
    {
        $this->gudang = 'Gudang Umum';
        $kategori_data = [
            "active_menu" => "active_opname_mesin",
            "title" => "(Hasil Pencacahan) Barang modal - Mesin",
            "kategori_barang" => "Barang modal - Mesin",
            "gudang" => "Gudang Umum",
        ];
        $gitversions =$this->version;
        return view('opname.index', compact('gitversions','kategori_data'));
    }
    public function sparepart(Request $request)
    {
        $this->gudang = 'Gudang Umum';
        $kategori_data = [
            "active_menu" => "active_opname_sparepart",
            "title" => "(Hasil Pencacahan) Barang Modal - Spare Part",
            "kategori_barang" => "Barang modal - Spare part",
            "gudang" => "Gudang Umum",
        ];
        $gitversions =$this->version;
        return view('opname.index', compact('gitversions','kategori_data'));
    }
    public function mold(Request $request)
    {
        $this->gudang = 'Gudang Umum';
        $kategori_data = [
            "active_menu" => "active_opname_mold",
            "title" => "(Hasil Pencacahan) Barang Modal - Cetakan (Moulding)",
            "kategori_barang" => "Barang modal - Mould / Cetakan",
            "gudang" => $this->gudang,
        ];
        $gitversions =$this->version;
        return view('opname.index', compact('gitversions','kategori_data'));
    }
    public function peralatan_pabrik(Request $request)
    {
        $this->gudang = 'Gudang Umum';
        $kategori_data = [
            "active_menu" => "active_opname_peralatan_pabrik",
            "title" => "(Hasil Pencacahan) Barang Modal - Peralatan Pabrik",
            "kategori_barang" => "Barang modal - Peralatan pabrik",
            "gudang" => $this->gudang,
        ];
        $gitversions =$this->version;
        return view('opname.index', compact('gitversions','kategori_data'));
    }
    public function konstruksi(Request $request)
    {
        $this->gudang = 'Gudang Umum';
        $kategori_data = [
            "active_menu" => "active_opname_konstruksi",
            "title" => "(Hasil Pencacahan) Barang Modal - Peralatan Konstruksi",
            "kategori_barang" => "Barang modal - Peralatan konstruksi",
            "gudang" => $this->gudang,
        ];
        $gitversions =$this->version;
        return view('opname.index', compact('gitversions','kategori_data'));
    }
    public function kantor(Request $request)
    {
        $this->gudang = 'Gudang Umum';
        $kategori_data = [
            "active_menu" => "active_opname_kantor",
            "title" => "(Hasil Pencacahan) Peralatan Perkantoran",
            "kategori_barang" => "Peralatan perkantoran",
            "gudang" => $this->gudang,
        ];
        $gitversions =$this->version;
        return view('opname.index', compact('gitversions','kategori_data'));
    }
    public function finishgood_gfg(Request $request)
    {
        $this->gudang = 'Gudang Finished Goods';
        $kategori_data = [
            "active_menu" => "active_opname_finishgood_gfg",
            "title" => "(Hasil Pencacahan) Hasil Produksi - ".$this->gudang,
            "kategori_barang" => "Hasil produksi",
            "gudang" => $this->gudang,
        ];
        $gitversions =$this->version;
        return view('opname.index', compact('gitversions','kategori_data'));
    }
    public function finishgood_gu(Request $request)
    {
        $this->gudang = 'Gudang Umum';
        $kategori_data = [
            "active_menu" => "active_opname_finishgood_gu",
            "title" => "(Hasil Pencacahan) Hasil Produksi - ".$this->gudang,
            "kategori_barang" => "Hasil produksi",
            "gudang" => $this->gudang,
        ];
        $gitversions =$this->version;
        return view('opname.index', compact('gitversions','kategori_data'));
    }
    public function pengemas(Request $request)
    {
        $this->gudang = 'Gudang Umum';
        $kategori_data = [
            "active_menu" => "active_opname_pengemas",
            "title" => "(Hasil Pencacahan) Pengemas atau Alat Bantu pengemas",
            "kategori_barang" => "Barang Pengemas atau Alat bantu pengemas",
            "gudang" => $this->gudang,
        ];
        $gitversions =$this->version;
        return view('opname.index', compact('gitversions','kategori_data'));
    }
    public function bahan_baku_contoh(Request $request)
    {
        $this->gudang = 'Gudang Umum';
        $kategori_data = [
            "active_menu" => "active_opname_bahan_baku_contoh",
            "title" => "(Hasil Pencacahan) Barang Contoh - Bahan Baku",
            "kategori_barang" => "Bahan baku - Contoh",
            "gudang" => $this->gudang,
        ];
        $gitversions =$this->version;
        return view('opname.index', compact('gitversions','kategori_data'));
    }
    public function finishgood_contoh(Request $request)
    {
        $this->gudang = 'Gudang Umum';
        $kategori_data = [
            "active_menu" => "active_opname_finishgood_contoh",
            "title" => "(Hasil Pencacahan) Barang Contoh - Barang Jadi",
            "kategori_barang" => "Hasil produksi - Contoh",
            "gudang" => $this->gudang,
        ];
        $gitversions =$this->version;
        return view('opname.index', compact('gitversions','kategori_data'));
    }
    public function service(Request $request)
    {
        $this->gudang = 'Gudang Service Part';
        $kategori_data = [
            "active_menu" => "active_opname_service",
            "title" => "(Hasil Pencacahan) Service Part",
            "kategori_barang" => "",
            "gudang" => $this->gudang,
        ];
        $gitversions =$this->version;
        return view('opname.index', compact('gitversions','kategori_data'));
    }
    public function scrap(Request $request)
    {
        $this->gudang = 'Gudang Scrap';
        $kategori_data = [
            "active_menu" => "active_opname_scrap",
            "title" => "(Hasil Pencacahan) Scrap",
            "kategori_barang" => "",
            "gudang" => $this->gudang,
        ];
        $gitversions =$this->version;
        return view('opname.index', compact('gitversions','kategori_data'));
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
                'periode' => 'required|date_format:Ym',
                'gudang' => 'required'
            ]);
        }
        else{
            $request->validate([
                'periode' => 'required|date_format:Ym',
                'kategori_barang' => 'required',
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
            $output .= Helper::return_data_opname($no, $rowdata);
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
        $params = $request;
        $sql    = Http::get($this->domain . $this->url . "json_download_opname.php", $params->toArray());
        $data = $sql['rows'];
        return view('download.opname', compact('data'));
    }
    
}
