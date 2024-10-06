@extends('zlayouts.main')
@section('active_bahan_baku_gu', 'active')
@section('container')
<!-- Content -->
<div class="content">
    <!-- Animated -->
    <div class="animated fadeIn">
        <!--  Search data  -->
        <div class="row  justify-content-center">
            <div class="col-lg-6 col-md-8 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="box-title">Search Data </h4>
                    </div>
                    <div class="card-body card-block">
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
                            <strong class="card-title">Bahan Baku <p class="card-text text-muted" id="spn_totalcount"></p></strong>
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
                                    <th class="align-middle">Kode Brg</th>
                                    <th class="align-middle">Nama Brg</th>
                                    <th class="align-middle">Sat</th>
                                    <th class="align-middle">Saldo Awal</th>
                                    <th class="align-middle">Pemasukan</th>
                                    <th class="align-middle">Pengeluaran</th>
                                    <th class="align-middle">Penyesuaian<br>(Adjustment)</th>
                                    <th class="align-middle">Saldo Akhir</th>
                                    <th class="align-middle">Hasil Pencacahan<br>(Stock Opname)</th>
                                    <th class="align-middle">Selisih</th>
                                    <th class="align-middle">Ket</th>
                                </tr>
                                <tr>
                                    <th class="align-middle"> <input type="text" name="kode_barang" id="kode_barang"/></th>
                                    <th class="align-middle"> <input type="text" name="nama_barang" id="nama_barang"/></th>
                                    <th class="align-middle"> <input type="text" name="satuan" id="satuan"/></th>
                                    <th class="align-middle"> <input type="text" name="saldo_awal" id="saldo_awal"/></th>
                                    <th class="align-middle"> <input type="text" name="pemasukan" id="pemasukan"/></th>
                                    <th class="align-middle"> <input type="text" name="pengeluaran" id="pengeluaran"/></th>
                                    <th class="align-middle"> <input type="text" name="penyesuaian" id="penyesuaian"/></th>
                                    <th class="align-middle"> <input type="text" name="saldo_buku" id="saldo_buku"/></th>
                                    <th class="align-middle"> <input type="text" name="stock_opame" id="stock_opame"/></th>
                                    <th class="align-middle"> <input type="text" name="selisih" id="selisih"/></th>
                                    <th class="align-middle"> <input type="text" name="keterangan" id="keterangan"/></th>
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
    var url = "{{ route('mutation') }}";

    document.querySelectorAll('input[type="text"]').forEach(function(input) {
        input.addEventListener('keydown', function(event) {
            if (event.key === 'Enter') {
                event.preventDefault(); // Mencegah perilaku default form
                // document.querySelector('form').submit(); // Submit form
                search();
            }
        });
    });
// function search() {
//     console.log("CLICK SEARCH BAHAN BAKU");

//     // Ambil nilai dari form input
//     var periode = document.querySelector('#periode').value;
//     var kode_barang = document.querySelector('#kode_barang').value;
//     var nama_barang = document.querySelector('#nama_barang').value;
//     var satuan = document.querySelector('#satuan').value;
//     var saldo_awal = document.querySelector('#saldo_awal').value;
//     var pemasukan = document.querySelector('#pemasukan').value;
//     var pengeluaran = document.querySelector('#pengeluaran').value;
//     var penyesuaian = document.querySelector('#penyesuaian').value;
//     var saldo_buku = document.querySelector('#saldo_buku').value;
//     var stock_opame = document.querySelector('#stock_opame').value;
//     var selisih = document.querySelector('#selisih').value;
//     var keterangan = document.querySelector('#keterangan').value;

//     // Tampilkan loading
//     $("#loadingdata").remove();
//     $("#writeloading").append("<div id='loadingdata' class='text-muted font-italic'> <img src='./zlayouts/images/loadingdata.gif' height='20'><small>&nbsp;Loading data...</small> </div>");

//     // Kirim data ke server menggunakan AJAX
//     $.ajax({
//         url: url, // URL backend yang dituju
//         method: 'GET',
//         data: {
//             periode: periode,
//             kode_barang: kode_barang,
//             nama_barang: nama_barang,
//             satuan: satuan,
//             saldo_awal: saldo_awal,
//             pemasukan: pemasukan,
//             pengeluaran: pengeluaran,
//             penyesuaian: penyesuaian,
//             saldo_buku: saldo_buku,
//             stock_opame: stock_opame,
//             selisih: selisih,
//             keterangan: keterangan,
//             kategori: kategori
//         },
//         dataType: 'json',
//         success: function(data) {
//             console.log("data => ", data);

//             var vallaquo = data.halamanAktif - 1;
//             var valraquo = data.halamanAktif + 1;

//             // Hapus loading data
//             $("#loadingdata").remove();
//             $('tbody').html(data.table_data);

//             // Total count
//             if (data.totalcount == 1) {
//                 $("#spn_totalcount").text("Total data " + data.totalcount + " record");
//             } else if (data.totalcount > 1) {
//                 $("#spn_totalcount").text("Total data " + data.totalcount + " records");
//             } else {
//                 $("#spn_totalcount").text("Data nothing");
//             }

//             // Pagination
//             handlePagination(data, vallaquo, valraquo);
//         }
//     });
// }

