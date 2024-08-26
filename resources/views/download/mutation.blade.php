{{ header("Content-type: application/vnd-ms-excel") }}
{{ header("Content-Disposition: attachment; filename=Data ". $rowdata[0]['kategori'] .".xls") }}
<table>
    <tr>
        <th colspan="6" style="font-size:18pt;" align="left">LAPORAN PEMASUKAN PER DOKUMEN</th>
    </tr>
    <tr><th></th></tr>
</table>
<table border="1" style="white-space:nowrap !important">
        
    <thead>
        <th class="align-middle" bgcolor="#C0C0C0" >No</th>
        <th class="align-middle" bgcolor="#C0C0C0" >Kode Brg</th>
        <th class="align-middle" bgcolor="#C0C0C0" >Nama Brg</th>
        <th class="align-middle" bgcolor="#C0C0C0" >Sat</th>
        <th class="align-middle" bgcolor="#C0C0C0" >Saldo Awal</th>
        <th class="align-middle" bgcolor="#C0C0C0" >Pemasukan</th>
        <th class="align-middle" bgcolor="#C0C0C0" >Pengeluaran</th>
        <th class="align-middle" bgcolor="#C0C0C0" >Penyesuaian</th>
        <th class="align-middle" bgcolor="#C0C0C0" >Saldo Buku</th>
        <th class="align-middle" bgcolor="#C0C0C0" >Stock Opname</th>
        <th class="align-middle" bgcolor="#C0C0C0" >Selisih</th>
        <th class="align-middle" bgcolor="#C0C0C0" >Ket</th>
    </thead>

    @php
        $no=1
    @endphp
    {{dd($data)}}
 
    @foreach ($data as $rowdata)
        <tr>
            <td align="right"><medium class="text-muted">{{ $no }}</medium></td>
            <td>{{ $rowdata[$i]['kode_barang'] }}</td>
            <td>{{ $rowdata[$i]['nama_barang'] }}</td>
            <td>{{ $rowdata[$i]['satuan'] }}</td>
            <td>{{ $rowdata[$i]['saldo_awal'] }}</td>
            <td>{{ $rowdata[$i]['pemasukan'] }}</td>
            <td>{{ $rowdata[$i]['pengeluaran'] }}</td>
            <td>{{ $rowdata[$i]['saldo_buku'] }}</td>
            <td>{{ $rowdata[$i]['penyesuaian'] }}</td>
            <td>{{ $rowdata[$i]['stock_opname'] }}</td>
            <td>{{ $rowdata[$i]['selisih'] }}</td>
            <td>{{ $rowdata[$i]['keterangan'] }}</td>
            <td>{{ $rowdata[$i]['kategori'] }}</td>
            <td>{{ $rowdata[$i]['created_at'] }}</td>
        </tr>
    @php
        $no=$no+1
    @endphp
    @endforeach
    </tbody>
</table>
