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

    public static function no_data(){
        return '
                <tr>
                <td class="text-center" colspan="16">No Data Found</td>
                </tr>
                ';
    }
}
