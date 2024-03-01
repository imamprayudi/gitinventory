{{ header("Content-type: application/vnd-ms-excel") }}
{{ header("Content-Disposition: attachment; filename=Data Conversi Part from Mecha.xls") }}
<table>
    <tr>
        <th colspan="6" style="font-size:18pt;" align="left">LAPORAN KONVERSI PART MECHA NUMBER</th>
    </tr>
    <tr><th></th></tr>
</table>
<table border="1">
    <tr>
        <th bgcolor="#C0C0C0">No</th>
        <th bgcolor="#C0C0C0">Transaction</th>
        <th bgcolor="#C0C0C0">Part No</th>
        <th bgcolor="#C0C0C0">Part Name</th>
        <th bgcolor="#C0C0C0">QTY Lot</th>
        <th bgcolor="#C0C0C0">Amount</th>
        <th bgcolor="#C0C0C0">QTY per Item</th>
        <th bgcolor="#C0C0C0">Unit</th>
        <th bgcolor="#C0C0C0">BC Number</th>
        <th bgcolor="#C0C0C0">Transaction Date</th>
    </tr>
    @php
        $no=1
    @endphp
    @foreach ($sql as $rowdata)
    <tr>
        <td align="right">{{ $no }}&nbsp;</td>
        <td>{{ $rowdata->transaksi }}</td>
        <td><pre>{{ $rowdata->partno }}<pre></td>
        <td>{{ $rowdata->partname }}</td>
        <td>{{ $rowdata->qty }}</td>
        <td>{{ $rowdata->price }}&nbsp;({{ $rowdata->currency }})</td>
        <td>{{ $rowdata->qtyperitem }}</td>
        <td>{{ $rowdata->unit }}</td>
        <td>{{ $rowdata->xbc }}</td>
        <td>{{ $rowdata->trxdate }}</td>
    </tr>
    @php
        $no=$no+1
    @endphp
    @endforeach
</table>