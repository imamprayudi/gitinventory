<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>GIT-2 Custom Inventory</title>
    <meta name="description" content="GIT Inventory Custom">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="./images/icon_gitinventory.ico">

    <link rel="stylesheet" href="./zlayouts/css/normalize.min.css">
    {{-- <link rel="stylesheet" href="./zlayouts/css/bootstrap.min.css"> --}}
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous"> --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/fontawesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@icon/themify-icons@1.0.1-alpha.3/themify-icons.min.css">
    <link rel="stylesheet" href="./zlayouts/css/themify-icons.css">
    <link rel="stylesheet" href="./zlayouts/assets/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="./zlayouts/assets/css/style.css">

    @yield('stylecss')

   <style>
    #weatherWidget .currentDesc {
        color: #ffffff!important;
    }
    .traffic-chart {
        min-height: 335px;
    }
    #flotPie1  {
        height: 150px;
    }
    #flotPie1 td {
        padding:3px;
    }
    #flotPie1 table {
        top: 20px!important;
        right: -10px!important;
    }
    .chart-container {
        display: table;
        min-width: 270px ;
        text-align: left;
        padding-top: 10px;
        padding-bottom: 10px;
    }
    #flotLine5  {
            height: 105px;
    }

    #flotBarChart {
        height: 150px;
    }
    #cellPaiChart{
        height: 160px;
    }
    </style>
</head>

