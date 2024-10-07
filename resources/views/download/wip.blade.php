{{ header("Content-type: application/vnd-ms-excel") }}
{{ header("Content-Disposition: attachment; filename=Data WIP Periode ". $data[0]['periode'] .".xls") }}
<table>
    <tr>
        <th colspan="12" style="font-size:18pt;" align="left">LAPORAN WIP Periode {{ $data[0]['periode'] }}</th>
    </tr>
    <tr><th></th></tr>
</table>
<table border="1" style="white-space:nowrap !important">
        
    <thead>
        <th class="align-middle" bgcolor="#C0C0C0" >No</th>
        <th class="align-middle" bgcolor="#C0C0C0" >Kode Lokasi</th>
        <th class="align-middle" bgcolor="#C0C0C0" >Nama Lokasi</th>
        <th class="align-middle" bgcolor="#C0C0C0" >Kode Barang</th>
        <th class="align-middle" bgcolor="#C0C0C0" >Nama Barang</th>
        <th class="align-middle" bgcolor="#C0C0C0" >Satuan</th>
        <th class="align-middle" bgcolor="#C0C0C0" >Jumlah</th>
    </thead>

    @php
        $no=1
    @endphp
 
    @foreach ($data as $rowdata)
        <tr>
            <td align="right"><medium class="text-muted">{{ $no }}</medium></td>
            <td>{{ $rowdata['work_center'] }}</td>
            <td>{{ $rowdata['dic'] }}</td>
            <td>{{ $rowdata['kode_barang'] }}</td>
            <td>{{ $rowdata['nama_barang'] }}</td>
            <td>{{ $rowdata['satuan'] }}</td>
            <td>{{ $rowdata['jumlah'] }}</td>
        </tr>
    @php
        $no=$no+1
    @endphp
    @endforeach
    </tbody>
</table>
