@extends('zlayouts.main')
@section('active_wip', 'active')
@section('container')
<!-- Content -->
<div class="content">
    <!-- Animated -->
    <div class="animated fadeIn">
        <!--  Search data  -->
        <div class="row  justify-content-center">
            <div class="col-3">
                <div class="card">
                    <div class="card-header">
                        <h4 class="box-title">Search Data </h4>
                    </div>
                    <div class="card-body card-block">
                        <form method="get"></form>
                           <div class="row form-group justify-content-center">
                                <div class="col-12">
                                    <div class="bg-warning bg-opacity-50 text-center"><small>Periode (mm/yyyy)</small></div>
                                    <input type="month" class="form-control form-control-sm" name="periode" id="periode" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="justify-content-between" role="toolbar" aria-label="Toolbar with button groups">
                                    <div>
                                        &nbsp;
                                    </div>
                                    <div class="btn-group" role="group" aria-label="First group">
                                        <button type="reset" class="btn btn-warning btn-sm" id="btn_reset">Reset Search</button>
                                        <button type="button" class="btn btn-secondary btn-sm" id="btn_download" onclick="download()">Download</button>
                                        <button type="submit" class="btn btn-success btn-sm" id="btn_cari" onclick="search()">Search</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!--  Table data  -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <div style="float:left">
                            <strong class="card-title">Laporan Posisi Barang Dalam Proses (WIP)<p class="card-text text-muted" id="spn_totalcount"></p></strong>
                            <div id="writeloading"></div>
                        </div>
                        <div style="float:right">
                            <div id="writepagination"></div>
                        </div>
                    </div>
                    <div class="table-stats order-table ov-h">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th class="align-middle" rowspan="2">No</th>
                                    <th class="align-middle">Kode Lokasi</th>
                                    <th class="align-middle">Nama Lokasi</th>
                                    <th class="align-middle">Kode Barang</th>
                                    <th class="align-middle">Nama Barang</th>
                                    <th class="align-middle">Sat</th>
                                    <th class="align-middle">Jumlah</th>
                                </tr>
                                <tr>
                                    <th class="align-middle"> <input type="text" name="work_center" id="work_center"/></th>
                                    <th class="align-middle"> <input type="text" name="dic" id="dic"/></th>
                                    <th class="align-middle"> <input type="text" name="kode_barang" id="kode_barang"/></th>
                                    <th class="align-middle"> <input type="text" name="nama_barang" id="nama_barang"/></th>
                                    <th class="align-middle"> <input type="text" name="satuan" id="satuan"/></th>
                                    <th class="align-middle"> <input type="text" name="jumlah" id="jumlah"/></th
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div> <!-- /.table-stats -->
                    <div class="card-footer"></div>
                </div>
            </div><!-- /# column -->
        </div>
        <!--  /Table data -->
        <div class="clearfix"></div>
    </div>
    <!-- .animated -->
</div>
<!-- /.content -->
@endsection

@section('stylejavascript')

