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

    <link rel="stylesheet" href="./dashboard/css/normalize.min.css">
    <link rel="stylesheet" href="./dashboard/css/bootstrap.min.css">
    <link rel="stylesheet" href="./dashboard/css/font-awesome.min.css">
    <link rel="stylesheet" href="./dashboard/css/themify-icons.css">
    <link rel="stylesheet" href="./dashboard/assets/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="./dashboard/assets/css/style.css">

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
    <!-- Right Panel -->
    <div id="right-panel" class="right-panel">
        <!-- Header-->
        <header id="header" class="header">
            <div class="top-left">
                <div class="navbar-header">
                    {{-- <a class="navbar-brand" href="./"><img src="./images/logo_gitinventory.png" alt="Logo"></a> --}}
                    <a id="menuToggle" class="menutoggle" hidden></a>
                </div>
            </div>
            <div class="top-right">
                <div class="header-menu">
                    <div class="user-area dropdown float-right">
                        <a class="navbar-brand" href="{{ url('/login') }}">
                            <img class="user-avatar rounded-circle" src="./dashboard/images/login.png" alt="Login Image">
                        </a>
                    </div>
                </div>
            </div>
        </header>
        <!-- /#header -->

        <!-- Content -->
        <div class="content">
            <!-- Animated -->
            <div class="animated fadeIn">
                <!-- Widgets  -->
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="card bg-flat-color-1">
                            <div class="card-body">
                                <h4 class="card-title m-0  white-color ">Bulan Kemarin</h4>
                            </div>
                            <div class="card-body">
                                <div class="stat-content">
                                    <div class="text-left dib">
                                        <div class="stat-text"><span class="count">23569</span></div>
                                        <div class="stat-heading">Dokumen BC</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-6">
                        <div class="card bg-flat-color-2">
                            <div class="card-body">
                                <h4 class="card-title m-0  white-color ">Bulan Ini</h4>
                            </div>
                            <div class="card-body">
                                <div class="stat-content">
                                    <div class="text-left dib">
                                        <div class="stat-text"><span class="count">213456</span></div>
                                        <div class="stat-heading">Dokumen BC</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Widgets -->
                <!--  Traffic  -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="box-title">Populasi Dokumen Bea Cukai Saat Ini</h4>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card-body">
                                        <div class="progress-box progress-1">
                                            <h4 class="por-title">BC 23 Pemasukkan</h4>
                                            <div class="por-txt">96,930 Dokumen (40%)</div>
                                            <div class="progress mb-2" style="height: 5px;">
                                                <div class="progress-bar bg-flat-color-1" role="progressbar" style="width: 40%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                        <div class="progress-box progress-2">
                                            <h4 class="por-title">BC 27 Pemasukkan</h4>
                                            <div class="por-txt">96,930 Dokumen (40%)</div>
                                            <div class="progress mb-2" style="height: 5px;">
                                                <div class="progress-bar bg-flat-color-2" role="progressbar" style="width: 40%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                        <div class="progress-box progress-2">
                                            <h4 class="por-title">BC 40 Pemasukkan</h4>
                                            <div class="por-txt">3,220 Dokumen (24%)</div>
                                            <div class="progress mb-2" style="height: 5px;">
                                                <div class="progress-bar bg-flat-color-3" role="progressbar" style="width: 24%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                        <div class="progress-box progress-2">
                                            <h4 class="por-title">BC 25 Pengeluaran</h4>
                                            <div class="por-txt">29,658 Users (60%)</div>
                                            <div class="progress mb-2" style="height: 5px;">
                                                <div class="progress-bar bg-flat-color-4" role="progressbar" style="width: 60%;" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                        <div class="progress-box progress-2">
                                            <h4 class="por-title">BC 30 Pengeluaran</h4>
                                            <div class="por-txt">99,658 Dokumen (90%)</div>
                                            <div class="progress mb-2" style="height: 5px;">
                                                <div class="progress-bar bg-flat-color-5" role="progressbar" style="width: 90%;" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </div> <!-- /.card-body -->
                                </div>
                            </div> <!-- /.row -->
                            <div class="card-body"></div>
                        </div>
                    </div><!-- /# column -->
                </div>
                <!--  /Traffic -->
                <div class="clearfix"></div>
            </div>
            <!-- .animated -->
        </div>
        <!-- /.content -->
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
    <script src="./dashboard/js/jquery.min.js"></script>
    <script src="./dashboard/js/popper.min.js"></script>
    <script src="./dashboard/js/bootstrap.min.js"></script>
    <script src="./dashboard/js/jquery.matchHeight.min.js"></script>
    <script src="./dashboard/assets/js/main.js"></script>
    <script>
        jQuery(document).ready(function($) {
            $("#menuToggle").trigger('click');
        });
    </script>
</body>
</html>