<body>
    <!-- Left Panel -->
    <aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-default">
            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="menu-title">Main</li><!-- /.menu-title -->
                        <li class="@yield('activehome')">
                            <a href="{{ url('/home') }}">
                                <img src="./zlayouts/images/home.png"
                                height="14px"
                                alt="Main">
                                Home
                            </a>
                        </li>
                    </li>
                    <li class="menu-title">Transaksi Harian</li><!-- /.menu-title -->
                        <li class="@yield('activeinput')">
                            <a href="{{ url('/input') }}">
                                <img src="./zlayouts/images/input.png"
                                height="14px"
                                alt="Pemasukkan" />
                                Pemasukan
                            </a>
                        </li>
                        <li class="@yield('activeoutput')">
                            <a href="{{ url('/output') }}">
                                <img src="./zlayouts/images/output.png"
                                height="14px"
                                alt="Pengeluaran" />
                                Pengeluaran
                            </a>
                        </li>
                    </li>
                    <li class="menu-title">Laporan Mutasi</li><!-- /.menu-title -->
                        <li class="@yield('active_bahan_baku')">
                            <a href="{{ url('/bahan_baku') }}">
                                <img src="./zlayouts/images/bahanbaku.png"
                                height="14px" alt="Bahan Baku">
                                Bahan Baku
                            </a>
                        </li>
                        <li class="@yield('activefinishgood')">
                            <a href="{{ url('/finishgood') }}">
                                <img src="./zlayouts/images/finishgood.png"
                                height="14px"
                                alt="Finishgood">
                                Hasil Produksi
                            </a>
                        </li>
                        <li class="@yield('active_service')">
                            <a href="{{ url('/service') }}">
                                <img src="./zlayouts/images/service.png"
                                height="14px"
                                alt="Service Part">
                                Service Part
                            </a>
                        </li>
                        <li class="@yield('active_wip')">
                            <a href="{{ url('/wip') }}">
                                <img src="./zlayouts/images/wip.png"
                                height="14px"
                                alt="WIP" />
                                WIP
                            </a>
                        </li>
                        <li class="@yield('active_bahan_baku_contoh')">
                            <a href="{{ url('/bahan_baku_contoh') }}">
                                <img src="./zlayouts/images/bahanbaku.png"
                                height="14px" alt="Barang Contoh Bahan Baku">
                                Barang Contoh Bahan Baku
                            </a>
                        </li>
                         <li class="@yield('active_finishgood_contoh')">
                            <a href="{{ url('/finishgood_contoh') }}">
                                <img src="./zlayouts/images/finishgood.png"
                                height="14px"
                                alt="Barang Contoh Hasil Produksi">
                                Barang Contoh Hasil Produksi
                            </a>
                        </li>
                        <li class="@yield('active_bahan_penolong')">
                            <a href="{{ url('/bahan_penolong') }}">
                                <img src="./zlayouts/images/bahan_penolong.png"
                                height="14px" alt="Bahan Penolong">
                                Bahan Penolong
                            </a>
                        </li>
                        <li class="@yield('active_pengemas')">
                            <a href="{{ url('/pengemas') }}">
                                <img src="./zlayouts/images/pengemas.png"
                                height="14px" alt="Barang Pengemas">
                                Barang Pengemas atau Alat Bantu pengemas
                            </a>
                        </li>
                        <li class="@yield('active_mesin')">
                            <a href="{{ url('/mesin') }}">
                                <img src="./zlayouts/images/mesin.png"
                                height="14px"
                                alt="Barang Modal Mesin">
                                Barang Modal Mesin
                            </a>
                        </li>
                        <li class="@yield('active_sparepart')">
                            <a href="{{ url('/sparepart') }}">
                                <img src="./zlayouts/images/sparepart.png"
                                height="14px"
                                alt="Barang Modal Spare Part">
                                Barang Modal Spare Part
                            </a>
                        </li>
                        <li class="@yield('active_peralatan_pabrik')">
                            <a href="{{ url('/peralatan_pabrik') }}">
                                <img src="./zlayouts/images/peralatan_pabrik.png"
                                height="14px"
                                alt="Barang Modal Peralatan Pabrik">
                                Barang Modal Peralatan Pabrik
                            </a>
                        </li>
                        <li class="@yield('active_mold')">
                            <a href="{{ url('/mold') }}">
                                <img src="./zlayouts/images/mold.png"
                                height="14px"
                                alt="Barang Modal Mold/ Tooling">
                                Barang Modal Mold / Tooling
                            </a>
                        </li>
                        <li class="@yield('active_konstruksi')">
                            <a href="{{ url('/konstruksi') }}">
                                <img src="./zlayouts/images/peralatan_konstruksi.png"
                                height="14px"
                                alt="Barang Modal Peralatan Konstruksi">
                                Barang Modal Peralatan Konstruksi
                            </a>
                        </li>
                        <li class="@yield('active_kantor')">
                            <a href="{{ url('/kantor') }}">
                                <img src="./zlayouts/images/peralatan_kantor.png"
                                height="14px"
                                alt="Peralatan Kantor">
                                Peralatan Kantor
                            </a>
                        </li>
                        <li class="@yield('activescrap')">
                            <a href="{{ url('/scrap') }}">
                                <img src="./zlayouts/images/scrap.png"
                                height="14px"
                                alt="Scrap">
                                Barang Scrap
                            </a>
                        </li>
                    </li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </nav>
    </aside>
    <!-- /#left-panel -->

    <!-- Right Panel -->
    <div id="right-panel" class="right-panel">
        <!-- Header-->
        <header id="header" class="header">
            <div class="top-left">
                <div class="navbar-header">
                    {{-- <a class="navbar-brand" href="{{ url('/home') }}"><img src="./images/logo_gitinventory.png" alt="Logo"></a> --}}
                    <a id="menuToggle" class="menutoggle"><img src="./zlayouts/images/bar.jpg" height="12px" alt="Bar"></a>
                </div>
            </div>
            <div class="top-right">
                <div class="header-menu">
                    <div class="user-area dropdown float-right">
                        <a href="#" class="dropdown-toggle active" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="user-avatar rounded-circle" src="./zlayouts/images/userlogo.png" alt="Logout Image">
                        </a>
                        <div class="user-menu dropdown-menu">
                            <a class="nav-link" href="{{ url('/login') }}"><i class="fa fa-power -off"></i>Logout</a>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- /#header -->

        @yield('container')

        <div class="clearfix"></div>
        <!-- Footer -->
        <footer class="site-footer">
            <div class="footer-inner bg-white" style="font-size:8pt;">
                <div class="row">
                    <div class="col-sm-6">
                        &copy; 2022 - {{ date('Y') }} Team G.I.T
                    </div>
                    <div class="col-sm-6 text-right">
                        All Rights Reserved. Version {{ $gitversions }}
                    </div>
                </div>
            </div>
        </footer>
        <!-- /.site-footer -->
    </div>
    <!-- /#right-panel -->

    <!-- Scripts -->
    {{-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script> --}}
    {{-- <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script> --}}
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>

    {{-- <script src="./zlayouts/js/jquery.matchHeight.min.js"></script>
    <script src="./zlayouts/assets/js/main.js"></script> --}}

    @yield('stylejavascript')
</body>
</html>
