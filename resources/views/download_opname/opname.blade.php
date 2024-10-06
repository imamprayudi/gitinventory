{{ header("Content-type: application/vnd-ms-excel") }}
{{ header("Content-Disposition: attachment; filename=Data ". $data[0]['kategori'] ."-". $data[0]['gudang'] .".xls") }}
<table>
    <tr>
        <th colspan="12" style="font-size:18pt;" align="left">LAPORAN STOK FISIK {{ $data[0]['kategori'] }} - {{ $data[0]['gudang'] }}</th>
    </tr>
    <tr>
        <th>
             <th style="font-size:12pt;" align="left">Periode : {{ $data[0]['periode'] }}</th>
        </th>
    </tr>
    <tr>
        <th>
             <th style="font-size:12pt;" align="left">Tgl Stock Opname : {{ $data[0]['created_at'] }}</th>
        </th>
    </tr>
    <tr><th></th></tr>
</table>
<table border="1" style="white-space:nowrap !important">
        
    <thead>
        <th class="align-middle" bgcolor="#C0C0C0" >No</th>
        <th class="align-middle" bgcolor="#C0C0C0" >Kode Barang</th>
        <th class="align-middle" bgcolor="#C0C0C0" >Nama Barang</th>
        <th class="align-middle" bgcolor="#C0C0C0" >Satuan</th>
        <th class="align-middle" bgcolor="#C0C0C0" >Saldo Buku</th>
        <th class="align-middle" bgcolor="#C0C0C0" >Hasil Pencacahan (Stock Opname)</th>
        <th class="align-middle" bgcolor="#C0C0C0" >Keterangan</th>
    </thead>

    @php
        $no=1
    @endphp
 
    @foreach ($data as $rowdata)
        <tr>
            <td align="right"><medium class="text-muted">{{ $no }}</medium></td>
            <td>{{ $rowdata['kode_barang'] }}</td>
            <td>{{ $rowdata['nama_barang'] }}</td>
            <td>{{ $rowdata['satuan'] }}</td>
            <td>{{ $rowdata['saldo_buku'] }}</td>
            <td>{{ $rowdata['stock_opname'] }}</td>
            <td>{{ $rowdata['keterangan'] }}</td>
        </tr>
    @php
        $no=$no+1
    @endphp
    @endforeach
    </tbody>
</table>
