@extends('zlayouts.main')
@php
    $activeMenu = $kategori_data['active_menu'] ?? null;
@endphp
@section($activeMenu, 'active')
@section('container')
<!-- Content -->
<div class="content">
    <!-- Animated -->
    <div class="animated fadeIn">
        <!--  Search data  -->
        <div class="row  justify-content-center">
            <div class="col-sm-12 col-md-8 col-xl-6 mb-2">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h6 class="col-6">Filter</h6>
                    </div>
                    <div class="card-body">
                            <div class="input-group input-group-md">
                                <span class="input-group-text bg-warning bg-opacity-50 text-center"><i class="bi bi-calendar3"></i>&nbsp;Periode (mm/yyyy)</span>
                                
                                <input type="month" class="form-control" name="periode" id="periode" autocomplete="off">
                                <button type="submit" class="btn btn-info" id="btn_cari" onclick="search()"><i class="bi bi-search"></i> Search</button>
                                <button type="button" class="btn btn-secondary" id="btn_download" onclick="download()"><i class="bi bi-download"></i> Download</button>
                                <button type="reset" class="btn btn-warning" id="btn_reset"><i class="bi bi-x-lg"></i> Reset </button>
                            </div>
                    </div>
                </div>
            </div>
        </div>

        <!--  Table data  -->
        <div class="row">
            <div class="col-12">
                <div class="card mb-5">
                    <div class="card-header bg-success-subtle">
                        <div style="float:left">
                            <strong class="card-title">{{ $kategori_data['title'] }}</strong>
                            <p id="spn_totalcount" class="text-sm mb-0"></p>
                        </div>
                        <div style="float:right" class="d-flex d-inline-block align-middle">
                            <div id="writepagination" class="align-middle"></div>
                            <div id="writeloading"></div>
                        </div>
                    </div>
                    <div class="table-responsive table-sm">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center align-middle" rowspan="3">No</th>
                                    <th class="text-center align-middle" rowspan="2" width="20%">Jenis/Nama/Uraian<br>Barang</th>
                                    <th class="text-center align-middle" rowspan="2" width="15%">Kategori<br>Barang</th>
                                    <th class="text-center align-middle" rowspan="2" width="20%">Kode Barang</th>
                                    <th class="text-center align-middle" rowspan="2">Satuan</th>
                                    <th class="text-center align-middle" rowspan="2">Jumlah</th>
                                    <th class="text-center align-middle" colspan="3">ex Dokumen BC</th>
                                    <th class="text-center align-middle" rowspan="2">Keterangan</th>
                                </tr>
                                <tr>
                                    <th class="text-center align-middle"  >Jenis Dokumen</th>
                                    <th class="text-center align-middle"  >Nomor</th>
                                    <th class="text-center align-middle"  >Tanggal</th>
                                </tr>
                                <tr>
                                    <th> <input type="text" class="form-control input-group-sm" name="nama_barang" id="nama_barang"/></th>
                                    <th> <input type="text" class="form-control input-group-sm" name="kategori_barang" id="kategori_barang"/></th>
                                    <th> <input type="text" class="form-control input-group-sm" name="kode_barang" id="kode_barang"/></th>
                                    <th> <input type="text" class="form-control input-group-sm" name="satuan" id="satuan"/></th>
                                    <th> <input type="text" class="form-control input-group-sm" name="jumlah" id="jumlah"/></th>
                                    <th> <input type="text" class="form-control input-group-sm" name="jenis_dokumen_bc" id="jenis_dokumen_bc"/></th>
                                    <th> <input type="text" class="form-control input-group-sm" name="no_bc" id="no_bc"/></th>
                                    <th> <input type="text" class="form-control input-group-sm" name="tanggal_bc" id="tanggal_bc"/></th>
                                    <th> <input type="text" class="form-control input-group-sm" name="keterangan" id="keterangan"/></th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div> <!-- /.table-stats -->
                    <div class="card-footer bg-success-subtle"></div>
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
    var url             = "{{ route('opname-loaddata') }}";
    var urlpaging       = "{{ route('opname-pagination') }}";
    var kategori_barang = "{{ $kategori_data['kategori_barang'] }}";
    var gudang          = "{{ $kategori_data['gudang'] }}";

    document.querySelectorAll('input[type="text"]').forEach(function(input) {
        input.addEventListener('keydown', function(event) {
            if (event.key === 'Enter') {
                event.preventDefault(); // Mencegah perilaku default form
                search();
            }
        });
    });

    
    function search()
    {
        console.log("CLICK SEARCH Opname Bahan Baku Contoh",url)
        //  variable
        var periode = $('#periode').val().replace(/-/g, "");
        // var kategori_barang = $('#kategori_barang').val();
        var nama_barang = $('#nama_barang').val();
        var kode_barang = $('#kode_barang').val();
        var satuan = $('#satuan').val();
        var jumlah = $('#jumlah').val();
        var jenis_dokumen_bc = $('#jenis_dokumen_bc').val();
        var no_bc = $('#no_bc').val();
        var tanggal_bc = $('#tanggal_bc').val();
        var keterangan = $('#keterangan').val();

        $("#loadingdata").remove();
        $("#writeloading").append("<div id='loadingdata' class='text-muted font-italic'> <img src='./zlayouts/images/loadingdata.gif' height='20'><small>&nbsp;Loading data...</small> </div>");
        $.ajax({
            url     : url,
            method  : 'GET',
            data    : {  periode, gudang, kategori_barang, nama_barang, kode_barang, satuan, jumlah, jenis_dokumen_bc,no_bc, tanggal_bc, keterangan},
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
        var periode = $('#periode').val().replace(/-/g, "");
        // var kategori_barang = $('#kategori_barang').val();
        var nama_barang = $('#nama_barang').val();
        var kode_barang = $('#kode_barang').val();
        var satuan = $('#satuan').val();
        var jumlah = $('#jumlah').val();
        var jenis_dokumen_bc = $('#jenis_dokumen_bc').val();
        var no_bc = $('#no_bc').val();
        var tanggal_bc = $('#tanggal_bc').val();
        var keterangan = $('#keterangan').val();

        $("#loadingdata").remove();
        $("#writeloading").append("<div id='loadingdata' class='text-muted font-italic'> <img src='./zlayouts/images/loadingdata.gif' height='20'><small>&nbsp;Loading data...</small> </div>");
        $.ajax({
            url     : urlpaging,
            method  : 'GET',
            data    : {  periode, gudang, kategori_barang, nama_barang, kode_barang, satuan, jumlah, jenis_dokumen_bc,no_bc, tanggal_bc, keterangan},
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
        var periode = $('#periode').val().replace(/-/g, "");
        // var kategori_barang = $('#kategori_barang').val();
        var nama_barang = $('#nama_barang').val();
        var kode_barang = $('#kode_barang').val();
        var satuan = $('#satuan').val();
        var jumlah = $('#jumlah').val();
        var jenis_dokumen_bc = $('#jenis_dokumen_bc').val();
        var no_bc = $('#no_bc').val();
        var tanggal_bc = $('#tanggal_bc').val();
        var keterangan = $('#keterangan').val();

        $("#loadingdata").remove();
        $("#writeloading").append("<div id='loadingdata' class='text-muted font-italic'> <img src='./zlayouts/images/loadingdata.gif' height='20'><small>&nbsp;Loading data...</small> </div>");
        $.ajax({
            url     : urlpaging,
            method  : 'GET',
            data    : {  periode, gudang, kategori_barang, nama_barang, kode_barang, satuan, jumlah, jenis_dokumen_bc,no_bc, tanggal_bc, keterangan},
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
        var periode = $('#periode').val().replace(/-/g, "");
        // var kategori_barang = $('#kategori_barang').val();
        var nama_barang = $('#nama_barang').val();
        var kode_barang = $('#kode_barang').val();
        var satuan = $('#satuan').val();
        var jumlah = $('#jumlah').val();
        var jenis_dokumen_bc = $('#jenis_dokumen_bc').val();
        var no_bc = $('#no_bc').val();
        var tanggal_bc = $('#tanggal_bc').val();
        var keterangan = $('#keterangan').val();

        $("#loadingdata").remove();
        $("#writeloading").append("<div id='loadingdata' class='text-muted font-italic'> <img src='./zlayouts/images/loadingdata.gif' height='20'><small>&nbsp;Loading data...</small> </div>");
        $.ajax({
            url     : urlpaging,
            method  : 'GET',
            data    : {  periode, gudang, kategori_barang, nama_barang, kode_barang, satuan, jumlah, jenis_dokumen_bc,no_bc, tanggal_bc, keterangan},
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
        var periode = $('#periode').val().replace(/-/g, "");
        // var kategori_barang = $('#kategori_barang').val();
        var nama_barang = $('#nama_barang').val();
        var kode_barang = $('#kode_barang').val();
        var satuan = $('#satuan').val();
        var jumlah = $('#jumlah').val();
        var jenis_dokumen_bc = $('#jenis_dokumen_bc').val();
        var no_bc = $('#no_bc').val();
        var tanggal_bc = $('#tanggal_bc').val();
        var keterangan = $('#keterangan').val();

        $("#loadingdata").remove();
        $("#writeloading").append("<div id='loadingdata' class='text-muted font-italic'> <img src='./zlayouts/images/loadingdata.gif' height='20'><small>&nbsp;Loading data...</small> </div>");
        $.ajax({
            url     : urlpaging,
            method  : 'GET',
            data    : {  periode, gudang, kategori_barang, nama_barang, kode_barang, satuan, jumlah, jenis_dokumen_bc,no_bc, tanggal_bc, keterangan},
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
        var periode = $('#periode').val().replace(/-/g, "");
        // var kategori_barang = $('#kategori_barang').val();
        var nama_barang = $('#nama_barang').val();
        var kode_barang = $('#kode_barang').val();
        var satuan = $('#satuan').val();
        var jumlah = $('#jumlah').val();
        var jenis_dokumen_bc = $('#jenis_dokumen_bc').val();
        var no_bc = $('#no_bc').val();
        var tanggal_bc = $('#tanggal_bc').val();
        var keterangan = $('#keterangan').val();

        window.open("opname-download?periode="+periode+"&gudang="+gudang+"&kategori_barang="+kategori_barang+"&kode_barang="+kode_barang+"&nama_barang="+nama_barang+"&satuan="+satuan+"&jumlah="+jumlah+"&jenis_dokumen_bc="+jenis_dokumen_bc+"&no_bc="+no_bc+"&tanggal_bc="+tanggal_bc+"&keterangan="+keterangan);
    }

    function upload(){
        
    }

    //  ***
    //  start ajax
    $(document).ready(function(){
        //  buat tanggal
        var d       = new Date();
        var stmonth   = d.getMonth();
        var enmonth   = d.getMonth()+1;
        var stdate  = d.getFullYear() + '-' + ((''+stmonth).length<2 ? '0' : '') + stmonth;

        //  set value
        $("#periode").val(stdate);
        $("#partno").val('');

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
            var stdate  = d.getFullYear() + '-' +
                            ((''+stmonth).length<2 ? '0' : '') + stmonth;

            //  set value
            $("#periode").val(stdate);
            $("#partno").val('');
            window.location.href =  window.location.href.split("#")[0];
        });
    });
</script>
@endsection
