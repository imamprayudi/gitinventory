{{ header("Content-type: application/vnd-ms-excel") }}
{{ header("Content-Disposition: attachment; filename=Data Population of Ceisa.xls") }}
<table>
    <tr>
        <th colspan="6" style="font-size:18pt;" align="left">Data Population of Ceisa</th>
    </tr>
    <tr><th></th></tr>
</table>
<table border="1">
    <tr>
        <th bgcolor="#C0C0C0">No</th>
        <th bgcolor="#C0C0C0">Period</th>
        <th bgcolor="#C0C0C0">Move Type</th>
        <th bgcolor="#C0C0C0">Type of BC</th>
        <th bgcolor="#C0C0C0">QTY</th>
        <th bgcolor="#C0C0C0">Created At</th>
        <th bgcolor="#C0C0C0">Last Update</th>
    </tr>
    @php
        $no=1
    @endphp
    @foreach ($sql as $rowdata)
        <tr>
            <td align="right">{{ $no }}&nbsp;</td>
            <td>{{ $rowdata->period }}</td>
            <td>{{ $rowdata->movetype }}</td>
            <td>{{ $rowdata->jnsdokbc }}</td>
            <td>{{ number_format($rowdata->qty) }}</td>
            <td>{{ $rowdata->input_user }} {{ $rowdata->input_date }}</td>
            <td>{{ $rowdata->update_user }} {{ $rowdata->update_date }}</td>
        </tr>
    @php
        $no=$no+1
    @endphp
    @endforeach
</table>