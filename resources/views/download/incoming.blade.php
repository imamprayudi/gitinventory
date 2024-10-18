{{ header("Content-type: application/vnd-ms-excel") }}
{{ header("Content-Disposition: attachment; filename=Data Incoming Invesa.xls") }}
<table>
    <tr>
        <th colspan="6" style="font-size:18pt;" align="left">LAPORAN PEMASUKAN PER DOKUMEN</th>
    </tr>
    <tr><th></th></tr>
</table>
<table border="1" style="white-space:nowrap !important">
    <thead>
        <tr>
            <th bgcolor="#C0C0C0" rowspan="2">#</th>
            <th bgcolor="#C0C0C0" colspan="3">Dokumen Pabean</th>
            <th bgcolor="#C0C0C0" colspan="3">Bukti Pemasukan Barang (BPB)</th>
            <th bgcolor="#C0C0C0" rowspan="2">Nama Pemasok</th>
            <th bgcolor="#C0C0C0" rowspan="2">Kode Barang</th>
            <th bgcolor="#C0C0C0" rowspan="2">Nama Barang</th>
            <th bgcolor="#C0C0C0" rowspan="2">Jumlah</th>
            <th bgcolor="#C0C0C0" rowspan="2">Satuan</th>
            <th bgcolor="#C0C0C0" rowspan="2">Kode Valuta</th>
            <th bgcolor="#C0C0C0" rowspan="2">Nilai</th>
            {{-- <th bgcolor="#C0C0C0" rowspan="2">Create At</th> --}}
        </tr>
        <tr>
            <th bgcolor="#C0C0C0">Jenis BC</th>
            <th bgcolor="#C0C0C0">No. Daftar</th>
            <th bgcolor="#C0C0C0">Tanggal Daftar</th>
            <th bgcolor="#C0C0C0">No. BPB</th>
            <th bgcolor="#C0C0C0">Tanggal BPB</th>
            <th bgcolor="#C0C0C0">No Invoice</th>
        </tr>
    </thead>
    @php
        $no=1
    @endphp
    {{-- {{dd($data)}} --}}
    <tbody>
    @foreach ($data as $rowdata)
        <tr>
            <td align="right">{{ $no }}</medium></td>
            <td>{{ $rowdata['jnsdokbc'] }}</td>
            <td>{{ $rowdata['nodokbc'] }}</td>
            <td>{{ $rowdata['datedokbc'] }}</td>
            <td>{{ $rowdata['buktiterima'] }}</td>
            <td>{{ $rowdata['dateterima'] }}</td>
            <td>{{ $rowdata['buktiinvoice'] }}</td>
            <td>{{ $rowdata['supplier'] }}</td>
            <td>{{ $rowdata['partno'] }}</td>
            <td>{{ $rowdata['partname'] }}</td>
            <td align="right">{{ $rowdata['qty'] }}</td>
            <td>{{ $rowdata['unit'] }}</td>
            <td>{{ $rowdata['currency'] }}</td>
            <td align="right">{{ $rowdata['price'] }}</td>
            {{-- <td>{{ $rowdata['input_user'] }} {{ $rowdata['input_date'] }}</td> --}}
        </tr>  
        @php
            $no=$no+1
        @endphp
    @endforeach
    </tbody>
</table>
