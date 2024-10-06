<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Helper;

class Bahan_BakuController extends Controller
{
    protected $domain = "https://svr1.jkei.jvckenwood.com/";
    protected $url = "api_invesa_test/";
    protected $gudang = 'Gudang Umum';
    protected $kategori = 'Bahan Baku';
    protected $version = '1.0.0';


    public function __construct()
    {
        $serverName = $_SERVER['SERVER_NAME'] ?? null;
        if (str_contains($serverName, '136.198.117.') || str_contains($serverName, 'localhost')) {
            $this->domain = "http://136.198.117.118/";
        }

        $getVersion = Http::get($this->domain . $this->url . "json_version_sync.php");
        $this->version = $getVersion['version'];
    }
    //  **
    //  index
    // public function index(Request $request)
    // {
    //     $gitversions = Http::get($this->domain . $this->url . "json_version_sync.php");
    //     $gitversions = $gitversions['version'];
    //     $categories = [
    //         "Bahan baku",
    //         "Bahan penolong",
    //         "Barang modal - Mesin",
    //         "Barang modal - Spare part",
    //         "Barang modal - Mould / Cetakan",
    //         "Barang modal - Peralatan pabrik",
    //         "Barang modal - Peralatan konstruksi",
    //         "Peralatan perkantoran",
    //         "Hasil produksi",
    //         "Barang setengah jadi",
    //         "Barang Pengemas atau Alat bantu pengemas",
    //         "Bahan baku - Contoh",
    //         "Hasil produksi - Contoh"
    //     ];
    //     return view('admins.bahan_baku', compact('gitversions', 'categories'));
    // }
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

    //  ***
    //  loaddata
    public function loaddata(Request $request, $valjmlhal = 1, $jumlahDataPerHalaman = 10)
    {
        // return $request;
        // return $valjmlhal;
        // return $request;
        //  action ajax
        if ($request->ajax()) {
            //  variable
            $output = '';
            $jumlahDataPerHalaman = 10;
            $periode = $request->get('periode');
            $kode_barang = $request->get('kode_barang');
            $this->gudang = $request->get('gudang');
            $this->kategori = $request->get('kategori');

            $counts = Http::get($this->domain . $this->url . "json_mutation.php", [
                'periode' => $periode,
                'kode_barang' => $kode_barang,
                'gudang' => $this->gudang,
                'kategori' => $this->kategori,
                'page' => 0,
                'limit' => 1
            ]);

            if (empty($counts['totalCount'])) {
                $totalcount = 0;
            } else {
                $totalcount = $counts['totalCount'];
            }

            if ($totalcount > 0) {
                $jumlahHalaman          = ceil($totalcount / $jumlahDataPerHalaman);
                $halamanAktif           = intval($valjmlhal);
                $awalData               = (($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman);

                //  mengambil data table
                $sql    = Http::get($this->domain . $this->url . "json_mutation.php", [
                    'periode' => $periode,
                    'kode_barang' => $kode_barang,
                    'gudang' => $this->gudang,
                    'kategori' => $this->kategori,
                    'page' => $awalData,
                    'limit' => $jumlahDataPerHalaman
                ]);
                // return $sql['rows'];
                $nomor  = $awalData;
                foreach ($sql['rows'] as $rowdata) {
                    // return $rowdata;
                    $no = ++$nomor;
                    $output .= Helper::return_data_mutasi($no, $rowdata);
                }
            } else {
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

        } else {
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
        return $this->loaddata($request, $request->get('jumlahHalaman'));
    }

    //  ***
    //  download
    public function download(Request $request)
    {
        $periode  = $request->get('periode');
        $this->kategori = $request->get('kategori');
        $this->gudang = $request->get('gudang');

        //  mengambil data table
        $sql    = Http::get($this->domain . $this->url . "json_download_mutation.php", [
            'periode' => $periode,
            'kategori' =>  $this->kategori,
            'gudang' => $this->gudang
        ]);
        $data = $sql['rows'];
        // return $data;
        return view('download.mutation', compact('data'));
    }
}
