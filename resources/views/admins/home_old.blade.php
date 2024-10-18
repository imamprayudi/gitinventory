@extends('zlayouts.main')
@section('activehome', 'active')
@section('container')
<!-- Content -->
<div class="content">
    <!-- Animated -->
    <div class="animated fadeIn">
    @foreach ($querys as $query)
        <!-- Widgets  -->
        <div class="row">
            <div class="col-lg-4 col-md-4">
                <div class="card bg-flat-color-4">
                    <div class="card-body">
                        <h4 class="card-title m-0  white-color ">{{ $query->kemarinlusa }}</h4>
                    </div>
                    <div class="card-body">
                        <div class="stat-content">
                            <div class="text-left dib">
                                <div class="stat-text"><span class="count">{{ $query->bulankemarinlusa }}</span></div>
                                <div class="stat-heading">BC Document</div>
                                <div class="text-muted" style="font-size:8pt;">
                                    <i>* Last updated {{ $query->syncdata }}</i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-4">
                <div class="card bg-flat-color-5">
                    <div class="card-body">
                        <h4 class="card-title m-0  white-color ">{{ $query->kemarin }}</h4>
                    </div>
                    <div class="card-body">
                        <div class="stat-content">
                            <div class="text-left dib">
                                <div class="stat-text"><span class="count">{{ $query->bulankemarin }}</span></div>
                                <div class="stat-heading">BC Document</div>
                                <div class="text-muted" style="font-size:8pt;">
                                    <i>* Last updated {{ $query->syncdata }}</i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-4">
                <div class="card bg-flat-color-3">
                    <div class="card-body">
                        <h4 class="card-title m-0  white-color ">{{ $query->saatini }}</h4>
                    </div>
                    <div class="card-body">
                        <div class="stat-content">
                            <div class="text-left dib">
                                <div class="stat-text"><span class="count">{{ $query->bulanini }}</span></div>
                                <div class="stat-heading">BC Document</div>
                                <div class="text-muted" style="font-size:8pt;">
                                    <i>* Last updated {{ $query->syncdata }}</i>
                                </div>
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
                        <h4 class="box-title">Population of BC Documents until {{ $query->saatini }}</h4>
                    </div>
                    <div class="row">
                        <!--  Pemasukkan  -->
                        <div class="col-lg-6">
                            <div class="card-body">
                                <div class="progress-box progress-1">
                                    <h4 class="por-title">BC 23 Pemasukkan</h4>
                                    <div class="por-txt">{{ number_format($query->input23bc, 0) }} Document</div>
                                </div>
                                <div class="progress-box progress-2">
                                    <h4 class="por-title">BC 27 Pemasukkan</h4>
                                    <div class="por-txt">{{ number_format($query->input27bc, 0) }} Document</div>
                                </div>
                                <div class="progress-box progress-3">
                                    <h4 class="por-title">BC 40 Pemasukkan</h4>
                                    <div class="por-txt">{{ number_format($query->input40bc, 0) }} Document</div>
                                </div>
                                <div class="progress-box progress-4">
                                    <h4 class="por-title">BC 262 Pemasukkan</h4>
                                    <div class="por-txt">{{ number_format($query->input262bc, 0) }} Document</div>
                                </div>
                            </div> <!-- /.card-body -->
                        </div>
                        <!--  Pengeluaran  -->
                        <div class="col-lg-6">
                            <div class="card-body">
                                <div class="progress-box progress-5">
                                    <h4 class="por-title">BC 25 Pengeluaran</h4>
                                    <div class="por-txt">{{ number_format($query->output25bc, 0) }} Document</div>
                                </div>
                                <div class="progress-box progress-6">
                                    <h4 class="por-title">BC 27 Pengeluaran</h4>
                                    <div class="por-txt">{{ number_format($query->output27bc, 0) }} Document</div>
                                </div>
                                <div class="progress-box progress-7">
                                    <h4 class="por-title">BC 30 Pengeluaran</h4>
                                    <div class="por-txt">{{ number_format($query->output30bc, 0) }} Document</div>
                                </div>
                                <div class="progress-box progress-8">
                                    <h4 class="por-title">BC 41 Pengeluaran</h4>
                                    <div class="por-txt">{{ number_format($query->output41bc, 0) }} Document</div>
                                </div>
                                <div class="progress-box progress-9">
                                    <h4 class="por-title">BC 261 Pengeluaran</h4>
                                    <div class="por-txt">{{ number_format($query->output261bc, 0) }} Document</div>
                                </div>
                            </div> <!-- /.card-body -->
                        </div>
                    </div> <!-- /.row -->
                    <div class="card-body">
                        <div class="text-muted" style="font-size:8pt;">
                            <i>* Last updated {{ $query->syncdata }}</i>
                        </div>
                    </div>
                </div>
            </div><!-- /# column -->
        </div>
        <!--  /Traffic -->
        <div class="clearfix"></div>
    @endforeach
    </div>
    <!-- .animated -->
</div>
<!-- /.content -->
@endsection