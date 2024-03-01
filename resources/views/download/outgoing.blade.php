{{ header("Content-type: application/vnd-ms-excel") }}
{{ header("Content-Disposition: attachment; filename=Data Outcoming Invesa.xls") }}
<table>
    <tr>
        <th colspan="6" style="font-size:18pt;" align="left">LAPORAN PENGELUARAN PER DOKUMEN</th>
    </tr>
    <tr><th></th></tr>
</table>
<table border="1"  style="white-space:nowrap !important">
    <thead>
        <th bgcolor="#C0C0C0">#</th>
        <th bgcolor="#C0C0C0">BC Type</th>
        <th bgcolor="#C0C0C0">BC Number</th>
        <th bgcolor="#C0C0C0">BC Date</th>
        <th bgcolor="#C0C0C0">Outcoming No</th>
        <th bgcolor="#C0C0C0">Outcoming Date</th>
        <th bgcolor="#C0C0C0">Invoice No</th>
        <th bgcolor="#C0C0C0">Invoice Date</th>
        <th bgcolor="#C0C0C0">Supplier</th>
        <th bgcolor="#C0C0C0">Part No</th>
        <th bgcolor="#C0C0C0">Part Name</th>
        <th bgcolor="#C0C0C0">QTY</th>
        <th bgcolor="#C0C0C0">Unit</th>
        <th bgcolor="#C0C0C0">Price</th>
        <th bgcolor="#C0C0C0">Currency</th>
        <th bgcolor="#C0C0C0">Create At</th>
    </thead>
    @php
        $no=1
    @endphp
    <tbody>
    @foreach ($data as $rowdata)
        <tr>
            <td align="right">{{ $no }}</td>
            <td>{{ $rowdata['jnsdokbc'] }}</td>
            <td>{{ $rowdata['nodokbc'] }}</td>
            <td>{{ $rowdata['datedokbc'] }}</td>
            <td>{{ $rowdata['buktikirim'] }}</td>
            <td>{{ $rowdata['datekirim'] }}</td>
            <td>{{ $rowdata['buktiinvoice'] }}</td>
            <td>{{ $rowdata['dateinvoice'] }}</td>
            <td>{{ $rowdata['supplier'] }}</td>
            <td>{{ $rowdata['partno'] }}</td>
            <td>{{ $rowdata['partname'] }}</td>
            <td align="right">{{ intval($rowdata['qty'], 0) }}</td>
            <td>{{ $rowdata['unit'] }}</td>
            <td align="right">{{ intval($rowdata['price'], 0) }}</td>
            <td>{{ $rowdata['currency'] }}</td>
            <td>{{ $rowdata['input_user'] }} {{ $rowdata['input_date'] }}</td>
        </tr>
    @php
        $no=$no+1
    @endphp
    @endforeach
    </tbody>
</table>
