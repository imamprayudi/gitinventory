@extends('zlayouts.main')
@section('activehome', 'active')

@section('container')
<div class="row justify-content-center">
    <div class="col-12">
        <div class="row align-items-center mb-2">
            <div class="col">
                <h2 class="h5 page-title">Welcome, {{ $fullnames }}</h2>
            </div>
            <div class="col-auto">
                <form class="form-inline">
                    <div class="form-group d-none d-lg-inline">
                        <div id="reportrange" class="px-2 py-2 text-muted">
                            <span class="small">Last updated {{  date_format(date_create($lastsyncinvesaweb),"F d, Y H:i:s") }}</span>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- *** -->
        <!-- Bar -->
        <div class="row items-align-baseline">
            @foreach($sql_bar_twomonth as $databartwomonth)
            <div class="col-md-12 col-lg-4">
                <div class="card shadow eq-card mb-4">
                    <div class="card-body mb-n3">
                        <div class="row items-align-baseline h-100">
                            <div class="col-md-6 my-3">
                                <p class="mb-0"><strong class="mb-0 text-uppercase text-muted">{{ $databartwomonth['monthyear'] }}</strong></p>
                                <h3>{{ $databartwomonth['totaldokinvesa'] }}</h3>
                                <p class="text-muted">Documents at invesa INVESA</p>
                            </div>
                            <div class="col-md-6 my-4 text-center">
                                <div lass="chart-box mx-4">
                                    <input type="hidden" name="percent_twomonth" id="percent_twomonth" value="{{ $databartwomonth['totalpercent'] }}">
                                    <div id="radialbarWidget_twomonth"></div>
                                </div>                                
                            </div>
                            <div class="col-md-12">
                                <a class="small text-muted" href="#!" onclick="btn_twomonth()">View Detail</a>
                            </div>
                            <div class="col-md-6 border-top py-3">
                                <p class="mb-1"><strong class="text-muted">Invesa</strong></p>
                                <h4 class="mb-0">{{ $databartwomonth['totaldokinvesa'] }}</h4>
                                <p class="small text-muted mb-0"><span>All Type of Document BC</span></p>
                            </div>
                            <div class="col-md-6 border-top py-3">
                                <p class="mb-1"><strong class="text-muted">Portal Ceisa</strong></p>
                                <h4 class="mb-0">{{ $databartwomonth['totaldokceisa'] }}</h4>
                                <p class="small text-muted mb-0"><span>All Type of Document BC</span></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

            @foreach($sql_bar_currmonth as $databarcurrmonth)
            <div class="col-md-12 col-lg-4">
                <div class="card shadow eq-card mb-4 bg-light">
                    <div class="card-body">
                        <div class="col-12">
                            <a class="small text-muted" href="#!" onclick="btn_currmonth()">View Detail</a>
                        </div>
                        <div class="chart-box">
                            <input type="hidden" name="percent_currmonth" id="percent_currmonth" value="{{ $databarcurrmonth['totalpercent'] }}">
                            <div id="gradientRadial_currmonth"></div>
                        </div>
                        <div class="row items-align-center">
                            <div class="col-4 text-center">
                                <p class="text-muted mb-1">Invesa</p>
                                <h6 class="mb-1">{{ $databarcurrmonth['totaldokinvesa'] }}</h6>
                            </div>
                            <div class="col-4 text-center">
                                <p class="text-muted text-uppercase mb-1">{{ $databarcurrmonth['monthyear'] }}</p>
                                <p class="text-muted mb-0">All Type of Document BC</p>
                            </div>
                            <div class="col-4 text-center">
                                <p class="text-muted mb-1">Portal Ceisa</p>
                                <h6 class="mb-1">{{ $databarcurrmonth['totaldokceisa'] }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

            @foreach($sql_bar_onemonth as $databaronemonth)
            <div class="col-md-12 col-lg-4">
                <div class="card shadow eq-card mb-4">
                    <div class="card-body mb-n3">
                        <div class="row items-align-baseline h-100">
                            <div class="col-md-6 my-3">
                                <p class="mb-0"><strong class="mb-0 text-uppercase text-muted">{{ $databaronemonth['monthyear'] }}</strong></p>
                                <h3>{{ $databaronemonth['totaldokinvesa'] }}</h3>
                                <p class="text-muted">Documents at invesa INVESA</p>
                            </div>
                            <div class="col-md-6 my-4 text-center">
                                <div lass="chart-box mx-4">
                                    <input type="hidden" name="percent_onemonth" id="percent_onemonth" value="{{ $databaronemonth['totalpercent'] }}">
                                    <div id="radialbarWidget_onemonth"></div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <a class="small text-muted" href="#!" onclick="btn_onemonth()">View Detail</a>
                            </div>
                            <div class="col-md-6 border-top py-3">
                                <p class="mb-1"><strong class="text-muted">Invesa</strong></p>
                                <h4 class="mb-0">{{ $databaronemonth['totaldokinvesa'] }}</h4>
                                <p class="small text-muted mb-0"><span>All Type of Document BC</span></p>
                            </div>
                            <div class="col-md-6 border-top py-3">
                                <p class="mb-1"><strong class="text-muted">Portal Ceisa</strong></p>
                                <h4 class="mb-0">{{ $databaronemonth['totaldokceisa'] }}</h4>
                                <p class="small text-muted mb-0"><span>All Type of Document BC</span></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- *** -->
        <!-- List BC two month -->
        <div class="row" id="div_twomonth">
            @foreach($sql_docin_twomonth as $datadocintwomonth)
            <div class="col-md-6">
                <div class="card shadow mb-4">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="h6 mb-0">Incoming (Pemasukkan)</h3>
                            </div>
                            <div class="col-auto">
                                <h3 class="h6 mb-0 text-muted text-uppercase">{{ $datadocintwomonth['period'] }}</h3>
                            </div>
                        </div>
                    </div>

                    <div class="card-body my-n2">
                        <div class="row align-items-center my-2">
                            <div class="col">
                                <strong>23BC</strong>
                                <div class="my-0 text-muted small">Invesa: {{ $datadocintwomonth['input23bc'] }}</div>
                                <div class="my-0 text-muted small">Portal Ceisa: {{ $datadocintwomonth['ceisa23bc'] }}</div>
                            </div>
                            <div class="col-auto">
                                <strong>{{ $datadocintwomonth['percent23bc'] }}%</strong>
                            </div>
                            <div class="col-3">
                                <div class="progress" style="height: 4px;">
                                    <div class="progress-bar" role="progressbar" style="width: {{ $datadocintwomonth['percent23bc'] }}%" aria-valuenow="{{ $datadocintwomonth['percent23bc'] }}" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row align-items-center my-2">
                            <div class="col">
                                <strong>27BC</strong>
                                <div class="my-0 text-muted small">Invesa: {{ $datadocintwomonth['input27bc'] }}</div>
                                <div class="my-0 text-muted small">Portal Ceisa: {{ $datadocintwomonth['ceisa27bc'] }}</div>
                            </div>
                            <div class="col-auto">
                                <strong>{{ $datadocintwomonth['percent27bc'] }}%</strong>
                            </div>
                            <div class="col-3">
                                <div class="progress" style="height: 4px;">
                                    <div class="progress-bar" role="progressbar" style="width: {{ $datadocintwomonth['percent27bc'] }}%" aria-valuenow="{{ $datadocintwomonth['percent27bc'] }}" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row align-items-center my-2">
                            <div class="col">
                                <strong>40BC</strong>
                                <div class="my-0 text-muted small">Invesa: {{ $datadocintwomonth['input40bc'] }}</div>
                                <div class="my-0 text-muted small">Portal Ceisa: {{ $datadocintwomonth['ceisa40bc'] }}</div>
                            </div>
                            <div class="col-auto">
                                <strong>{{ $datadocintwomonth['percent40bc'] }}%</strong>
                            </div>
                            <div class="col-3">
                                <div class="progress" style="height: 4px;">
                                    <div class="progress-bar" role="progressbar" style="width: {{ $datadocintwomonth['percent40bc'] }}%" aria-valuenow="{{ $datadocintwomonth['percent40bc'] }}" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row align-items-center my-2">
                            <div class="col">
                                <strong>262BC</strong>
                                <div class="my-0 text-muted small">Invesa: {{ $datadocintwomonth['input262bc'] }}</div>
                                <div class="my-0 text-muted small">Portal Ceisa: {{ $datadocintwomonth['ceisa262bc'] }}</div>
                            </div>
                            <div class="col-auto">
                                <strong>{{ $datadocintwomonth['percent262bc'] }}%</strong>
                            </div>
                            <div class="col-3">
                                <div class="progress" style="height: 4px;">
                                    <div class="progress-bar" role="progressbar" style="width: {{ $datadocintwomonth['percent262bc'] }}%" aria-valuenow="{{ $datadocintwomonth['percent262bc'] }}" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

            @foreach($sql_docout_twomonth as $datadocouttwomonth)
            <div class="col-md-6">
                <div class="card shadow mb-4">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="h6 mb-0">Outcoming (Pengeluaran)</h3>
                            </div>
                            <div class="col-auto">
                                <h3 class="h6 mb-0 text-muted text-uppercase">{{ $datadocouttwomonth['period'] }}</h3>
                            </div>
                        </div>
                    </div>

                    <div class="card-body my-n2">
                        <div class="row align-items-center my-2">
                            <div class="col">
                                <strong>25BC</strong>
                                <div class="my-0 text-muted small">Invesa: {{ $datadocouttwomonth['output25bc'] }}</div>
                                <div class="my-0 text-muted small">Portal Ceisa: {{ $datadocouttwomonth['ceisa25bc'] }}</div>
                            </div>
                            <div class="col-auto">
                                <strong>{{ $datadocouttwomonth['percent25bc'] }}%</strong>
                            </div>
                            <div class="col-3">
                                <div class="progress" style="height: 4px;">
                                    <div class="progress-bar" role="progressbar" style="width: {{ $datadocouttwomonth['percent25bc'] }}%" aria-valuenow="{{ $datadocouttwomonth['percent25bc'] }}" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row align-items-center my-2">
                            <div class="col">
                                <strong>27BC</strong>
                                <div class="my-0 text-muted small">Invesa: {{ $datadocouttwomonth['output27bc'] }}</div>
                                <div class="my-0 text-muted small">Portal Ceisa: {{ $datadocouttwomonth['ceisa27bc'] }}</div>
                            </div>
                            <div class="col-auto">
                                <strong>{{ $datadocouttwomonth['percent27bc'] }}%</strong>
                            </div>
                            <div class="col-3">
                                <div class="progress" style="height: 4px;">
                                    <div class="progress-bar" role="progressbar" style="width: {{ $datadocouttwomonth['percent27bc'] }}%" aria-valuenow="{{ $datadocouttwomonth['percent27bc'] }}" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row align-items-center my-2">
                            <div class="col">
                                <strong>30BC</strong>
                                <div class="my-0 text-muted small">Invesa: {{ $datadocouttwomonth['output30bc'] }}</div>
                                <div class="my-0 text-muted small">Portal Ceisa: {{ $datadocouttwomonth['ceisa30bc'] }}</div>
                            </div>
                            <div class="col-auto">
                                <strong>{{ $datadocouttwomonth['percent30bc'] }}%</strong>
                            </div>
                            <div class="col-3">
                                <div class="progress" style="height: 4px;">
                                    <div class="progress-bar" role="progressbar" style="width: {{ $datadocouttwomonth['percent30bc'] }}%" aria-valuenow="{{ $datadocouttwomonth['percent30bc'] }}" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row align-items-center my-2">
                            <div class="col">
                                <strong>41BC</strong>
                                <div class="my-0 text-muted small">Invesa: {{ $datadocouttwomonth['output41bc'] }}</div>
                                <div class="my-0 text-muted small">Portal Ceisa: {{ $datadocouttwomonth['ceisa41bc'] }}</div>
                            </div>
                            <div class="col-auto">
                                <strong>{{ $datadocouttwomonth['percent41bc'] }}%</strong>
                            </div>
                            <div class="col-3">
                                <div class="progress" style="height: 4px;">
                                    <div class="progress-bar" role="progressbar" style="width: {{ $datadocouttwomonth['percent41bc'] }}%" aria-valuenow="{{ $datadocouttwomonth['percent41bc'] }}" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row align-items-center my-2">
                            <div class="col">
                                <strong>261BC</strong>
                                <div class="my-0 text-muted small">Invesa: {{ $datadocouttwomonth['output261bc'] }}</div>
                                <div class="my-0 text-muted small">Portal Ceisa: {{ $datadocouttwomonth['ceisa261bc'] }}</div>
                            </div>
                            <div class="col-auto">
                                <strong>{{ $datadocouttwomonth['percent261bc'] }}%</strong>
                            </div>
                            <div class="col-3">
                                <div class="progress" style="height: 4px;">
                                    <div class="progress-bar" role="progressbar" style="width: {{ $datadocouttwomonth['percent261bc'] }}%" aria-valuenow="{{ $datadocouttwomonth['percent261bc'] }}" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- *** -->
        <!-- List BC one month -->
        <div class="row" id="div_onemonth">
            @foreach($sql_docin_onemonth as $datadocinonemonth)
            <div class="col-md-6">
                <div class="card shadow mb-4">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="h6 mb-0">Incoming (Pemasukkan)</h3>
                            </div>
                            <div class="col-auto">
                                <h3 class="h6 mb-0 text-muted text-uppercase">{{ $datadocinonemonth['period'] }}</h3>
                            </div>
                        </div>
                    </div>

                    <div class="card-body my-n2">
                        <div class="row align-items-center my-2">
                            <div class="col">
                                <strong>23BC</strong>
                                <div class="my-0 text-muted small">Invesa: {{ $datadocinonemonth['input23bc'] }}</div>
                                <div class="my-0 text-muted small">Portal Ceisa: {{ $datadocinonemonth['ceisa23bc'] }}</div>
                            </div>
                            <div class="col-auto">
                                <strong>{{ $datadocinonemonth['percent23bc'] }}%</strong>
                            </div>
                            <div class="col-3">
                                <div class="progress" style="height: 4px;">
                                    <div class="progress-bar" role="progressbar" style="width: {{ $datadocinonemonth['percent23bc'] }}%" aria-valuenow="{{ $datadocinonemonth['percent23bc'] }}" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row align-items-center my-2">
                            <div class="col">
                                <strong>27BC</strong>
                                <div class="my-0 text-muted small">Invesa: {{ $datadocinonemonth['input27bc'] }}</div>
                                <div class="my-0 text-muted small">Portal Ceisa: {{ $datadocinonemonth['ceisa27bc'] }}</div>
                            </div>
                            <div class="col-auto">
                                <strong>{{ $datadocinonemonth['percent27bc'] }}%</strong>
                            </div>
                            <div class="col-3">
                                <div class="progress" style="height: 4px;">
                                    <div class="progress-bar" role="progressbar" style="width: {{ $datadocinonemonth['percent27bc'] }}%" aria-valuenow="{{ $datadocinonemonth['percent27bc'] }}" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row align-items-center my-2">
                            <div class="col">
                                <strong>40BC</strong>
                                <div class="my-0 text-muted small">Invesa: {{ $datadocinonemonth['input40bc'] }}</div>
                                <div class="my-0 text-muted small">Portal Ceisa: {{ $datadocinonemonth['ceisa40bc'] }}</div>
                            </div>
                            <div class="col-auto">
                                <strong>{{ $datadocinonemonth['percent40bc'] }}%</strong>
                            </div>
                            <div class="col-3">
                                <div class="progress" style="height: 4px;">
                                    <div class="progress-bar" role="progressbar" style="width: {{ $datadocinonemonth['percent40bc'] }}%" aria-valuenow="{{ $datadocinonemonth['percent40bc'] }}" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row align-items-center my-2">
                            <div class="col">
                                <strong>262BC</strong>
                                <div class="my-0 text-muted small">Invesa: {{ $datadocinonemonth['input262bc'] }}</div>
                                <div class="my-0 text-muted small">Portal Ceisa: {{ $datadocinonemonth['ceisa262bc'] }}</div>
                            </div>
                            <div class="col-auto">
                                <strong>{{ $datadocinonemonth['percent262bc'] }}%</strong>
                            </div>
                            <div class="col-3">
                                <div class="progress" style="height: 4px;">
                                    <div class="progress-bar" role="progressbar" style="width: {{ $datadocinonemonth['percent262bc'] }}%" aria-valuenow="{{ $datadocinonemonth['percent262bc'] }}" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

            @foreach($sql_docout_onemonth as $datadocoutonemonth)
            <div class="col-md-6">
                <div class="card shadow mb-4">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="h6 mb-0">Outcoming (Pengeluaran)</h3>
                            </div>
                            <div class="col-auto">
                                <h3 class="h6 mb-0 text-muted text-uppercase">{{ $datadocoutonemonth['period'] }}</h3>
                            </div>
                        </div>
                    </div>

                    <div class="card-body my-n2">
                        <div class="row align-items-center my-2">
                            <div class="col">
                                <strong>25BC</strong>
                                <div class="my-0 text-muted small">Invesa: {{ $datadocoutonemonth['output25bc'] }}</div>
                                <div class="my-0 text-muted small">Portal Ceisa: {{ $datadocoutonemonth['ceisa25bc'] }}</div>
                            </div>
                            <div class="col-auto">
                                <strong>{{ $datadocoutonemonth['percent25bc'] }}%</strong>
                            </div>
                            <div class="col-3">
                                <div class="progress" style="height: 4px;">
                                    <div class="progress-bar" role="progressbar" style="width: {{ $datadocoutonemonth['percent25bc'] }}%" aria-valuenow="{{ $datadocoutonemonth['percent25bc'] }}" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row align-items-center my-2">
                            <div class="col">
                                <strong>27BC</strong>
                                <div class="my-0 text-muted small">Invesa: {{ $datadocoutonemonth['output27bc'] }}</div>
                                <div class="my-0 text-muted small">Portal Ceisa: {{ $datadocoutonemonth['ceisa27bc'] }}</div>
                            </div>
                            <div class="col-auto">
                                <strong>{{ $datadocoutonemonth['percent27bc'] }}%</strong>
                            </div>
                            <div class="col-3">
                                <div class="progress" style="height: 4px;">
                                    <div class="progress-bar" role="progressbar" style="width: {{ $datadocoutonemonth['percent27bc'] }}%" aria-valuenow="{{ $datadocoutonemonth['percent27bc'] }}" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row align-items-center my-2">
                            <div class="col">
                                <strong>30BC</strong>
                                <div class="my-0 text-muted small">Invesa: {{ $datadocoutonemonth['output30bc'] }}</div>
                                <div class="my-0 text-muted small">Portal Ceisa: {{ $datadocoutonemonth['ceisa30bc'] }}</div>
                            </div>
                            <div class="col-auto">
                                <strong>{{ $datadocoutonemonth['percent30bc'] }}%</strong>
                            </div>
                            <div class="col-3">
                                <div class="progress" style="height: 4px;">
                                    <div class="progress-bar" role="progressbar" style="width: {{ $datadocoutonemonth['percent30bc'] }}%" aria-valuenow="{{ $datadocoutonemonth['percent30bc'] }}" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row align-items-center my-2">
                            <div class="col">
                                <strong>41BC</strong>
                                <div class="my-0 text-muted small">Invesa: {{ $datadocoutonemonth['output41bc'] }}</div>
                                <div class="my-0 text-muted small">Portal Ceisa: {{ $datadocoutonemonth['ceisa41bc'] }}</div>
                            </div>
                            <div class="col-auto">
                                <strong>{{ $datadocoutonemonth['percent41bc'] }}%</strong>
                            </div>
                            <div class="col-3">
                                <div class="progress" style="height: 4px;">
                                    <div class="progress-bar" role="progressbar" style="width: {{ $datadocoutonemonth['percent41bc'] }}%" aria-valuenow="{{ $datadocoutonemonth['percent41bc'] }}" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row align-items-center my-2">
                            <div class="col">
                                <strong>261BC</strong>
                                <div class="my-0 text-muted small">Invesa: {{ $datadocoutonemonth['output261bc'] }}</div>
                                <div class="my-0 text-muted small">Portal Ceisa: {{ $datadocoutonemonth['ceisa261bc'] }}</div>
                            </div>
                            <div class="col-auto">
                                <strong>{{ $datadocoutonemonth['percent261bc'] }}%</strong>
                            </div>
                            <div class="col-3">
                                <div class="progress" style="height: 4px;">
                                    <div class="progress-bar" role="progressbar" style="width: {{ $datadocoutonemonth['percent261bc'] }}%" aria-valuenow="{{ $datadocoutonemonth['percent261bc'] }}" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- *** -->
        <!-- List BC current month -->
        <div class="row" id="div_currmonth">
            @foreach($sql_docin_currmonth as $datadocincurrmonth)
            <div class="col-md-6">
                <div class="card shadow mb-4">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="h6 mb-0">Incoming (Pemasukkan)</h3>
                            </div>
                            <div class="col-auto">
                                <h3 class="h6 mb-0 text-muted text-uppercase">{{ $datadocincurrmonth['period'] }}</h3>
                            </div>
                        </div>
                    </div>

                    <div class="card-body my-n2">
                        <div class="row align-items-center my-2">
                            <div class="col">
                                <strong>23BC</strong>
                                <div class="my-0 text-muted small">Invesa: {{ $datadocincurrmonth['input23bc'] }}</div>
                                <div class="my-0 text-muted small">Portal Ceisa: {{ $datadocincurrmonth['ceisa23bc'] }}</div>
                            </div>
                            <div class="col-auto">
                                <strong>{{ $datadocincurrmonth['percent23bc'] }}%</strong>
                            </div>
                            <div class="col-3">
                                <div class="progress" style="height: 4px;">
                                    <div class="progress-bar" role="progressbar" style="width: {{ $datadocincurrmonth['percent23bc'] }}%" aria-valuenow="{{ $datadocincurrmonth['percent23bc'] }}" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row align-items-center my-2">
                            <div class="col">
                                <strong>27BC</strong>
                                <div class="my-0 text-muted small">Invesa: {{ $datadocincurrmonth['input27bc'] }}</div>
                                <div class="my-0 text-muted small">Portal Ceisa: {{ $datadocincurrmonth['ceisa27bc'] }}</div>
                            </div>
                            <div class="col-auto">
                                <strong>{{ $datadocincurrmonth['percent27bc'] }}%</strong>
                            </div>
                            <div class="col-3">
                                <div class="progress" style="height: 4px;">
                                    <div class="progress-bar" role="progressbar" style="width: {{ $datadocincurrmonth['percent27bc'] }}%" aria-valuenow="{{ $datadocincurrmonth['percent27bc'] }}" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row align-items-center my-2">
                            <div class="col">
                                <strong>40BC</strong>
                                <div class="my-0 text-muted small">Invesa: {{ $datadocincurrmonth['input40bc'] }}</div>
                                <div class="my-0 text-muted small">Portal Ceisa: {{ $datadocincurrmonth['ceisa40bc'] }}</div>
                            </div>
                            <div class="col-auto">
                                <strong>{{ $datadocincurrmonth['percent40bc'] }}%</strong>
                            </div>
                            <div class="col-3">
                                <div class="progress" style="height: 4px;">
                                    <div class="progress-bar" role="progressbar" style="width: {{ $datadocincurrmonth['percent40bc'] }}%" aria-valuenow="{{ $datadocincurrmonth['percent40bc'] }}" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row align-items-center my-2">
                            <div class="col">
                                <strong>262BC</strong>
                                <div class="my-0 text-muted small">Invesa: {{ $datadocincurrmonth['input262bc'] }}</div>
                                <div class="my-0 text-muted small">Portal Ceisa: {{ $datadocincurrmonth['ceisa262bc'] }}</div>
                            </div>
                            <div class="col-auto">
                                <strong>{{ $datadocincurrmonth['percent262bc'] }}%</strong>
                            </div>
                            <div class="col-3">
                                <div class="progress" style="height: 4px;">
                                    <div class="progress-bar" role="progressbar" style="width: {{ $datadocincurrmonth['percent262bc'] }}%" aria-valuenow="{{ $datadocincurrmonth['percent262bc'] }}" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

            @foreach($sql_docout_currmonth as $datadocoutcurrmonth)
            <div class="col-md-6">
                <div class="card shadow mb-4">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="h6 mb-0">Outcoming (Pengeluaran)</h3>
                            </div>
                            <div class="col-auto">
                                <h3 class="h6 mb-0 text-muted text-uppercase">{{ $datadocoutcurrmonth['period'] }}</h3>
                            </div>
                        </div>
                    </div>

                    <div class="card-body my-n2">
                        <div class="row align-items-center my-2">
                            <div class="col">
                                <strong>25BC</strong>
                                <div class="my-0 text-muted small">Invesa: {{ $datadocoutcurrmonth['output25bc'] }}</div>
                                <div class="my-0 text-muted small">Portal Ceisa: {{ $datadocoutcurrmonth['ceisa25bc'] }}</div>
                            </div>
                            <div class="col-auto">
                                <strong>{{ $datadocoutcurrmonth['percent25bc'] }}%</strong>
                            </div>
                            <div class="col-3">
                                <div class="progress" style="height: 4px;">
                                    <div class="progress-bar" role="progressbar" style="width: {{ $datadocoutcurrmonth['percent25bc'] }}%" aria-valuenow="{{ $datadocoutcurrmonth['percent25bc'] }}" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row align-items-center my-2">
                            <div class="col">
                                <strong>27BC</strong>
                                <div class="my-0 text-muted small">Invesa: {{ $datadocoutcurrmonth['output27bc'] }}</div>
                                <div class="my-0 text-muted small">Portal Ceisa: {{ $datadocoutcurrmonth['ceisa27bc'] }}</div>
                            </div>
                            <div class="col-auto">
                                <strong>{{ $datadocoutcurrmonth['percent27bc'] }}%</strong>
                            </div>
                            <div class="col-3">
                                <div class="progress" style="height: 4px;">
                                    <div class="progress-bar" role="progressbar" style="width: {{ $datadocoutcurrmonth['percent27bc'] }}%" aria-valuenow="{{ $datadocoutcurrmonth['percent27bc'] }}" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row align-items-center my-2">
                            <div class="col">
                                <strong>30BC</strong>
                                <div class="my-0 text-muted small">Invesa: {{ $datadocoutcurrmonth['output30bc'] }}</div>
                                <div class="my-0 text-muted small">Portal Ceisa: {{ $datadocoutcurrmonth['ceisa30bc'] }}</div>
                            </div>
                            <div class="col-auto">
                                <strong>{{ $datadocoutcurrmonth['percent30bc'] }}%</strong>
                            </div>
                            <div class="col-3">
                                <div class="progress" style="height: 4px;">
                                    <div class="progress-bar" role="progressbar" style="width: {{ $datadocoutcurrmonth['percent30bc'] }}%" aria-valuenow="{{ $datadocoutcurrmonth['percent30bc'] }}" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row align-items-center my-2">
                            <div class="col">
                                <strong>41BC</strong>
                                <div class="my-0 text-muted small">Invesa: {{ $datadocoutcurrmonth['output41bc'] }}</div>
                                <div class="my-0 text-muted small">Portal Ceisa: {{ $datadocoutcurrmonth['ceisa41bc'] }}</div>
                            </div>
                            <div class="col-auto">
                                <strong>{{ $datadocoutcurrmonth['percent41bc'] }}%</strong>
                            </div>
                            <div class="col-3">
                                <div class="progress" style="height: 4px;">
                                    <div class="progress-bar" role="progressbar" style="width: {{ $datadocoutcurrmonth['percent41bc'] }}%" aria-valuenow="{{ $datadocoutcurrmonth['percent41bc'] }}" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row align-items-center my-2">
                            <div class="col">
                                <strong>261BC</strong>
                                <div class="my-0 text-muted small">Invesa: {{ $datadocoutcurrmonth['output261bc'] }}</div>
                                <div class="my-0 text-muted small">Portal Ceisa: {{ $datadocoutcurrmonth['ceisa261bc'] }}</div>
                            </div>
                            <div class="col-auto">
                                <strong>{{ $datadocoutcurrmonth['percent261bc'] }}%</strong>
                            </div>
                            <div class="col-3">
                                <div class="progress" style="height: 4px;">
                                    <div class="progress-bar" role="progressbar" style="width: {{ $datadocoutcurrmonth['percent261bc'] }}%" aria-valuenow="{{ $datadocoutcurrmonth['percent261bc'] }}" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection

@section('javascript')
<script>
//  ***
//  function button
function btn_twomonth()
{
    $("#div_twomonth").show();
    $("#div_onemonth").hide();
    $("#div_currmonth").hide();
}
function btn_onemonth()
{
    $("#div_twomonth").hide();
    $("#div_onemonth").show();
    $("#div_currmonth").hide();
}
function btn_currmonth()
{
    $("#div_twomonth").hide();
    $("#div_onemonth").hide();
    $("#div_currmonth").show();
}

//  ***
//  start ajax
$(document).ready(function()
{
    //  ***
    //  document current month
    $("#div_twomonth").hide();
    $("#div_onemonth").hide();
    $("#div_currmonth").show();

    //  ***
    //  set value radian bar twomonth
    var percent_twomonth = $("#percent_twomonth").val();
    var radialbarChart,radialbarOptions={series:[percent_twomonth],chart:{height:140,type:"radialBar"},plotOptions:{radialBar:{hollow:{size:"75%"},track:{background:colors.borderColor},dataLabels:{show:!0,name:{fontSize:"0.875rem",fontWeight:400,offsetY:-10,show:!0,color:colors.mutedColor,fontFamily:base.defaultFontFamily},value:{formatter:function(e){return parseInt(e)},color:colors.headingColor,fontSize:"1.53125rem",fontWeight:700,fontFamily:base.defaultFontFamily,offsetY:5,show:!0},total:{show:!0,fontSize:"0.875rem",fontWeight:400,offsetY:-10,label:"Percent",color:colors.mutedColor,fontFamily:base.defaultFontFamily}}}},fill:{type:"gradient",gradient:{shade:"light",type:"diagonal2",shadeIntensity:.2,gradientFromColors:[extend.primaryColorLighter],gradientToColors:[extend.primaryColorDark],inverseColors:!0,opacityFrom:1,opacityTo:1,stops:[20,100]}},stroke:{lineCap:"round"},labels:["CPU"]},radialbar=document.querySelector("#radialbarWidget_twomonth");radialbar&&(radialbarChart=new ApexCharts(radialbar,radialbarOptions)).render();
    
    //  ***
    //  set value radian bar onemonth
    var percent_onemonth = $("#percent_onemonth").val();
    var radialbarChart,radialbarOptions={series:[percent_onemonth],chart:{height:140,type:"radialBar"},plotOptions:{radialBar:{hollow:{size:"75%"},track:{background:colors.borderColor},dataLabels:{show:!0,name:{fontSize:"0.875rem",fontWeight:400,offsetY:-10,show:!0,color:colors.mutedColor,fontFamily:base.defaultFontFamily},value:{formatter:function(e){return parseInt(e)},color:colors.headingColor,fontSize:"1.53125rem",fontWeight:700,fontFamily:base.defaultFontFamily,offsetY:5,show:!0},total:{show:!0,fontSize:"0.875rem",fontWeight:400,offsetY:-10,label:"Percent",color:colors.mutedColor,fontFamily:base.defaultFontFamily}}}},fill:{type:"gradient",gradient:{shade:"light",type:"diagonal2",shadeIntensity:.2,gradientFromColors:[extend.primaryColorLighter],gradientToColors:[extend.primaryColorDark],inverseColors:!0,opacityFrom:1,opacityTo:1,stops:[20,100]}},stroke:{lineCap:"round"},labels:["CPU"]},radialbar=document.querySelector("#radialbarWidget_onemonth");radialbar&&(radialbarChart=new ApexCharts(radialbar,radialbarOptions)).render();

    //  ***
    //  set value radian bar currmonth
    var percent_currmonth = $("#percent_currmonth").val();
    var gradientRadialChart,gradientRadialOptions={series:[percent_currmonth],chart:{height:200,type:"radialBar",toolbar:{show:!1}},plotOptions:{radialBar:{startAngle:-135,endAngle:225,hollow:{margin:0,size:"70%",background:colors.backgroundColor,image:void 0,imageOffsetX:0,imageOffsetY:0,position:"front"},track:{background:colors.backgroundColor,strokeWidth:"67%",margin:0},dataLabels:{show:!0,name:{fontSize:"0.875rem",fontWeight:400,offsetY:-10,show:!0,color:colors.mutedColor,fontFamily:base.defaultFontFamily},value:{formatter:function(e){return parseInt(e)},color:colors.headingColor,fontSize:"1.53125rem",fontWeight:700,fontFamily:base.defaultFontFamily,offsetY:5,show:!0},total:{show:!0,fontSize:"0.875rem",fontWeight:400,offsetY:-10,color:colors.mutedColor,fontFamily:base.defaultFontFamily}}}},fill:{type:"gradient",gradient:{shade:"dark",type:"horizontal",shadeIntensity:.5,gradientToColors:["#ABE5A1"],inverseColors:!0,opacityFrom:1,opacityTo:1,stops:[0,100]}},stroke:{lineCap:"round"},labels:["Percent"]},gradientRadial=document.querySelector("#gradientRadial_currmonth");gradientRadial&&(gradientRadialChart=new ApexCharts(gradientRadial,gradientRadialOptions)).render();
});
</script>
@endsection