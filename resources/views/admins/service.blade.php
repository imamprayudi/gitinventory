@extends('zlayouts.main')
@section('activescrap', 'active')
@section('container')
<!-- Content -->
<div class="content">
    <!-- Animated -->
    <div class="animated fadeIn">
        <!--  Search data  -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="box-title">Search Data </h4>
                    </div>
                    <div class="card-body card-block">
                        <div class="row form-group">
                            {{-- <div class="col-4">
                                <div class="card">
                                    <div class="bg-warning text-center"><small>Item Category</small></div>
                                    <select class="form-control form-control-sm text-uppercase" name="category" id="category">
                                       @foreach ($categories as $key => $category)
                                            <option value="{{ $key }}">{{ $category }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div> --}}
                            <div class="col-12">
                                <div class="card">
                                    <div class="bg-warning bg-opacity-50 text-center"><small>Periode (mm/yyyy)</small></div>
                                    <input type="month" class="form-control form-control-sm" name="periode" id="periode" autocomplete="off">
                                </div>
                            </div>
                            {{-- <div class="col-6">
                                <div class="card">
                                    <div class="bg-warning text-center"><small>Part Number</small></div>
                                    <input type="text" class="form-control form-control-sm text-uppercase" placeholder="please fill in" name="partno" id="partno" autocomplete="off">
                                </div>
                            </div> --}}
                            <div class="col-12 text-center">
                                <div aria-label="Toolbar with button groups">
                                    {{-- <div>
                                        &nbsp;
                                    </div> --}}
                                    <div class="btn-group" role="group" aria-label="First group">
                                        <button type="reset" class="btn btn-warning btn-sm" id="btn_reset">Reset Search</button>
                                        {{-- <button type="button" class="btn btn-secondary btn-sm" id="btn_download">Download</button> --}}
                                        <button type="button" class="btn btn-success btn-sm" id="btn_cari">Search</button>
                                    </div>
                                </div>
                            </div>
                        </div>
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
                            <strong class="card-title">Service Parts <p class="card-text text-muted" id="spn_totalcount"></p></strong>
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
                                    <th class="align-middle">No</th>
                                    <th class="align-middle">Kode Brg</th>
                                    <th class="align-middle">Nama Brg</th>
                                    <th class="align-middle">Sat</th>
                                    <th class="align-middle">Saldo Awal</th>
                                    <th class="align-middle">Pemasukan</th>
                                    <th class="align-middle">Pengeluaran</th>
                                    <th class="align-middle">Penyesuaian</th>
                                    <th class="align-middle">Saldo Buku</th>
                                    <th class="align-middle">Stock Opname</th>
                                    <th class="align-middle">Selisih</th>
                                    <th class="align-middle">Ket</th>
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
var url = "{{ route('scrap.loaddata') }}";
function loaddata()
{
    //  variable
    // var stdate      = $("#stdate").val().replace(/-/g, "");
    // var endate      = $("#endate").val().replace(/-/g, "");
    var partno      = $("#partno").val();
    $("#loadingdata").remove();
    $("#writeloading").append("<div id='loadingdata' class='text-muted font-italic'> <img src='./zlayouts/images/loadingdata.gif' height='20'><small>&nbsp;Loading data...</small> </div>");
    $.ajax({
        url     : url,
        method  : 'GET',
        data    : { stdate:stdate, endate:endate, partno:partno },
        dataType: 'json',
        success : function(data)
        {
            var valraquo = data.halamanAktif + 1;
            $("#loadingdata").remove();
            $('thead').html(data.header);
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
    });
}

function search()
{
    //  variable
    // var category      = $("#category").val();
    var periode      = $("#periode").val().replace(/-/g, "");
    var partno      = $("#partno").val();
    $("#loadingdata").remove();
    $("#writeloading").append("<div id='loadingdata' class='text-muted font-italic'> <img src='./zlayouts/images/loadingdata.gif' height='20'><small>&nbsp;Loading data...</small> </div>");
    // console.log(url);
    // return;
    $.ajax({
        url     : url,
        method  : 'GET',
        // data    : { category:category, periode:periode, partno:partno },
        data    : {  periode:periode, partno:partno },
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
var urlpaging = "{{ route('scrap.pagination') }}";
function first(jumlahHalaman)
{
    //  variable
    var stdate      = $("#stdate").val().replace(/-/g, "");
    var endate      = $("#endate").val().replace(/-/g, "");
    var partno      = $("#partno").val();
    $("#loadingdata").remove();
    $("#writeloading").append("<div id='loadingdata' class='text-muted font-italic'> <img src='./zlayouts/images/loadingdata.gif' height='20'><small>&nbsp;Loading data...</small> </div>");
    $.ajax({
        url     : urlpaging,
        method  : 'GET',
        data    : { stdate:stdate, endate:endate, partno:partno, jumlahHalaman: jumlahHalaman },
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
    var stdate      = $("#stdate").val().replace(/-/g, "");
    var endate      = $("#endate").val().replace(/-/g, "");
    var partno      = $("#partno").val();
    $("#loadingdata").remove();
    $("#writeloading").append("<div id='loadingdata' class='text-muted font-italic'> <img src='./zlayouts/images/loadingdata.gif' height='20'><small>&nbsp;Loading data...</small> </div>");
    $.ajax({
        url     : urlpaging,
        method  : 'GET',
        data    : { stdate:stdate, endate:endate, partno:partno, jumlahHalaman: jumlahHalaman },
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
    var stdate      = $("#stdate").val().replace(/-/g, "");
    var endate      = $("#endate").val().replace(/-/g, "");
    var partno      = $("#partno").val();
    $("#loadingdata").remove();
    $("#writeloading").append("<div id='loadingdata' class='text-muted font-italic'> <img src='./zlayouts/images/loadingdata.gif' height='20'><small>&nbsp;Loading data...</small> </div>");
    $.ajax({
        url     : urlpaging,
        method  : 'GET',
        data    : { stdate:stdate, endate:endate, partno:partno, jumlahHalaman: jumlahHalaman },
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
    var stdate      = $("#stdate").val().replace(/-/g, "");
    var endate      = $("#endate").val().replace(/-/g, "");
    var partno      = $("#partno").val();
    $("#loadingdata").remove();
    $("#writeloading").append("<div id='loadingdata' class='text-muted font-italic'> <img src='./zlayouts/images/loadingdata.gif' height='20'><small>&nbsp;Loading data...</small> </div>");
    $.ajax({
        url     : urlpaging,
        method  : 'GET',
        data    : { stdate:stdate, endate:endate, partno:partno, jumlahHalaman: jumlahHalaman },
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
    var stdate      = $("#stdate").val().replace(/-/g, "");
    var endate      = $("#endate").val().replace(/-/g, "");
    var partno      = $("#partno").val();
    window.open("scrap/download?stdate="+stdate+"&endate="+endate+"&partno="+partno+"");
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
                    ((''+stmonth).length<2 ? '0' : '') + stmonth + '-' +
                    '01';
    var endate  = d.getFullYear() + '-' +
                    ((''+enmonth).length<2 ? '0' : '') + enmonth + '-' +
                    ((''+day).length<2 ? '0' : '') + day;
    //  set value
    $("#stdate").val(stdate);
    $("#endate").val(endate);
    $("#partno").val('');

    //  load data
    // loaddata();

    //  trigger toogle
    $("#menuToggle").trigger('click');

    //  search data
    $('#endate').change(function (){ search(); });
    $("#partno").keydown(function (e){ if(e.keyCode == 13){ search(); }});
    // $("#btn_cari").click(function(){ search(); });
    $("#btn_cari").click(
        // console.log('clicked cari')
    function(){ search(); }
    );
    $("#btn_download").click(function(){ download(); });
    $("#btn_reset").click(function(){
        //  buat tanggal
        var d       = new Date();
        var stmonth   = d.getMonth();
        var enmonth   = d.getMonth()+1;
        var day     = d.getDate();
        var stdate  = d.getFullYear() + '-' +
                        ((''+stmonth).length<2 ? '0' : '') + stmonth + '-' +
                        '01';
        var endate  = d.getFullYear() + '-' +
                        ((''+enmonth).length<2 ? '0' : '') + enmonth + '-' +
                        ((''+day).length<2 ? '0' : '') + day;
        //  set value
        $("#stdate").val(stdate);
        $("#endate").val(endate);
        $("#partno").val('');

        // loaddata();
        window.location.href =  window.location.href.split("#")[0];
    });
});
</script>
@endsection
