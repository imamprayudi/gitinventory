{{ header("Content-type: application/vnd-ms-excel") }}
@if (count($data) == 0) 
    {{ header("Content-Disposition: attachment; filename=Laporan Stok Fisik Kosong.xls") }}
    <table>
    <tr>
        <th colspan="12" style="font-size:18pt;" align="left">LAPORAN STOK FISIK Tidak Tersedia</th>
    </tr>
    </table>
@else 
{{ header("Content-Disposition: attachment; filename=Data ". $data[0]['kategori_barang'] ."-". $data[0]['gudang'] .".xls") }}
<table>
    <tr>
        <th colspan="12" style="font-size:18pt;" align="left">LAPORAN STOK FISIK {{ $data[0]['kategori_barang'] }} - {{ $data[0]['gudang'] }}</th>
    </tr>
    <tr>
        <th>
             <th style="font-size:12pt;" align="left">Periode</th>
             <th style="font-size:12pt;" align="left">: {{ $data[0]['periode'] }}</th>
        </th>
    </tr>
    <tr>
        <th>
             <th style="font-size:12pt;" align="left">Tgl Stock Opname</th>
             <th style="font-size:12pt;" align="left">: {{ substr($data[0]['created_at'],0,10) }}</th>
        </th>
    </tr>
    <tr><th></th></tr>
</table>
<table border="1" style="white-space:nowrap !important">
        
    <thead>
         <tr>
            <th class="align-middle" rowspan="2">No</th>
            <th class="align-middle" rowspan="2">Jenis/Nama/Uraian<br>Barang</th>
            <th class="align-middle" rowspan="2">Kategori<br>Barang</th>
            <th class="align-middle" rowspan="2">Kode Barang</th>
            <th class="align-middle" rowspan="2">Satuan</th>
            <th class="align-middle" rowspan="2">Jumlah</th>
            <th class="align-middle" colspan="3">ex Dokumen BC</th>
            <th class="align-middle" rowspan="2">Keterangan</th>
        </tr>
        <tr>
            <th class="align-middle">Jenis Dokumen</th>
            <th class="align-middle">Nomor</th>
            <th class="align-middle">Tanggal</th>
        </tr>
    </thead>

    @php
        $no=1
    @endphp
 
    @foreach ($data as $rowdata)
        <tr>
            <td align="right"><medium class="text-muted">{{ $no }}</medium></td>
            <td>{{ $rowdata['nama_barang'] }}</td>
            <td>{{ $rowdata['kategori_barang'] }}</td>
            <td>{{ $rowdata['kode_barang'] }}</td>
            <td>{{ $rowdata['satuan'] }}</td>
            <td>{{ $rowdata['jumlah'] }}</td>
            <td>{{ $rowdata['jenis_dokumen_bc'] }}</td>
            <td>{{ $rowdata['no_bc'] }}</td>
            <td>{{ $rowdata['tanggal_bc'] }}</td>
            <td>{{ $rowdata['keterangan'] }}</td>
        </tr>
    @php
        $no=$no+1
    @endphp
    @endforeach
    </tbody>
</table>
@endif