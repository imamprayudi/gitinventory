{{ header("Content-type: application/vnd-ms-excel") }}
{{ header("Content-Disposition: attachment; filename=Data ". $data[0]['kategori'] ."-". $data[0]['gudang'] .".xls") }}
<table>
    <tr>
        <th colspan="12" style="font-size:18pt;" align="left">LAPORAN {{ $data[0]['kategori'] }} - {{ $data[0]['gudang'] }} PER DOKUMEN</th>
    </tr>
    <tr><th></th></tr>
</table>
<table border="1" style="white-space:nowrap !important">
        
    <thead>
        <th class="align-middle" bgcolor="#C0C0C0" >No</th>
        <th class="align-middle" bgcolor="#C0C0C0" >Kode Barang</th>
        <th class="align-middle" bgcolor="#C0C0C0" >Nama Barang</th>
        <th class="align-middle" bgcolor="#C0C0C0" >Satuan</th>
        <th class="align-middle" bgcolor="#C0C0C0" >Saldo Awal</th>
        <th class="align-middle" bgcolor="#C0C0C0" >Pemasukan</th>
        <th class="align-middle" bgcolor="#C0C0C0" >Pengeluaran</th>
        <th class="align-middle" bgcolor="#C0C0C0" >Penyesuaian (Adjustment)</th>
        <th class="align-middle" bgcolor="#C0C0C0" >Saldo Akhir</th>
        <th class="align-middle" bgcolor="#C0C0C0" >Hasil Pencacahan (Stock Opname)</th>
        <th class="align-middle" bgcolor="#C0C0C0" >Selisih</th>
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
            <td>{{ $rowdata['saldo_awal'] }}</td>
            <td>{{ $rowdata['pemasukan'] }}</td>
            <td>{{ $rowdata['pengeluaran'] }}</td>
            <td>{{ $rowdata['penyesuaian'] }}</td>
            <td>{{ $rowdata['saldo_buku'] }}</td>
            <td>{{ $rowdata['stock_opname'] }}</td>
            <td>{{ $rowdata['selisih'] }}</td>
            <td>{{ $rowdata['keterangan'] }}</td>
            {{-- <td>{{ $rowdata['kategori'] }}</td>
            <td>{{ $rowdata['created_at'] }}</td> --}}
        </tr>
    @php
        $no=$no+1
    @endphp
    @endforeach
    </tbody>
</table>
