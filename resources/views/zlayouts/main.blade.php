<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>GIT Custom Inventory</title>
    <meta name="description" content="GIT Inventory Custom">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="./images/icon_gitinventory.ico">

    <link rel="stylesheet" href="./zlayouts/css/normalize.min.css">
    <link rel="stylesheet" href="./zlayouts/css/bootstrap.min.css">
    <link rel="stylesheet" href="./zlayouts/css/font-awesome.min.css">
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
                            <a href="{{ url('/home') }}"><img src="./zlayouts/images/home.png" height="14px" alt="Main">&emsp;&emsp;Home </a>
                        </li>
                    </li>
                    <li class="menu-title">Daily Transaction</li><!-- /.menu-title -->
                        <li class="@yield('activeinput')">
                            <a href="{{ url('/input') }}"><img src="./zlayouts/images/input.png" height="14px" alt="Pemasukkan">&emsp;&emsp; Pemasukkan</a>
                        </li>
                        <li class="@yield('activeoutput')">
                            <a href="{{ url('/output') }}"><img src="./zlayouts/images/output.png" height="14px" alt="Pengeluaran">&emsp;&emsp; Pengeluaran</a>
                        </li>
                    </li>
                    <li class="menu-title">Laporan Mutasi</li><!-- /.menu-title -->
                        <li class="@yield('activescrap')">
                            <a href="{{ url('/scrap') }}"><img src="./zlayouts/images/input.png" height="14px" alt="Scrap">&emsp;&emsp; Scrap</a>
                        </li>
                        <li class="@yield('activematerial')">
                            <a href="{{ url('/material') }}"><img src="./zlayouts/images/input.png" height="14px" alt="Material">&emsp;&emsp; Material</a>
                        </li>
                        <li class="@yield('activegudangumum')">
                            <a href="{{ url('/gudangumum') }}"><img src="./zlayouts/images/input.png" height="14px" alt="Gudang Umum">&emsp;&emsp; Gudang Umum</a>
                        </li>
                    </li>
                    {{-- <li class="menu-title">Setup</li><!-- /.menu-title -->
                        <li class="@yield('activeuser')">
                            <a href="#"><img src="./zlayouts/images/user.png" height="14px" alt="User">&emsp;&emsp;User </a>
                        </li>
                    </li> --}}
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
                    @if(date('Y') == 2022)
                        <div class="col-sm-6">
                            &copy; {{ date('Y') }} Team G.I.T
                        </div>
                        <div class="col-sm-6 text-right">
                            All Rights Reserved. Version {{ $gitversions }}
                        </div>
                    @else
                        <div class="col-sm-6">
                            &copy; 2022 - {{ date('Y') }} Team G.I.T
                        </div>
                        <div class="col-sm-6 text-right">
                            All Rights Reserved. Version {{ $gitversions }}
                        </div>
                    @endif
                </div>
            </div>
        </footer>
        <!-- /.site-footer -->
    </div>
    <!-- /#right-panel -->

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
    <script src="https://cdn.usebootstrap.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.usebootstrap.com/bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js"></script>
    {{-- <script src="../node_modules/jquery/dist/jquery.min.js"></script> --}}
    {{-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script> --}}
    {{-- <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script> --}}
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script> --}}
    {{-- <script src="./zlayouts/js/popper.min.js"></script> --}}
    {{-- <script src="./zlayouts/js/bootstrap.min.js"></script> --}}
    <script src="./zlayouts/js/jquery.matchHeight.min.js"></script>
    <script src="./zlayouts/assets/js/main.js"></script>

    @yield('stylejavascript')
</body>
</html>
