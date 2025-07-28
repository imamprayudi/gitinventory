<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Helper;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use Symfony\Component\HttpFoundation\StreamedResponse;
use App\Http\Traits\ApiConfigurationTrait;

class MutationController extends Controller
{
    use ApiConfigurationTrait;
    
    protected $gudang = 'Gudang Umum';
    
    /**
     * Constructor - inisialisasi konfigurasi API
     */
    public function __construct()
    {
        $this->initializeApiConfiguration();
    }
   
    public function gudang_material(Request $request)
    {
        $this->gudang = 'Gudang Material';
        $gitversions = $this->getVersionSafely(); // Menggunakan method yang robust
        $fullnames = $request->session()->get('session_gitinventory_username');
        $userid = $request->session()->get('session_gitinventory_userid');
        $kategori_data = [
            "active_menu" => "active_bahan_baku_gm",
            "title" => "Bahan Baku - ".$this->gudang,
            "kategori" => "Bahan baku",
            "gudang" => $this->gudang,
        ];
        return view('admins.index', compact('gitversions','kategori_data','fullnames','userid'));
    }
    
    public function gudang_umum(Request $request)
    {
        $this->gudang = 'Gudang Umum';
        $gitversions = $this->getVersionSafely(); // Ganti dari $this->version
        $fullnames          = $request->session()->get('session_gitinventory_username');
        $userid          = $request->session()->get('session_gitinventory_userid');
        $kategori_data = [
            "active_menu" => "active_bahan_baku_gu",
            "title" => "Bahan Baku - ".$this->gudang,
            "kategori" => "Bahan baku",
            "gudang" => $this->gudang,
        ];
        return view('admins.index', compact('gitversions','kategori_data','fullnames','userid'));
    }
    public function bahan_penolong(Request $request)
    {
        $this->gudang = 'Gudang Umum';
        $gitversions = $this->getVersionSafely(); // Ganti dari $this->version
        $fullnames          = $request->session()->get('session_gitinventory_username');
        $userid          = $request->session()->get('session_gitinventory_userid');
        $kategori_data = [
            "active_menu" => "active_bahan_penolong",
            "title" => "Bahan Penolong",
            "kategori" => "Bahan penolong",
            "gudang" => $this->gudang,
        ];
        return view('admins.index', compact('gitversions','kategori_data','fullnames','userid'));
    }
    // Method mesin()
    public function mesin(Request $request)
    {
        $this->gudang = 'Gudang Umum';
        $gitversions = $this->getVersionSafely(); // Ganti dari $this->version
        $fullnames          = $request->session()->get('session_gitinventory_username');
        $userid          = $request->session()->get('session_gitinventory_userid');
        $kategori_data = [
            "active_menu" => "active_mesin",
            "title" => "Barang Modal - Mesin",
            "kategori" => "Barang modal - Mesin",
            "gudang" => $this->gudang,
        ];
        return view('admins.index', compact('gitversions','kategori_data','fullnames','userid'));
    }
    // Method sparepart()
    public function sparepart(Request $request)
    {
        $this->gudang = 'Gudang Umum';
        $gitversions = $this->getVersionSafely(); // Ganti dari $this->version
        $fullnames          = $request->session()->get('session_gitinventory_username');
        $userid          = $request->session()->get('session_gitinventory_userid');
        $kategori_data = [
            "active_menu" => "active_sparepart",
            "title" => "Barang Modal - Spare Part",
            "kategori" => "Barang modal - Spare part",
            "gudang" => $this->gudang,
        ];
        return view('admins.index', compact('gitversions','kategori_data','fullnames','userid'));
    }
    // Method mold()
    public function mold(Request $request)
    {
        $this->gudang = 'Gudang Umum';
        $gitversions = $this->getVersionSafely(); // Ganti dari $this->version
        $fullnames          = $request->session()->get('session_gitinventory_username');
        $userid          = $request->session()->get('session_gitinventory_userid');
        $kategori_data = [
            "active_menu" => "active_mold",
            "title" => "Barang Modal - Cetakan ( Moulding )",
            "kategori" => "Barang modal - Mould / Cetakan",
            "gudang" => $this->gudang,
        ];
        return view('admins.index', compact('gitversions','kategori_data','fullnames','userid'));
    }
    public function peralatan_pabrik(Request $request)
    {
        $this->gudang = 'Gudang Umum';
        $gitversions = $this->getVersionSafely(); // Ganti dari $this->version
        $fullnames          = $request->session()->get('session_gitinventory_username');
        $userid          = $request->session()->get('session_gitinventory_userid');
        $kategori_data = [
            "active_menu" => "active_peralatan_parbrik",
            "title" => "Barang Modal - Peralatan Pabrik",
            "kategori" => "Barang modal - Peralatan pabrik",
            "gudang" => $this->gudang,
        ];
        return view('admins.index', compact('gitversions','kategori_data','fullnames','userid'));
    }
    public function konstruksi(Request $request)
    {
        $this->gudang = 'Gudang Umum';
        $gitversions = $this->getVersionSafely(); // Ganti dari $this->version
        $fullnames          = $request->session()->get('session_gitinventory_username');
        $userid          = $request->session()->get('session_gitinventory_userid');
        $kategori_data = [
            "active_menu" => "active_kontruksi",
            "title" => "Barang Modal - Peralatan Konstruksi",
            "kategori" => "Barang modal - Peralatan konstruksi",
            "gudang" => $this->gudang,
        ];
        return view('admins.index', compact('gitversions','kategori_data','fullnames','userid'));
    }
    public function kantor(Request $request)
    {
        $this->gudang = 'Gudang Umum';
        $gitversions = $this->getVersionSafely(); // Ganti dari $this->version
        $fullnames          = $request->session()->get('session_gitinventory_username');
        $userid          = $request->session()->get('session_gitinventory_userid');
        $kategori_data = [
            "active_menu" => "active_kantor",
            "title" => "Peralatan perkantoran",
            "kategori" => "Peralatan perkantoran",
            "gudang" => $this->gudang,
        ];
        return view('admins.index', compact('gitversions','kategori_data','fullnames','userid'));
    }
    public function finishgood_gfg(Request $request)
    {
        $this->gudang = 'Gudang Finished Goods';
        $gitversions = $this->getVersionSafely(); // Ganti dari $this->version
        $fullnames          = $request->session()->get('session_gitinventory_username');
        $userid          = $request->session()->get('session_gitinventory_userid');
        $kategori_data = [
            "active_menu" => "activefinishgood_gfg",
            "title" => "Hasil Produksi - Gudang Finished Goods",
            "kategori" => "Hasil produksi",
            "gudang" => $this->gudang,
        ];
        return view('admins.index', compact('gitversions','kategori_data','fullnames','userid'));
    }
    public function finishgood_gu(Request $request)
    {
        $this->gudang = 'Gudang Umum';
        $gitversions = $this->getVersionSafely(); // Ganti dari $this->version
        $fullnames          = $request->session()->get('session_gitinventory_username');
        $userid          = $request->session()->get('session_gitinventory_userid');
        $kategori_data = [
            "active_menu" => "activefinishgood_gu",
            "title" => "Hasil Produksi - Gudang Umum",
            "kategori" => "Hasil produksi",
            "gudang" => $this->gudang,
        ];
        return view('admins.index', compact('gitversions','kategori_data','fullnames','userid'));
    }
    public function pengemas(Request $request)
    {
        $this->gudang = 'Gudang Umum';
        $gitversions = $this->getVersionSafely(); // Ganti dari $this->version
        $fullnames          = $request->session()->get('session_gitinventory_username');
        $userid          = $request->session()->get('session_gitinventory_userid');
        $kategori_data = [
            "active_menu" => "active_pengemas",
            "title" => "Pengemas atau Alat Bantu pengemas",
            "kategori" => "Barang Pengemas atau Alat bantu pengemas",
            "gudang" => $this->gudang,
        ];
        return view('admins.index', compact('gitversions','kategori_data','fullnames','userid'));
    }
    public function bahan_baku_contoh(Request $request)
    {
        $this->gudang = 'Gudang Umum';
        $gitversions = $this->getVersionSafely(); // Ganti dari $this->version
        $fullnames          = $request->session()->get('session_gitinventory_username');
        $userid          = $request->session()->get('session_gitinventory_userid');
        $kategori_data = [
            "active_menu" => "active_bahan_baku_contoh",
            "title" => "Barang Contoh - Bahan Baku",
            "kategori" => "Bahan baku - Contoh",
            "gudang" => $this->gudang,
        ];
        return view('admins.index', compact('gitversions','kategori_data','fullnames','userid'));
    }
    public function finishgood_contoh(Request $request)
    {
        $this->gudang = 'Gudang Umum';
        $gitversions = $this->getVersionSafely(); // Ganti dari $this->version
        $fullnames          = $request->session()->get('session_gitinventory_username');
        $userid          = $request->session()->get('session_gitinventory_userid');
        $kategori_data = [
            "active_menu" => "active_finishgood_contoh",
            "title" => "Barang Contoh - Barang Jadi",
            "kategori" => "Hasil produksi - Contoh",
            "gudang" => $this->gudang,
        ];
        return view('admins.index', compact('gitversions','kategori_data','fullnames','userid'));
    }
    public function service(Request $request)
    {
        $this->gudang = 'Gudang Service Part';
        $gitversions = $this->getVersionSafely(); // Ganti dari $this->version
        $fullnames          = $request->session()->get('session_gitinventory_username');
        $userid          = $request->session()->get('session_gitinventory_userid');
        $kategori_data = [
            "active_menu" => "active_service",
            "title" => "Service Part",
            "kategori" => "",
            "gudang" => $this->gudang,
        ];
        return view('admins.index', compact('gitversions','kategori_data','fullnames','userid'));
    }
    public function scrap(Request $request)
    {
        $this->gudang = 'Gudang Scrap';
        $gitversions = $this->getVersionSafely(); // Ganti dari $this->version
        $fullnames          = $request->session()->get('session_gitinventory_username');
        $userid          = $request->session()->get('session_gitinventory_userid');
        $kategori_data = [
            "active_menu" => "activescrap",
            "title" => "Scrap",
            "kategori" => "",
            "gudang" => $this->gudang,
        ];
        return view('admins.index', compact('gitversions','kategori_data','fullnames','userid'));
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

        $counts = $this->makeApiRequest('json_mutation.php', $parameter->toArray());
        
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
        
        $sql = $this->makeApiRequest('json_mutation.php', $params->toArray());

        if ($sql && isset($sql['rows'])) {
            $nomor = $awalData;
            foreach ($sql['rows'] as $rowdata) {
                $no = ++$nomor;
                $output .= Helper::return_data_mutasi($no, $rowdata);
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

    //  ***
    //  pagination
    public function pagination(Request $request)
    {
        return $this->loaddata($request, $request->get('jumlahHalaman'));
    }

    public function download_spreadsheet_ok(Request $request)
    {
        $periode    = $request->get('periode', '');
        $kategori   = $request->get('kategori', '');
        $gudang     = $request->get('gudang', '');
        
        // Ambil data dari API
        $response = Http::get($this->domain . $this->url . "json_download_mutation_spreadsheet.php?periode=" . $periode . "&kategori=" . $kategori . "&gudang=" . $gudang);
        $data = $response['rows'];

        // Membuat objek Spreadsheet baru
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set judul
        $sheet->setCellValue('A1', "Laporan $kategori - $gudang PER Dokumen Periode $periode");
        $sheet->mergeCells('A1:L1');
        $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(16);
        $sheet->getStyle('A1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        // Set header
        $headers = [
            'No', 'Kode Barang', 'Nama Barang', 'Satuan', 'Saldo Awal', 'Pemasukan',
            'Pengeluaran', 'Penyesuaian (Adjustment)', 'Saldo Akhir', 'Hasil Pencacahan (Stock Opname)',
            'Selisih', 'Keterangan'
        ];

        $columnIndex = 'A';
        foreach ($headers as $header) {
            $sheet->setCellValue("{$columnIndex}3", $header);
            $sheet->getStyle("{$columnIndex}3")->getFont()->setBold(true);
            $sheet->getStyle("{$columnIndex}3")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            $columnIndex++;
        }

        // $row = 4;
        // foreach ($data as $item) {
        //     $columnIndex = 'A';
        //     foreach ($item as $cellValue) {
        //         $sheet->setCellValue("{$columnIndex}{$row}", $cellValue);
        //         $columnIndex++;
        //     }
        //     $row++;
        // }
        // Isi data ke dalam spreadsheet
        $rowNo = 3;
        // return $data;
        foreach ($data as $rowIndex => $row) {
            foreach (array_values($row) as $colIndex => $value) {
                if($colIndex > 11)
                {
                    continue;
                }

                 // Menghitung kolom dengan huruf (A, B, C, dst.)
                $cellCoordinate = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($colIndex + 1) . ($rowNo + 1);

                // Set nilai berdasarkan tipe data
                if ($colIndex == 1 || $colIndex == 2) {
                    $sheet->setCellValueExplicit($cellCoordinate, $value, DataType::TYPE_STRING);
                    $sheet->getStyle($cellCoordinate)->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_TEXT);
                    continue;
                } 

                $sheet->setCellValue($cellCoordinate, $value);
                
            }
            $rowNo++;
        }
        
        $sheet->getStyle('A3:L3')->applyFromArray([
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => [
                    'argb' => '11d3f5',
                ],
            ],
        ]);

        // Set border untuk header dan data
        $sheet->getStyle('A3:L' . ($rowNo - 1))->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['argb' => '000000'],
                ],
            ],
        ]);

        // Set auto width
        foreach (range('A', 'L') as $column) {
            $sheet->getColumnDimension($column)->setAutoSize(true);
        }

        $filename = 'Laporan_data_' . $kategori . '_' . $gudang . '.xlsx';
        $writer = new Xlsx($spreadsheet);

        // StreamedResponse untuk unduhan file
        $response = new StreamedResponse(function() use ($writer) {
            $writer->save('php://output');
        });

        $response->headers->set('Content-Type', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        $response->headers->set('Content-Disposition', 'attachment; filename="' . $filename . '"');
        $response->headers->set('Cache-Control', 'max-age=0');

        return $response;
    }
    public function download_spreadsheet_data_only(Request $request)
    {
        $periode    = $request->get('periode', '');
        $kategori   = $request->get('kategori', '');
        $gudang     = $request->get('gudang', '');
        
        // Ambil data dari API
        $response = Http::get($this->domain . $this->url . "json_download_mutation.php?periode=" . $periode . "&kategori=" . $kategori . "&gudang=" . $gudang);
        $data = $response['rows'];

        // Membuat objek Spreadsheet baru
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        

        // Isi data ke dalam spreadsheet
        foreach ($data as $rowIndex => $row) {
            foreach (array_values($row) as $colIndex => $value) {
                // Menghitung kolom dengan huruf (A, B, C, dst.)
                $cellCoordinate = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($colIndex + 1) . ($rowIndex + 1);

                // Set nilai berdasarkan tipe data
                if (($colIndex == 1 || $colIndex == 2) && $rowIndex > 0) {
                    $sheet->setCellValueExplicit($cellCoordinate, $value, DataType::TYPE_STRING);
                    $sheet->getStyle($cellCoordinate)->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_TEXT);
                } else {
                    $sheet->setCellValue($cellCoordinate, $value);
                }
            }
        }

        $filename = 'Laporan_data_' . $kategori . '_' . $gudang . '.xlsx';
        $writer = new Xlsx($spreadsheet);

        // StreamedResponse untuk unduhan file
        $response = new StreamedResponse(function() use ($writer) {
            $writer->save('php://output');
        });

        $response->headers->set('Content-Type', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        $response->headers->set('Content-Disposition', 'attachment; filename="' . $filename . '"');
        $response->headers->set('Cache-Control', 'max-age=0');

        return $response;
    }
    public function download(Request $request)
    {
        $periode     = $request->get('periode','');
        $kategori     = $request->get('kategori','');
        $gudang     = $request->get('gudang','');
        // $params = $request;
        // dd($params);
        //  mengambil data table
        $sql    = Http::get($this->domain . $this->url . "json_download_mutation.php?periode=".$periode."&kategori=".$kategori."&gudang=".$gudang);
        // return $sql;
        $data = $sql['rows'];
        // // return $data;
        // //  menampilkan view
        return view('download.mutation', compact('data'));
    }
    
}
