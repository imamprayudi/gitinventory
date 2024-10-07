<?php
namespace App;

class Helper
{
    public static function return_data_header($rowdata)
    {
        return "<tr><th class='align-middle'>NO</th><th class='align-middle'>PARTNO</th><th class='align-middle'>PARTNAME</th><th class='align-middle'>UNIT</th><th class='align-middle'>SALDO AWAL</th><th class='align-middle'>PEMASUKAN</th><th class='align-middle'>PENGELUARAN</th><th class='align-middle'>SALDO AKHIR</th><th class='align-middle'>LAST INPUT</th><th class='align-middle'>LAST OUTPUT</th></tr>";

       /*  $header = "<tr>";
        $header .= "<th class='align-middle'>NO</th>";
        $disable = ["input_user","last_sync","output_user","last_output_sync"];
        foreach ($rowdata[0] as $key => $value) {
            if(!in_array($key,$disable)){
                $header .= "<th class='align-middle'>".strtoupper(str_replace("_"," ",$key))."</th>";
            }
        }
        $header .= "</tr>";
        return $header; */
    }
    public static function return_data_mutate($nomor,$rowdata)
    {
        $body = "";
        for ($i=0; $i < sizeof($rowdata); $i++) {
            $no = ++$nomor;
            $body .= '<tr>
                    <td align="right"><medium class="text-muted">'.$no.'</medium></td>
                    <td>'.$rowdata[$i]['PARTNO'].'</td>
                    <td>'.$rowdata[$i]['PARTNAME'].'</td>
                    <td>'.$rowdata[$i]['UNIT'].'</td>
                    <td>'.$rowdata[$i]['saldo_awal'].'</td>
                    <td>'.$rowdata[$i]['pemasukan'].'</td>
                    <td>'.$rowdata[$i]['pengeluaran'].'</td>
                    <td>'.$rowdata[$i]['saldo_akhir'].'</td>
                    <td>'.$rowdata[$i]['input_user'].'<br>'.$rowdata[$i]['last_input'].'</td>
                    <td>'.$rowdata[$i]['output_user'].'<br>'.$rowdata[$i]['last_output'].'</td>
                </tr>';
        }
        // foreach ($rowdata as $key => $value) {
        //     return $value;
        //     $no = ++$nomor;
        //     $body .= '<tr>
        //             <td align="right"><medium class="text-muted">'.$no.'</medium></td>
        //             <td>'.$rowdata['PARTNO'].'</td>
        //             <td>'.$rowdata['PARTNAME'].'</td>
        //             <td>'.$rowdata['UNIT'].'</td>
        //             <td>'.$rowdata['saldo_awal'].'</td>
        //             <td>'.$rowdata['pemasukan'].'</td>
        //             <td>'.$rowdata['pengeluaran'].'</td>
        //             <td>'.$rowdata['saldo_akhir'].'</td>
        //             <td>'.$rowdata['input_user'].'<br>'.$rowdata['last_input'].'</td>
        //             <td>'.$rowdata['output_user'].'<br>'.$rowdata['last_output'].'</td>
        //         </tr>';
        // }

        return $body;
    }

    public static function return_data_mutasi($no, $rowdata){
        /**`monthly_mutation_report`.`kode_barang`,
            `monthly_mutation_report`.`nama_barang`,
            `monthly_mutation_report`.`satuan`,
            `monthly_mutation_report`.`saldo_awal`,
            `monthly_mutation_report`.`pemasukan`,
            `monthly_mutation_report`.`pengeluaran`,
            `monthly_mutation_report`.`saldo_buku`,
            `monthly_mutation_report`.`penyesuaian`,
            `monthly_mutation_report`.`stock_opname`,
            `monthly_mutation_report`.`selisih`,
            `monthly_mutation_report`.`keterangan`,
            `monthly_mutation_report`.`created_at` */
        // return $rowdata;
        // <td align="right"><medium class="text-muted">' . $no . '</medium></td>
        return '<tr>
                    <td align="right"><medium class="text-muted">' . $no . '</medium></td>
                    <td>' . $rowdata['kode_barang'] . '</td>
                    <td>' . $rowdata['nama_barang'] . '</td>
                    <td>' . $rowdata['satuan'] . '</td>
                    <td align="right">' . number_format((float) $rowdata['saldo_awal'],2) . '</td>
                    <td align="right">' . number_format((float) $rowdata['pemasukan'],2) . '</td>
                    <td align="right">' . number_format((float) $rowdata['pengeluaran'],2) . '</td>
                    <td align="right">' . number_format((float) $rowdata['penyesuaian'],2) . '</td>
                    <td align="right">' . number_format((float) $rowdata['saldo_buku'],2) . '</td>
                    <td align="right">' . number_format((float) $rowdata['stock_opname'],2) . '</td>
                    <td align="right">' . number_format((float) $rowdata['selisih'],2) . '</td>
                    <td>' . $rowdata['keterangan'] . '</td>
                    </tr>';
                    // <td>' . $rowdata['created_at'] . '</td>

    }
    public static function return_data_mutasi_old($no, $rowdata){
        /**"id": "1",
      "kode_barang": "SCR_MTL_1121/1221/0122",
      "nama_barang": "SCRAP BESI (EX PERUSAKAN)",
      "satuan": "KG",
      "saldo_awal": "0",
      "pemasukan": "835.500",
      "pengeluaran": "835.500",
      "penyesuaian": "0",
      "saldo_buku": "0.000",
      "stock_opname": "0.000",
      "keterangan": "" */
        // return $rowdata;
        return '<tr>
                    <td align="right"><medium class="text-muted">' . $no . '</medium></td>
                    <td>' . $rowdata['kode_barang'] . '</td>
                    <td>' . $rowdata['nama_barang'] . '</td>
                    <td>' . $rowdata['satuan'] . '</td>
                    <td align="right">' . $rowdata['saldo_awal'] . '</td>
                    <td align="right">' . $rowdata['pemasukan'] . '</td>
                    <td align="right">' . $rowdata['pengeluaran'] . '</td>
                    <td align="right">' . $rowdata['penyesuaian'] . '</td>
                    <td align="right">' . $rowdata['saldo_buku'] . '</td>
                    <td align="right">' . $rowdata['stock_opname'] . '</td>
                    <td align="right">' . $rowdata['selisih'] . '</td>
                    <td>' . $rowdata['keterangan'] . '</td>
                </tr>';

    }
    public static function return_data_wip($no, $rowdata){
        /**"id": "1",
      "kode_barang": "SCR_MTL_1121/1221/0122",
      "nama_barang": "SCRAP BESI (EX PERUSAKAN)",
      "satuan": "KG",
       */
        return '<tr>
                    <td align="right"><medium class="text-muted">' . $no . '</medium></td>
                    <td>' . $rowdata['work_center'] . '</td>
                    <td>' . $rowdata['dic'] . '</td>
                    <td>' . $rowdata['kode_barang'] . '</td>
                    <td>' . $rowdata['nama_barang'] . '</td>
                    <td>' . $rowdata['satuan'] . '</td>
                    <td align="right">' . number_format((float) $rowdata['jumlah'],2) . '</td>
                </tr>';

    }

    public static function no_data(){
        return '
                <tr>
                <td class="text-center" colspan="16">No Data Found</td>
                </tr>
                ';
    }
}
