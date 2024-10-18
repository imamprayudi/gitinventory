@extends('zlayouts.main')

@section('activehome', 'active')

@section('container')
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
@endsection