<script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
<script>
    //  ***
    //  load data
    var url = "{{ route('wip_loaddata') }}";
    var urlpaging = "{{ route('wip_pagination') }}";

    document.querySelectorAll('input[type="text"]').forEach(function(input) {
        input.addEventListener('keydown', function(event) {
            if (event.key === 'Enter') {
                event.preventDefault(); // Mencegah perilaku default form
                // document.querySelector('form').submit(); // Submit form
                search();
            }
        });
    });

    
    function search()
    {
        console.log("CLICK SEARCH WIP")
        //  variable
        var periode     = $("#periode").val().replace(/-/g, "");
        var work_center = $('#work_center').val();
        var dic         = $('#dic').val();
        var kode_barang = $('#kode_barang').val();
        var nama_barang = $('#nama_barang').val();
        var satuan      = $('#satuan').val();
        var jumlah      = $('#jumlah').val();
        
        $("#loadingdata").remove();
        $("#writeloading").append("<div id='loadingdata' class='text-muted font-italic'> <img src='./zlayouts/images/loadingdata.gif' height='20'><small>&nbsp;Loading data...</small> </div>");
        $.ajax({
            url     : url,
            method  : 'GET',
            data    : {  periode, work_center, dic, kode_barang, nama_barang, satuan, jumlah },
            dataType: 'json',
            success : function(data)
            {
                console.log("data => ",data);
                var vallaquo = data.halamanAktif - 1;
                var valraquo = data.halamanAktif + 1;
                $("#loadingdata").remove();
                $('tbody').html(data.table_data);
                //  total count
                if(data.totalcount == 1)
                {
                    $("#spn_totalcount").text("Total data "+data.totalcount+" record");
                }
                else if(data.totalcount > 1)
                {
                    $("#spn_totalcount").text("Total data "+data.totalcount+" records");
                }

                else
                {
                    $("#spn_totalcount").text("Data nothing");
                }
                //  pagination
                if(data.halamanAktif > 1)
                {
                    if(data.halamanAktif < data.jumlahHalaman)
                    {
                        $("#navigation").remove();
                        $("#writepagination").append(""
                        + "<div id='navigation'>"
                            + "<nav class='pagination-outer' aria-label='Page navigation'>"
                            + "<ul class='pagination pagination-sm'>"
                                + "<li class='page-item '><a href='#' class='page-link' aria-label='First' onclick=\'first(1)\'><span aria-hidden='true'>First</span></a></li>"
                                + "<li class='page-item '><a href='#' class='page-link' aria-label='Previous' onclick=\'laquo("+(vallaquo)+")\'><span aria-hidden='true'>«</span></a></li>"
                                + "<li class='page-item disabled active'><a href='#' class='page-link' aria-label='First'><span aria-hidden='true'>"+data.halamanAktif+" of about "+data.jumlahHalaman+" page</span></a></li>"
                                + "<li class='page-item '><a href='#' class='page-link' aria-label='Next' onclick=\'raquo("+(valraquo)+")\'><span aria-hidden='true'>»</span></a></li>"
                                + "<li class='page-item '><a href='#' class='page-link' aria-label='Last' onclick=\'last("+data.jumlahHalaman+")\'><span aria-hidden='true'>Last</span></a></li>"
                            + "</ul>"
                            + "</nav>"
                        + "</div>");
                    }
                    else
                    {
                        $("#navigation").remove();
                        $("#writepagination").append(""
                        + "<div id='navigation'>"
                            + "<nav class='pagination-outer' aria-label='Page navigation'>"
                            + "<ul class='pagination pagination-sm'>"
                                + "<li class='page-item '><a href='#' class='page-link' aria-label='First' onclick=\'first(1)\'><span aria-hidden='true'>First</span></a></li>"
                                + "<li class='page-item '><a href='#' class='page-link' aria-label='Previous' onclick=\'laquo("+(vallaquo)+")\'><span aria-hidden='true'>«</span></a></li>"
                                + "<li class='page-item disabled active'><a href='#' class='page-link' aria-label='First'><span aria-hidden='true'>"+data.halamanAktif+" of about "+data.jumlahHalaman+" page</span></a></li>"
                                + "<li class='page-item disabled'><a href='#' class='page-link' aria-label='Next'><span aria-hidden='true' class='text-muted'>»</span></a></li>"
                                + "<li class='page-item disabled'><a href='#' class='page-link' aria-label='Last'><span aria-hidden='true' class='text-muted'>Last</span></a></li>"
                            + "</ul>"
                            + "</nav>"
                        + "</div>");
                    }
                }
                else
                {
                    if(data.halamanAktif === data.jumlahHalaman)
                    {
                        $("#navigation").remove();
                        $("#writepagination").append(""
                        + "<div id='navigation'>"
                            + "<nav class='pagination-outer' aria-label='Page navigation'>"
                            + "<ul class='pagination pagination-sm'>"
                                + "<li class='page-item disabled'><a href='#' class='page-link' aria-label='First'><span aria-hidden='true' class='text-muted'>First</span></a></li>"
                                + "<li class='page-item disabled'><a href='#' class='page-link' aria-label='Previous'><span aria-hidden='true' class='text-muted'>«</span></a></li>"
                                + "<li class='page-item disabled active'><a href='#' class='page-link' aria-label='First'><span aria-hidden='true'>"+data.halamanAktif+" of about "+data.jumlahHalaman+" page</span></a></li>"
                                + "<li class='page-item disabled'><a href='#' class='page-link' aria-label='Next'><span aria-hidden='true' class='text-muted'>»</span></a></li>"
                                + "<li class='page-item disabled'><a href='#' class='page-link' aria-label='Last'><span aria-hidden='true' class='text-muted'>Last</span></a></li>"
                            + "</ul>"
                            + "</nav>"
                        + "</div>");
                    }
                    else
                    {
                        $("#navigation").remove();
                        $("#writepagination").append(""
                        + "<div id='navigation'>"
                            + "<nav class='pagination-outer' aria-label='Page navigation'>"
                            + "<ul class='pagination pagination-sm'>"
                                + "<li class='page-item disabled'><a href='#' class='page-link' aria-label='First'><span aria-hidden='true' class='text-muted'>First</span></a></li>"
                                + "<li class='page-item disabled'><a href='#' class='page-link' aria-label='Previous'><span aria-hidden='true' class='text-muted'>«</span></a></li>"
                                + "<li class='page-item disabled active'><a href='#' class='page-link' aria-label='First'><span aria-hidden='true'>"+data.halamanAktif+" of about "+data.jumlahHalaman+" page</span></a></li>"
                                + "<li class='page-item '><a href='#' class='page-link' aria-label='Next' onclick=\'raquo("+(valraquo)+")\'><span aria-hidden='true'>»</span></a></li>"
                                + "<li class='page-item '><a href='#' class='page-link' aria-label='Last' onclick=\'last("+data.jumlahHalaman+")\'><span aria-hidden='true'>Last</span></a></li>"
                            + "</ul>"
                            + "</nav>"
                        + "</div>");
                    }
                }
            }
        });
    }

    //  ***
    //  function pagination
    function first(jumlahHalaman)
    {
        //  variable
        var periode     = $("#periode").val().replace(/-/g, "");
        var work_center = $('#work_center').val();
        var dic         = $('#dic').val();
        var kode_barang = $('#kode_barang').val();
        var nama_barang = $('#nama_barang').val();
        var satuan      = $('#satuan').val();
        var jumlah      = $('#jumlah').val();

        $("#loadingdata").remove();
        $("#writeloading").append("<div id='loadingdata' class='text-muted font-italic'> <img src='./zlayouts/images/loadingdata.gif' height='20'><small>&nbsp;Loading data...</small> </div>");
        $.ajax({
            url     : urlpaging,
            method  : 'GET',
            data    : {  periode, work_center, dic, kode_barang, nama_barang, satuan, jumlah },
            dataType: 'json',
            success : function(data)
            {
                var valraquo = data.halamanAktif + 1;
                $("#loadingdata").remove();
                $('tbody').html(data.table_data);
                //  total count
                if(data.totalcount == 1)
                {
                    $("#spn_totalcount").text("Total data "+data.totalcount+" record");
                }
                else if(data.totalcount > 1)
                {
                    $("#spn_totalcount").text("Total data "+data.totalcount+" records");
                }
                else
                {
                    $("#spn_totalcount").text("Data nothing");
                }
                //  pagination
                $("#navigation").remove();
                $("#writepagination").append(""
                + "<div id='navigation'>"
                    + "<nav class='pagination-outer' aria-label='Page navigation'>"
                    + "<ul class='pagination pagination-sm'>"
                        + "<li class='page-item disabled'><a href='#' class='page-link' aria-label='First'><span aria-hidden='true' class='text-muted'>First</span></a></li>"
                        + "<li class='page-item disabled'><a href='#' class='page-link' aria-label='Previous'><span aria-hidden='true' class='text-muted'>«</span></a></li>"
                        + "<li class='page-item disabled active'><a href='#' class='page-link' aria-label='First'><span aria-hidden='true'>"+data.halamanAktif+" of about "+data.jumlahHalaman+" page</span></a></li>"
                        + "<li class='page-item '><a href='#' class='page-link' aria-label='Next' onclick=\'raquo("+(valraquo)+")\'><span aria-hidden='true'>»</span></a></li>"
                        + "<li class='page-item '><a href='#' class='page-link' aria-label='Last' onclick=\'last("+data.jumlahHalaman+")\'><span aria-hidden='true'>Last</span></a></li>"
                    + "</ul>"
                    + "</nav>"
                + "</div>");
            }
        });
    }

    function laquo(jumlahHalaman)
    {
        //  variable
        var periode     = $("#periode").val().replace(/-/g, "");
        var work_center = $('#work_center').val();
        var dic         = $('#dic').val();
        var kode_barang = $('#kode_barang').val();
        var nama_barang = $('#nama_barang').val();
        var satuan      = $('#satuan').val();
        var jumlah      = $('#jumlah').val();

        $("#loadingdata").remove();
        $("#writeloading").append("<div id='loadingdata' class='text-muted font-italic'> <img src='./zlayouts/images/loadingdata.gif' height='20'><small>&nbsp;Loading data...</small> </div>");
        $.ajax({
            url     : urlpaging,
            method  : 'GET',
            data    : {  periode, work_center, dic, kode_barang, nama_barang, satuan, jumlah },
            dataType: 'json',
            success : function(data)
            {
                var vallaquo = data.halamanAktif - 1;
                var valraquo = data.halamanAktif + 1;
                $("#loadingdata").remove();
                $('tbody').html(data.table_data);
                //  total count
                if(data.totalcount == 1)
                {
                    $("#spn_totalcount").text("Total data "+data.totalcount+" record");
                }
                else if(data.totalcount > 1)
                {
                    $("#spn_totalcount").text("Total data "+data.totalcount+" records");
                }
                else
                {
                    $("#spn_totalcount").text("Data nothing");
                }
                //  pagination
                if(data.halamanAktif > 1)
                {
                    $("#navigation").remove();
                    $("#writepagination").append(""
                    + "<div id='navigation'>"
                        + "<nav class='pagination-outer' aria-label='Page navigation'>"
                        + "<ul class='pagination pagination-sm'>"
                            + "<li class='page-item '><a href='#' class='page-link' aria-label='First' onclick=\'first(1)\'><span aria-hidden='true'>First</span></a></li>"
                            + "<li class='page-item '><a href='#' class='page-link' aria-label='Previous' onclick=\'laquo("+(vallaquo)+")\'><span aria-hidden='true'>«</span></a></li>"
                            + "<li class='page-item disabled active'><a href='#' class='page-link' aria-label='First'><span aria-hidden='true'>"+data.halamanAktif+" of about "+data.jumlahHalaman+" page</span></a></li>"
                            + "<li class='page-item '><a href='#' class='page-link' aria-label='Next' onclick=\'raquo("+(valraquo)+")\'><span aria-hidden='true'>»</span></a></li>"
                            + "<li class='page-item '><a href='#' class='page-link' aria-label='Last' onclick=\'last("+data.jumlahHalaman+")\'><span aria-hidden='true'>Last</span></a></li>"
                        + "</ul>"
                        + "</nav>"
                    + "</div>");
                }
                else
                {
                    $("#navigation").remove();
                    $("#writepagination").append(""
                    + "<div id='navigation'>"
                        + "<nav class='pagination-outer' aria-label='Page navigation'>"
                        + "<ul class='pagination pagination-sm'>"
                            + "<li class='page-item disabled'><a href='#' class='page-link' aria-label='First'><span aria-hidden='true' class='text-muted'>First</span></a></li>"
                            + "<li class='page-item disabled'><a href='#' class='page-link' aria-label='Previous'><span aria-hidden='true' class='text-muted'>«</span></a></li>"
                            + "<li class='page-item disabled active'><a href='#' class='page-link' aria-label='First'><span aria-hidden='true'>"+data.halamanAktif+" of about "+data.jumlahHalaman+" page</span></a></li>"
                            + "<li class='page-item '><a href='#' class='page-link' aria-label='Next' onclick=\'raquo("+(valraquo)+")\'><span aria-hidden='true'>»</span></a></li>"
                            + "<li class='page-item '><a href='#' class='page-link' aria-label='Last' onclick=\'last("+data.jumlahHalaman+")\'><span aria-hidden='true'>Last</span></a></li>"
                        + "</ul>"
                        + "</nav>"
                    + "</div>");
                }
            }
        });
    }

    function raquo(jumlahHalaman)
    {
        //  variable
        var periode     = $("#periode").val().replace(/-/g, "");
        var work_center = $('#work_center').val();
        var dic         = $('#dic').val();
        var kode_barang = $('#kode_barang').val();
        var nama_barang = $('#nama_barang').val();
        var satuan      = $('#satuan').val();
        var jumlah      = $('#jumlah').val();

        $("#loadingdata").remove();
        $("#writeloading").append("<div id='loadingdata' class='text-muted font-italic'> <img src='./zlayouts/images/loadingdata.gif' height='20'><small>&nbsp;Loading data...</small> </div>");
        $.ajax({
            url     : urlpaging,
            method  : 'GET',
            data    : {  periode, work_center, dic, kode_barang, nama_barang, satuan, jumlah },
            dataType: 'json',
            success : function(data)
            {
                var vallaquo = data.halamanAktif - 1;
                var valraquo = data.halamanAktif + 1;
                $("#loadingdata").remove();
                $('tbody').html(data.table_data);
                //  total count
                if(data.totalcount == 1)
                {
                    $("#spn_totalcount").text("Total data "+data.totalcount+" record");
                }
                else if(data.totalcount > 1)
                {
                    $("#spn_totalcount").text("Total data "+data.totalcount+" records");
                }
                else
                {
                    $("#spn_totalcount").text("Data nothing");
                }
                //  pagination
                if(data.halamanAktif < data.jumlahHalaman)
                {
                    $("#navigation").remove();
                    $("#writepagination").append(""
                    + "<div id='navigation'>"
                        + "<nav class='pagination-outer' aria-label='Page navigation'>"
                        + "<ul class='pagination pagination-sm'>"
                            + "<li class='page-item '><a href='#' class='page-link' aria-label='First' onclick=\'first(1)\'><span aria-hidden='true'>First</span></a></li>"
                            + "<li class='page-item '><a href='#' class='page-link' aria-label='Previous' onclick=\'laquo("+(vallaquo)+")\'><span aria-hidden='true'>«</span></a></li>"
                            + "<li class='page-item disabled active'><a href='#' class='page-link' aria-label='First'><span aria-hidden='true'>"+data.halamanAktif+" of about "+data.jumlahHalaman+" page</span></a></li>"
                            + "<li class='page-item '><a href='#' class='page-link' aria-label='Next' onclick=\'raquo("+(valraquo)+")\'><span aria-hidden='true'>»</span></a></li>"
                            + "<li class='page-item '><a href='#' class='page-link' aria-label='Last' onclick=\'last("+data.jumlahHalaman+")\'><span aria-hidden='true'>Last</span></a></li>"
                        + "</ul>"
                        + "</nav>"
                    + "</div>");
                }
                else
                {
                    $("#navigation").remove();
                    $("#writepagination").append(""
                    + "<div id='navigation'>"
                        + "<nav class='pagination-outer' aria-label='Page navigation'>"
                        + "<ul class='pagination pagination-sm'>"
                            + "<li class='page-item '><a href='#' class='page-link' aria-label='First' onclick=\'first(1)\'><span aria-hidden='true'>First</span></a></li>"
                            + "<li class='page-item '><a href='#' class='page-link' aria-label='Previous' onclick=\'laquo("+(vallaquo)+")\'><span aria-hidden='true'>«</span></a></li>"
                            + "<li class='page-item disabled active'><a href='#' class='page-link' aria-label='First'><span aria-hidden='true'>"+data.halamanAktif+" of about "+data.jumlahHalaman+" page</span></a></li>"
                            + "<li class='page-item disabled'><a href='#' class='page-link' aria-label='Next'><span aria-hidden='true' class='text-muted'>»</span></a></li>"
                            + "<li class='page-item disabled'><a href='#' class='page-link' aria-label='Last'><span aria-hidden='true' class='text-muted'>Last</span></a></li>"
                        + "</ul>"
                        + "</nav>"
                    + "</div>");
                }
            }
        });
    }

    function last(jumlahHalaman)
    {
        //  variable
        var periode     = $("#periode").val().replace(/-/g, "");
        var work_center = $('#work_center').val();
        var dic         = $('#dic').val();
        var kode_barang = $('#kode_barang').val();
        var nama_barang = $('#nama_barang').val();
        var satuan      = $('#satuan').val();
        var jumlah      = $('#jumlah').val();

        $("#loadingdata").remove();
        $("#writeloading").append("<div id='loadingdata' class='text-muted font-italic'> <img src='./zlayouts/images/loadingdata.gif' height='20'><small>&nbsp;Loading data...</small> </div>");
        $.ajax({
            url     : urlpaging,
            method  : 'GET',
            data    : {  periode, work_center, dic, kode_barang, nama_barang, satuan, jumlah },
            dataType: 'json',
            success : function(data)
            {
                var vallaquo = data.halamanAktif - 1;
                $("#loadingdata").remove();
                $('tbody').html(data.table_data);
                //  total count
                if(data.totalcount == 1)
                {
                    $("#spn_totalcount").text("Total data "+data.totalcount+" record");
                }
                else if(data.totalcount > 1)
                {
                    $("#spn_totalcount").text("Total data "+data.totalcount+" records");
                }
                else
                {
                    $("#spn_totalcount").text("Data nothing");
                }
                //  pagination
                $("#navigation").remove();
                $("#writepagination").append(""
                + "<div id='navigation'>"
                    + "<nav class='pagination-outer' aria-label='Page navigation'>"
                    + "<ul class='pagination pagination-sm'>"
                        + "<li class='page-item '><a href='#' class='page-link' aria-label='First' onclick=\'first(1)\'><span aria-hidden='true'>First</span></a></li>"
                        + "<li class='page-item '><a href='#' class='page-link' aria-label='Previous' onclick=\'laquo("+(vallaquo)+")\'><span aria-hidden='true'>«</span></a></li>"
                        + "<li class='page-item disabled active'><a href='#' class='page-link' aria-label='First'><span aria-hidden='true'>"+data.halamanAktif+" of about "+data.jumlahHalaman+" page</span></a></li>"
                        + "<li class='page-item disabled'><a href='#' class='page-link' aria-label='Next'><span aria-hidden='true' class='text-muted'>»</span></a></li>"
                        + "<li class='page-item disabled'><a href='#' class='page-link' aria-label='Last'><span aria-hidden='true' class='text-muted'>Last</span></a></li>"
                    + "</ul>"
                    + "</nav>"
                + "</div>");
            }
        });
    }

    //  download data
    function download(){
        var periode     = $("#periode").val().replace(/-/g, "");
        var work_center = $('#work_center').val();
        var dic         = $('#dic').val();
        var kode_barang = $('#kode_barang').val();
        var nama_barang = $('#nama_barang').val();
        var satuan      = $('#satuan').val();
        var jumlah      = $('#jumlah').val();

        window.open("wip_download?periode="+periode+"&work_center="+work_center+"&dic="+dic+"&kode_barang="+kode_barang+"&nama_barang="+nama_barang+"&satuan="+satuan+"&jumlah="+jumlah);
    }

    //  ***
    //  start ajax
    $(document).ready(function(){
        //  buat tanggal
        var d       = new Date();
        var stmonth   = d.getMonth();
        var enmonth   = d.getMonth()+1;
        var day     = d.getDate();
        var stdate  = d.getFullYear() + '-' +
                        ((''+stmonth).length<2 ? '0' : '') + stmonth;
        //  set value
        $("#periode").val(stdate);

        //  trigger toogle
        $("#menuToggle").trigger('click');

        //  search data
        $('#endate').change(function (){ search(); });
        $("#partno").keydown(function (e){ if(e.keyCode == 13){ search(); }});
        $("#btn_download").click(function(){ download(); });
        $("#btn_reset").click(function(){
            //  buat tanggal
            var d       = new Date();
            var stmonth   = d.getMonth();
            var enmonth   = d.getMonth()+1;
            var day     = d.getDate();
            var stdate  = d.getFullYear() + '-' +
                            ((''+stmonth).length<2 ? '0' : '') + stmonth;
            //  set value
            $("#periode").val(stdate);
            window.location.href =  window.location.href.split("#")[0];
        });
    });
</script>
@endsection