// // Function untuk menangani pagination
// function handlePagination(data, vallaquo, valraquo) {
//     if (data.halamanAktif > 1) {
//         if (data.halamanAktif < data.jumlahHalaman) {
//             generatePagination(data, vallaquo, valraquo, false);
//         } else {
//             generatePagination(data, vallaquo, valraquo, true);
//         }
//     } else {
//         if (data.halamanAktif === data.jumlahHalaman) {
//             generatePagination(data, vallaquo, valraquo, true);
//         } else {
//             generatePagination(data, vallaquo, valraquo, false);
//         }
//     }
// }

// // Function untuk generate pagination HTML
// function generatePagination(data, vallaquo, valraquo, isLastPage) {
//     $("#navigation").remove();
//     var disabled = isLastPage ? 'disabled' : '';
//     var nextDisabled = (isLastPage) ? 'disabled' : '';
//     var prevDisabled = (data.halamanAktif == 1) ? 'disabled' : '';

//     $("#writepagination").append(`
//         <div id='navigation'>
//             <nav class='pagination-outer' aria-label='Page navigation'>
//                 <ul class='pagination pagination-sm'>
//                     <li class='page-item ${prevDisabled}'><a href='#' class='page-link' aria-label='First' onclick='first(1)'><span aria-hidden='true'>First</span></a></li>
//                     <li class='page-item ${prevDisabled}'><a href='#' class='page-link' aria-label='Previous' onclick='laquo(${vallaquo})'><span aria-hidden='true'>«</span></a></li>
//                     <li class='page-item disabled active'><a href='#' class='page-link' aria-label='First'><span aria-hidden='true'>${data.halamanAktif} of about ${data.jumlahHalaman} page</span></a></li>
//                     <li class='page-item ${nextDisabled}'><a href='#' class='page-link' aria-label='Next' onclick='raquo(${valraquo})'><span aria-hidden='true'>»</span></a></li>
//                     <li class='page-item ${nextDisabled}'><a href='#' class='page-link' aria-label='Last' onclick='last(${data.jumlahHalaman})'><span aria-hidden='true'>Last</span></a></li>
//                 </ul>
//             </nav>
//         </div>
//     `);
// }
    
    //  ***
    //  load data
    var url = "{{ route('mutation') }}";
    var urlpaging = "{{ route('mutation_page') }}";
    var kategori      = 'Bahan baku';
    var gudang      = 'Gudang Umum';

    function search()
    {
        console.log("CLICK SEARCH BAHAN BAKU")
        let periode = document.querySelector('#periode').value;
        let kode_barang = document.querySelector('#kode_barang').value;
        let nama_barang = document.querySelector('#nama_barang').value;
        let satuan = document.querySelector('#satuan').value;
        let saldo_awal = document.querySelector('#saldo_awal').value;
        let pemasukan = document.querySelector('#pemasukan').value;
        let pengeluaran = document.querySelector('#pengeluaran').value;
        let penyesuaian = document.querySelector('#penyesuaian').value;
        let saldo_buku = document.querySelector('#saldo_buku').value;
        let stock_opame = document.querySelector('#stock_opame').value;
        let selisih = document.querySelector('#selisih').value;
        let keterangan = document.querySelector('#keterangan').value;

        $("#loadingdata").remove();
        $("#writeloading").append("<div id='loadingdata' class='text-muted font-italic'> <img src='./zlayouts/images/loadingdata.gif' height='20'><small>&nbsp;Loading data...</small> </div>");
        $.ajax({
            url     : url,
            method  : 'GET',
            data    : {  periode,  kategori, gudang,  kode_barang,  nama_barang,  satuan,  pemasukan,  pengeluaran,  penyesuaian,  saldo_buku,  stock_opame,  selisih,  keterangan },
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
        var periode       = $("#periode").val();

        $("#loadingdata").remove();
        $("#writeloading").append("<div id='loadingdata' class='text-muted font-italic'> <img src='./zlayouts/images/loadingdata.gif' height='20'><small>&nbsp;Loading data...</small> </div>");
        $.ajax({
            url     : urlpaging,
            method  : 'GET',
            data    : {  periode,  kategori, jumlahHalaman },
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
        var periode       = $("#periode").val(); 
        $("#loadingdata").remove();
        $("#writeloading").append("<div id='loadingdata' class='text-muted font-italic'> <img src='./zlayouts/images/loadingdata.gif' height='20'><small>&nbsp;Loading data...</small> </div>");
        $.ajax({
            url     : urlpaging,
            method  : 'GET',
            data    : {  periode,  kategori , jumlahHalaman },
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
        var periode       = $("#periode").val();

        $("#loadingdata").remove();
        $("#writeloading").append("<div id='loadingdata' class='text-muted font-italic'> <img src='./zlayouts/images/loadingdata.gif' height='20'><small>&nbsp;Loading data...</small> </div>");
        $.ajax({
            url     : urlpaging,
            method  : 'GET',
            data    : {  periode, kategori , jumlahHalaman },
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
        var periode       = $("#periode").val(); 
        $("#loadingdata").remove();
        $("#writeloading").append("<div id='loadingdata' class='text-muted font-italic'> <img src='./zlayouts/images/loadingdata.gif' height='20'><small>&nbsp;Loading data...</small> </div>");
        $.ajax({
            url     : urlpaging,
            method  : 'GET',
            data    : {  periode, kode_barang, kategori , jumlahHalaman },
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
        var periode       = $("#periode").val(); //.replace(/-/g, "");
        var kode_barang   = $("#partno").val();
        window.open("mutation-download?periode="+periode+"&kategori="+kategori+"");
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
        // $("#btn_cari").click(search());
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
    */
</script>
@endsection
