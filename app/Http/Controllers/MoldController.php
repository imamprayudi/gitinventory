<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Helper;

class MoldController extends Controller
{
    protected $domain = "https://svr1.jkei.jvckenwood.com/";
    protected $url = "api_invesa_test/";
    protected $tempat = 'Gudang Bahan Baku';

    public function __construct()
    {
        if (str_contains($_SERVER['SERVER_NAME'], '136.198.117.') || str_contains($_SERVER['SERVER_NAME'], 'localhost')) {
            $this->domain = "http://136.198.117.118/";
        }
    }
    //  **
    //  index
    public function index(Request $request)
    {
        $gitversions = Http::get($this->domain . $this->url . "json_version_sync.php");
        $gitversions = $gitversions['version'];
        $categories = [
            "Bahan baku",
            "Bahan penolong",
            "Barang modal - Mesin",
            "Barang modal - Spare part",
            "Barang modal - Mould / Cetakan",
            "Barang modal - Peralatan pabrik",
            "Barang modal - Peralatan konstruksi",
            "Peralatan perkantoran",
            "Hasil produksi",
            "Barang setengah jadi",
            "Barang Pengemas atau Alat bantu pengemas",
            "Bahan baku - Contoh",
            "Hasil produksi - Contoh"
        ];
        return view('admins.mold', compact('gitversions', 'categories'));
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
            $output     = '';
            $jumlahDataPerHalaman = 10;
            $periode     = $request->get('periode');
            $partno     = $request->get('partno');

            $counts = Http::get($this->domain . $this->url . "json_mold.php", [
                'periode' => $periode,
                'partno' => $partno,
                'tempat' => $this->tempat,
                'page' => 0,
                'limit' => 1
            ]);

            // return $counts['totalCount'];
            if (empty($counts['totalCount'])) {
                $totalcount = 0;
            } else {
                $totalcount = $counts['totalCount'];
                // foreach($counts as &$row)
                // {
                //     $row        = get_object_vars($row);
                //     $totalcount = $row['totalcount'];
                // }
            }

            if ($totalcount > 0) {
                $jumlahHalaman          = ceil($totalcount / $jumlahDataPerHalaman);
                $halamanAktif           = intval($valjmlhal);
                $awalData               = (($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman);

                //  mengambil data table
                $sql    = Http::get($this->domain . $this->url . "json_mold.php", [
                    'periode' => $periode,
                    'partno' => $partno,
                    'tempat' => $this->tempat,
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
        //  global variable
        // $stdate     = $request->get('stdate');
        // $endate     = $request->get('endate');
        // $jnsdokbc   = $request->get('jnsdokbc');
        // $nodokbc    = $request->get('nodokbc');
        $periode = $request->get('periode');
        $partno     = $request->get('partno');
        $tempat     = $this->tempat;
        $filename   = 'Laporan Mutasi Barang Scrap';

        //  execute database
        // $datas  = DB::select("call sync_down_input('{$stdate}', '{$endate}', '{$jnsdokbc}', '{$nodokbc}', '{$partno}');");
        $datas = Http::get($this->domain . $this->url . 'json_gudang_scrap.php', [
            'periode' => $periode,
            'partno' => $partno,
            'tempat' => $tempat
        ]);

        //  untuk meyimpan data di excel
        header("Content-type: application/vnd-ms-excel");
        header("Content-Disposition: attachment; filename=" . $filename . ".xls");
        echo '<table>';
        echo '<tr>';
        echo '<th colspan="6" style="font-size:18pt;" align="left">' . strtoupper($filename) . '</th>';
        echo '</tr>';
        echo '<tr>';
        echo '<th></th>';
        echo '</tr>';
        echo '</table>';
        echo '<table border="1">';
        echo '<tr>';
        echo '<th bgcolor="#C0C0C0">No</th>';
        echo '<th bgcolor="#C0C0C0">Kode Brg</th>';
        echo '<th bgcolor="#C0C0C0">Nama Brg</th>';
        echo '<th bgcolor="#C0C0C0">Sat</th>';
        echo '<th bgcolor="#C0C0C0">Saldo Awal</th>';
        echo '<th bgcolor="#C0C0C0">Pemasukan</th>';
        echo '<th bgcolor="#C0C0C0">Pengeluaran</th>';
        echo '<th bgcolor="#C0C0C0">Penyesuaian</th>';
        echo '<th bgcolor="#C0C0C0">Saldo Buku</th>';
        echo '<th bgcolor="#C0C0C0">Stock Opname</th>';
        echo '<th bgcolor="#C0C0C0">Selisih</th>';
        echo '<th bgcolor="#C0C0C0">Ket</th>';
        echo '</tr>';
        $no = 1;
        for ($i = 0; $i < count($datas['rows']); $i++) {
            $rowdata = $datas['rows'][$i];

            echo '<tr>';
            echo '<td align="right">' . $no . '</td>';
            echo '<td>' . $rowdata['kode_barang'] . '</td>';
            echo '<td>' . $rowdata['nama_barang'] . '</td>';
            echo '<td>' . $rowdata['satuan'] . '</td>';
            echo '<td>' . $rowdata['saldo_awal'] . '</td>';
            echo '<td>' . $rowdata['pemasukan'] . '</td>';
            echo '<td>' . $rowdata['pengeluaran'] . '</td>';
            echo '<td>' . $rowdata['penyesuaian'] . '</td>';
            echo '<td>' . $rowdata['saldo_buku'] . '</td>';
            echo '<td>' . $rowdata['selisih'] . '</td>';
            echo '<td>' . $rowdata['stock_opname'] . '</td>';
            echo '<td>' . $rowdata['keterangan'] . '</td>';
            echo '</tr>';
            $no++;
        }
        echo '</table>';
    }
}
