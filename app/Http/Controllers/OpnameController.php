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

class OpnameController extends Controller
{
    use ApiConfigurationTrait;
    
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
        $fullnames = $request->session()->get('session_gitinventory_username');
        $kategori_data = [
            "active_menu" => "active_opname_bahan_baku_gm",
            "title" => "(Hasil Pencacahan) Bahan Baku - Gudang Material",
            "kategori_barang" => "Bahan baku",
            "gudang" => "Gudang Material",
        ];
        $gitversions = $this->getVersionSafely(); // Ganti dari getVersion()
        return view('opname.index', compact('gitversions','kategori_data','fullnames'));
    }

    public function gudang_umum(Request $request)
    {
        $this->gudang = 'Gudang Umum';
        $fullnames          = $request->session()->get('session_gitinventory_username');
        $kategori_data = [
            "active_menu" => "active_opname_bahan_baku_gu",
            "title" => "(Hasil Pencacahan) Bahan Baku - Gudang Umum",
            "kategori_barang" => "Bahan baku",
            "gudang" => "Gudang Umum",
        ];
        $gitversions =$this->version;
        return view('opname.index', compact('gitversions','kategori_data','fullnames'));
    }
    public function bahan_penolong(Request $request)
    {
        $this->gudang = 'Gudang Umum';
        $fullnames          = $request->session()->get('session_gitinventory_username');
        $kategori_data = [
            "active_menu" => "active_opname_bahan_penolong",
            "title" => "(Hasil Pencacahan) Bahan Penolong",
            "kategori_barang" => "Bahan penolong",
            "gudang" => "Gudang Umum",
        ];
        $gitversions =$this->version;
        return view('opname.index', compact('gitversions','kategori_data','fullnames'));
    }
    public function mesin(Request $request)
    {
        $this->gudang = 'Gudang Umum';
        $fullnames          = $request->session()->get('session_gitinventory_username');
        $kategori_data = [
            "active_menu" => "active_opname_mesin",
            "title" => "(Hasil Pencacahan) Barang modal - Mesin",
            "kategori_barang" => "Barang modal - Mesin",
            "gudang" => "Gudang Umum",
        ];
        $gitversions =$this->version;
        return view('opname.index', compact('gitversions','kategori_data','fullnames'));
    }
    public function sparepart(Request $request)
    {
        $this->gudang = 'Gudang Umum';
        $fullnames          = $request->session()->get('session_gitinventory_username');
        $kategori_data = [
            "active_menu" => "active_opname_sparepart",
            "title" => "(Hasil Pencacahan) Barang Modal - Spare Part",
            "kategori_barang" => "Barang modal - Spare part",
            "gudang" => "Gudang Umum",
        ];
        $gitversions =$this->version;
        return view('opname.index', compact('gitversions','kategori_data','fullnames'));
    }
    public function mold(Request $request)
    {
        $this->gudang = 'Gudang Umum';
        $fullnames          = $request->session()->get('session_gitinventory_username');
        $kategori_data = [
            "active_menu" => "active_opname_mold",
            "title" => "(Hasil Pencacahan) Barang Modal - Cetakan (Moulding)",
            "kategori_barang" => "Barang modal - Mould / Cetakan",
            "gudang" => $this->gudang,
        ];
        $gitversions =$this->version;
        return view('opname.index', compact('gitversions','kategori_data','fullnames'));
    }
    public function peralatan_pabrik(Request $request)
    {
        $this->gudang = 'Gudang Umum';
        $fullnames          = $request->session()->get('session_gitinventory_username');
        $kategori_data = [
            "active_menu" => "active_opname_peralatan_pabrik",
            "title" => "(Hasil Pencacahan) Barang Modal - Peralatan Pabrik",
            "kategori_barang" => "Barang modal - Peralatan pabrik",
            "gudang" => $this->gudang,
        ];
        $gitversions =$this->version;
        return view('opname.index', compact('gitversions','kategori_data','fullnames'));
    }
    public function konstruksi(Request $request)
    {
        $this->gudang = 'Gudang Umum';
        $fullnames          = $request->session()->get('session_gitinventory_username');
        $kategori_data = [
            "active_menu" => "active_opname_konstruksi",
            "title" => "(Hasil Pencacahan) Barang Modal - Peralatan Konstruksi",
            "kategori_barang" => "Barang modal - Peralatan konstruksi",
            "gudang" => $this->gudang,
        ];
        $gitversions =$this->version;
        return view('opname.index', compact('gitversions','kategori_data','fullnames'));
    }
    public function kantor(Request $request)
    {
        $this->gudang = 'Gudang Umum';
        $fullnames          = $request->session()->get('session_gitinventory_username');
        $kategori_data = [
            "active_menu" => "active_opname_kantor",
            "title" => "(Hasil Pencacahan) Peralatan Perkantoran",
            "kategori_barang" => "Peralatan perkantoran",
            "gudang" => $this->gudang,
        ];
        $gitversions =$this->version;
        return view('opname.index', compact('gitversions','kategori_data','fullnames'));
    }
    public function finishgood_gfg(Request $request)
    {
        $this->gudang = 'Gudang Finished Goods';
        $fullnames          = $request->session()->get('session_gitinventory_username');
        $kategori_data = [
            "active_menu" => "active_opname_finishgood_gfg",
            "title" => "(Hasil Pencacahan) Hasil Produksi - ".$this->gudang,
            "kategori_barang" => "Hasil produksi",
            "gudang" => $this->gudang,
        ];
        $gitversions =$this->version;
        return view('opname.index', compact('gitversions','kategori_data','fullnames'));
    }
    public function finishgood_gu(Request $request)
    {
        $this->gudang = 'Gudang Umum';
        $fullnames          = $request->session()->get('session_gitinventory_username');
        $kategori_data = [
            "active_menu" => "active_opname_finishgood_gu",
            "title" => "(Hasil Pencacahan) Hasil Produksi - ".$this->gudang,
            "kategori_barang" => "Hasil produksi",
            "gudang" => $this->gudang,
        ];
        $gitversions =$this->version;
        return view('opname.index', compact('gitversions','kategori_data','fullnames'));
    }
    public function pengemas(Request $request)
    {
        $this->gudang = 'Gudang Umum';
        $fullnames          = $request->session()->get('session_gitinventory_username');
        $kategori_data = [
            "active_menu" => "active_opname_pengemas",
            "title" => "(Hasil Pencacahan) Pengemas atau Alat Bantu pengemas",
            "kategori_barang" => "Barang Pengemas atau Alat bantu pengemas",
            "gudang" => $this->gudang,
        ];
        $gitversions =$this->version;
        return view('opname.index', compact('gitversions','kategori_data','fullnames'));
    }
    public function bahan_baku_contoh(Request $request)
    {
        $this->gudang = 'Gudang Umum';
        $fullnames          = $request->session()->get('session_gitinventory_username');
        $kategori_data = [
            "active_menu" => "active_opname_bahan_baku_contoh",
            "title" => "(Hasil Pencacahan) Barang Contoh - Bahan Baku",
            "kategori_barang" => "Bahan baku - Contoh",
            "gudang" => $this->gudang,
        ];
        $gitversions =$this->version;
        return view('opname.index', compact('gitversions','kategori_data','fullnames'));
    }
    public function finishgood_contoh(Request $request)
    {
        $this->gudang = 'Gudang Umum';
        $fullnames          = $request->session()->get('session_gitinventory_username');
        $kategori_data = [
            "active_menu" => "active_opname_finishgood_contoh",
            "title" => "(Hasil Pencacahan) Barang Contoh - Barang Jadi",
            "kategori_barang" => "Hasil produksi - Contoh",
            "gudang" => $this->gudang,
        ];
        $gitversions =$this->version;
        return view('opname.index', compact('gitversions','kategori_data','fullnames'));
    }
    public function service(Request $request)
    {
        $this->gudang = 'Gudang Service Part';
        $fullnames          = $request->session()->get('session_gitinventory_username');
        $kategori_data = [
            "active_menu" => "active_opname_service",
            "title" => "(Hasil Pencacahan) Service Part",
            "kategori_barang" => "",
            "gudang" => $this->gudang,
        ];
        $gitversions =$this->version;
        return view('opname.index', compact('gitversions','kategori_data','fullnames'));
    }
    public function scrap(Request $request)
    {
        $this->gudang = 'Gudang Scrap';
        $fullnames          = $request->session()->get('session_gitinventory_username');
        $kategori_data = [
            "active_menu" => "active_opname_scrap",
            "title" => "(Hasil Pencacahan) Scrap",
            "kategori_barang" => "",
            "gudang" => $this->gudang,
        ];
        $gitversions =$this->version;
        return view('opname.index', compact('gitversions','kategori_data','fullnames'));
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

        $counts = $this->makeApiRequest('json_opname.php', $parameter->toArray());
        
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
        
        $sql = $this->makeApiRequest('json_opname.php', $params->toArray());
        
        if ($sql && isset($sql['rows'])) {
            $nomor = $awalData;
            foreach ($sql['rows'] as $rowdata) {
                $no = ++$nomor;
                $output .= Helper::return_data_opname($no, $rowdata);
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
        $kategori   = $request->get('kategori_barang', '');
        $gudang     = $request->get('gudang', '');
        
        $params = $request;
        $sql    = Http::get($this->domain . $this->url . "json_download_opname_spreadsheet.php", $params->toArray());
        $data = $sql['rows'];
        // return $sql;
        // Membuat objek Spreadsheet baru
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set judul
        $sheet->setCellValue('A1', "Laporan Stock Fisik $kategori - $gudang Periode $periode");
        $sheet->mergeCells('A1:J1');
        $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(16);
        $sheet->getStyle('A1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        // Set header
        // Mengatur judul header
        $sheet->setCellValue('A3', 'No')
            ->setCellValue('B3', 'Jenis/Nama/Uraian Barang')
            ->setCellValue('C3', 'Kategori Barang')
            ->setCellValue('D3', 'Kode Barang')
            ->setCellValue('E3', 'Satuan')
            ->setCellValue('F3', 'Jumlah')
            ->setCellValue('G3', 'ex Dokumen BC')
            ->setCellValue('J3', 'Keterangan');

        // Mengatur merge cells untuk header
        $sheet->mergeCells('A3:A4'); // No
        $sheet->mergeCells('B3:B4'); // Jenis/Nama/Uraian Barang
        $sheet->mergeCells('C3:C4'); // Kategori Barang
        $sheet->mergeCells('D3:D4'); // Kode Barang
        $sheet->mergeCells('E3:E4'); // Satuan
        $sheet->mergeCells('F3:F4'); // Jumlah
        $sheet->mergeCells('G3:I3'); // ex Dokumen BC
        $sheet->mergeCells('J3:J4'); // Keterangan

        // Mengatur sub-header pada baris kedua
        $sheet->setCellValue('G4', 'Jenis Dokumen')
            ->setCellValue('H4', 'Nomor')
            ->setCellValue('I4', 'Tanggal');

        // Mengatur style header
        $sheet->getStyle('A3:J4')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('A3:J4')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
        $sheet->getStyle('A3:J4')->getFont()->setBold(true);

        // Isi data ke dalam spreadsheet
        $rowNo = 4;
        // return $data;
        foreach ($data as $rowIndex => $row) {
            foreach (array_values($row) as $colIndex => $value) {
                if($colIndex > 9)
                {
                    continue;
                }

                 // Menghitung kolom dengan huruf (A, B, C, dst.)
                $cellCoordinate = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($colIndex + 1) . ($rowNo + 1);

                // Set nilai berdasarkan tipe data
                if ($colIndex == 1 || $colIndex == 2 || $colIndex == 3 || $colIndex == 4) {
                    $sheet->setCellValueExplicit($cellCoordinate, $value, DataType::TYPE_STRING);
                    $sheet->getStyle($cellCoordinate)->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_TEXT);
                    continue;
                } 

                $sheet->setCellValue($cellCoordinate, $value);
                
            }
            $rowNo++;
        }
        
        $sheet->getStyle('A3:J4')->applyFromArray([
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => [
                    'argb' => '0ee39c',
                ],
            ],
        ]);

        // Set border untuk header dan data
        $sheet->getStyle('A3:J' . ($rowNo - 1))->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['argb' => '000000'],
                ],
            ],
        ]);

        // Set auto width
        foreach (range('A', 'J') as $column) {
            $sheet->getColumnDimension($column)->setAutoSize(true);
        }

        $filename = 'Laporan_Stock_Fisik_' . $kategori . '_' . $gudang . '.xlsx';
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
        $params = $request;
        $sql = $this->makeApiRequest('json_download_opname.php', $params->toArray());
        $data = $sql['rows'] ?? [];
        return view('download.opname', compact('data'));
    }
}
