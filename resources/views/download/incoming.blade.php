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
            <th bgcolor="#C0C0C0">Jenis Dokumen</th>
            <th bgcolor="#C0C0C0">Jenis Dokumen</th>
            <th bgcolor="#C0C0C0" rowspan="2">Supplier</th>
            <th bgcolor="#C0C0C0" rowspan="2">Part No</th>
            <th bgcolor="#C0C0C0" rowspan="2">Part Name</th>
            <th bgcolor="#C0C0C0" rowspan="2">QTY</th>
            <th bgcolor="#C0C0C0" rowspan="2">Unit</th>
            <th bgcolor="#C0C0C0" rowspan="2">Price</th>
            <th bgcolor="#C0C0C0" rowspan="2">Currency</th>
            <th bgcolor="#C0C0C0" rowspan="2">Create At</th>
        </tr>
        <tr>
            <th bgcolor="#C0C0C0">BC Type</th>
            <th bgcolor="#C0C0C0">BC Number</th>
            <th bgcolor="#C0C0C0">BC Date</th>
            <th bgcolor="#C0C0C0">Incoming No</th>
            <th bgcolor="#C0C0C0">Incoming Date</th>
            <th bgcolor="#C0C0C0">Invoice No</th>
        </tr>
    </thead>
    @php
        $no=1
    @endphp
    {{-- {{dd($data)}} --}}
    <tbody>
    @foreach ($data as $rowdata)
        <tr>
            <td align="right">{{ $no }}</td>
            <td>{{ $rowdata['jnsdokbc'] }}</td>
            <td>{{ $rowdata['nodokbc'] }}</td>
            <td>{{ $rowdata['datedokbc'] }}</td>
            <td>{{ $rowdata['buktiterima'] }}</td>
            <td>{{ $rowdata['dateterima'] }}</td>
            <td>{{ $rowdata['buktiinvoice'] }}</td>
            <td>{{ $rowdata['dateinvoice'] }}</td>
            <td>{{ $rowdata['supplier'] }}</td>
            <td>{{ $rowdata['partno'] }}</td>
            <td>{{ $rowdata['partname'] }}</td>
            <td align="right">{{ number_format($rowdata['qty'], 0) }}</td>
            <td>{{ $rowdata['unit'] }}</td>
            <td align="right">{{ number_format($rowdata['price'], 0) }}</td>
            <td>{{ $rowdata['currency'] }}</td>
            <td>{{ $rowdata['input_user'] }} {{ $rowdata['input_date'] }}</td>
        </tr>
    @php
        $no=$no+1
    @endphp
    @endforeach
    </tbody>
</table>
