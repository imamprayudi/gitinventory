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
    <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.3/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<link rel="stylesheet" href="https://unpkg.com/bs-brain@2.0.4/components/sidebars/sidebar-1/assets/css/sidebar-1.css">
    

    @yield('stylecss')

   
</head>

<body>
    <!-- Header -->
<header id="header-demo">
  <nav class="navbar navbar-expand-sm bg-body-tertiary">
    <div class="container">
      <a class="navbar-brand d-sm-none" href="#!">
        {{-- <img src="./assets/img/bsb-logo.svg" class="img-fluid" alt="BootstrapBrain Logo" width="135" height="44"> --}}
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#bsbNavbar" aria-controls="bsbNavbar" aria-label="Toggle Navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="offcanvas offcanvas-end" tabindex="-1" id="bsbNavbar" aria-labelledby="bsbNavbarLabel">
        <div class="offcanvas-header">
          <h5 class="offcanvas-title" id="bsbNavbarLabel">Menu</h5>
          <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body d-flex justify-content-between">
          <ul class="navbar-nav">
            <li class="nav-item me-3">
              <a class="nav-link" href="#!" data-bs-toggle="offcanvas" data-bs-target="#bsbSidebar1" aria-controls="bsbSidebar1">
                  <i class="bi-filter-left"></i>
                  MENU
              </a>
            </li>
          </ul>
          <form class="d-flex">
            <ul class="navbar-nav">
            {{-- <div class="header-menu"> --}}
                <li class="nav-item">
                    <a class="nav-link"> {{ strtoupper($fullnames) }} </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/login') }}"><i class="fa fa-power -off"></i>Logout</a>
                </li>
            </ul >
        </form>
        </div>
      </div>
    </div>
  </nav>
</header>

<!-- Main -->
<div id="main-demo mx-auto p-2">
    <div class="mx-auto p-2">
        @yield('container')
    </div>
</div>

<!-- Aside -->
<aside class="bsb-sidebar-1 offcanvas offcanvas-start" tabindex="-1" id="bsbSidebar1" aria-labelledby="bsbSidebarLabel1">
  <div class="offcanvas-header">
    {{-- <a class="sidebar-brand" href="#!"> --}}
      JKEI IT INVENTORY

      {{-- <img src="./assets/img/bsb-logo.svg" id="bsbSidebarLabel1" class="img-fluid" alt="BootstrapBrain Logo" width="135" height="44"> --}}
    {{-- </a> --}}
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body pt-0">
    <hr class="sidebar-divider mb-3">
    <ul class="navbar-nav">
      <li class="nav-item {{ (request()->is('home')) ? 'bg-light collapsed' : '' }}">
        <a class="nav-link p-3 {{ (request()->is('home')) ? 'bg-light rounded' : '' }}" data-bs-toggle="collapse" href="#dashboardExamples" role="button" aria-expanded="{{ (request()->is('home')) ? 'true':''}}" aria-controls="dashboardExamples">
          <div class="nav-link-icon text-primary">
            <i class="bi bi-house-gear"></i>
          </div>
          <span class="nav-link-text fw-bold">Dashboards</span>
        </a>
        <div class="collapse {{ (request()->is('home')) ? 'show' : '' }}" id="dashboardExamples">
          <ul class="nav flex-column ms-4">
            <li class="nav-item {{ (request()->is('home')) ? 'active fw-bold text-primary-emphasis' : '' }}">
              <a class="nav-link" aria-current="page" href="{{ url('/home') }}">
                <div class="nav-link-icon text-primary-emphasis">
                  <i class="bi bi-arrow-right-short"></i>
                </div>
                <span class="nav-link-text">Home</span>
              </a>
            </li>
          </ul>
        </div>
      </li>
      <li class="nav-item mt-3">
        <h6 class="py-1 text-secondary text-uppercase fs-7">Pages</h6>
      </li>
      <li class="nav-item {{ (request()->is('input') or request()->is('output')) ? 'bg-light collapsed' : '' }}">
        <a class="nav-link p-3 {{ (request()->is('input') or request()->is('output')) ? 'bg-light rounded' : '' }}" data-bs-toggle="collapse" href="#pageExamples" role="button" aria-expanded="{{ (request()->is('input') or request()->is('output')) ? 'true':''}}" aria-controls="pageExamples">
          <div class="nav-link-icon text-danger">
            <i class="bi bi-folder"></i>
          </div>
          <span class="nav-link-text fw-bold">LAP. PER DOKUMEN PABEAN</span>
        </a>
        <div class="collapse {{ (request()->is('input') or request()->is('output')) ? 'show' : '' }}" id="pageExamples">
          <ul class="nav flex-column ms-4">
            <li class="nav-item {{ (request()->is('input')) ? 'active fw-bold' : '' }}">
              <a class="nav-link link-secondary" aria-current="page" href="{{ url('/input') }}">
                <div class="nav-link-icon text-danger-emphasis">
                  <i class="bi bi-arrow-right-short"></i>
                </div>
                <span class="nav-link-text">Pemasukan</span>
              </a>
            </li>
            <li class="nav-item {{ (request()->is('output')) ? 'active fw-bold' : '' }}">
              <a class="nav-link link-secondary" aria-current="page" href="{{ url('/output') }}">
                <div class="nav-link-icon text-danger-emphasis">
                  <i class="bi bi-arrow-right-short"></i>
                </div>
                <span class="nav-link-text">Pengeluaran</span>
              </a>
            </li>
            {{-- <li class="nav-item">
              <a class="nav-link link-secondary" aria-current="page" href="#!">
                <div class="nav-link-icon text-danger-emphasis">
                  <i class="bi bi-arrow-right-short"></i>
                </div>
                <span class="nav-link-text">Users</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link link-secondary" aria-current="page" href="#!">
                <div class="nav-link-icon text-danger-emphasis">
                  <i class="bi bi-arrow-right-short"></i>
                </div>
                <span class="nav-link-text">Projects</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link link-secondary" aria-current="page" href="#!">
                <div class="nav-link-icon text-danger-emphasis">
                  <i class="bi bi-arrow-right-short"></i>
                </div>
                <span class="nav-link-text">Invoice</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link link-secondary" aria-current="page" href="#!">
                <div class="nav-link-icon text-danger-emphasis">
                  <i class="bi bi-arrow-right-short"></i>
                </div>
                <span class="nav-link-text">Pricing</span>
              </a>
            </li> --}}
          </ul>
        </div>
      </li>
      <li class="nav-item {{ (request()->is('bahan_baku_gm') or
                                request()->is('bahan_baku_gu') or
                                request()->is('bahan_penolong') or
                                request()->is('mesin') or
                                request()->is('sparepart') or
                                request()->is('mold') or
                                request()->is('peralatan_pabrik') or
                                request()->is('konstruksi') or
                                request()->is('kantor') or
                                request()->is('finishgood_gfg') or
                                request()->is('finishgood_gu') or
                                request()->is('pengemas') or
                                request()->is('bahan_baku_contoh') or
                                request()->is('finishgood_contoh') or
                                request()->is('service') or
                                request()->is('scrap')
                                ) ? 'bg-light collapsed' : '' }}">
        <a class="nav-link p-3 {{ (request()->is('bahan_baku_gm') or
                                    request()->is('bahan_baku_gu') or
                                    request()->is('bahan_penolong') or
                                    request()->is('mesin') or
                                    request()->is('sparepart') or
                                    request()->is('mold') or
                                    request()->is('peralatan_pabrik') or
                                    request()->is('konstruksi') or
                                    request()->is('kantor') or
                                    request()->is('finishgood_gfg') or
                                    request()->is('finishgood_gu') or
                                    request()->is('pengemas') or
                                    request()->is('bahan_baku_contoh') or
                                    request()->is('finishgood_contoh') or
                                    request()->is('service') or
                                    request()->is('scrap')
                                    ) ? 'bg-light rounded' : '' }}" data-bs-toggle="collapse" href="#mutasi" role="button" aria-expanded="{{ (request()->is('bahan_baku_gm') or
                                    request()->is('bahan_baku_gu') or
                                    request()->is('bahan_penolong') or
                                    request()->is('mesin') or
                                    request()->is('sparepart') or
                                    request()->is('mold') or
                                    request()->is('peralatan_pabrik') or
                                    request()->is('konstruksi') or
                                    request()->is('kantor') or
                                    request()->is('finishgood_gfg') or
                                    request()->is('finishgood_gu') or
                                    request()->is('pengemas') or
                                    request()->is('bahan_baku_contoh') or
                                    request()->is('finishgood_contoh') or
                                    request()->is('service') or
                                    request()->is('scrap')
                                    ) ? 'true':''}}" aria-controls="mutasi">
          <div class="nav-link-icon text-success">
            <i class="bi bi-pen"></i>
          </div>
          <span class="nav-link-text fw-bold">Laporan Mutasi</span>
        </a>
        <div class="collapse {{ (request()->is('bahan_baku_gm') or
                                    request()->is('bahan_baku_gu') or
                                    request()->is('bahan_penolong') or
                                    request()->is('mesin') or
                                    request()->is('sparepart') or
                                    request()->is('mold') or
                                    request()->is('peralatan_pabrik') or
                                    request()->is('konstruksi') or
                                    request()->is('kantor') or
                                    request()->is('finishgood_gfg') or
                                    request()->is('finishgood_gu') or
                                    request()->is('pengemas') or
                                    request()->is('bahan_baku_contoh') or
                                    request()->is('finishgood_contoh') or
                                    request()->is('service') or
                                    request()->is('scrap')
                                    ) ? 'show' : '' }}" id="mutasi">
          <ul class="nav flex-column ms-4">
            
            <li class="nav-item {{ (request()->is('bahan_baku_gm')) ? 'active fw-bold' : '' }}">
              <a class="nav-link link-secondary" aria-current="page" href="{{ url('/bahan_baku_gm') }}">
                <div class="nav-link-icon text-success-emphasis">
                  <i class="bi bi-arrow-right-short"></i>
                </div>
                <span class="nav-link-text">Bahan Baku - GM</span>
              </a>
            </li>
            @if($userid != 'customs')
            
            <li class="nav-item {{ (request()->is('bahan_baku_gu')) ? 'active fw-bold' : '' }}">
              <a class="nav-link link-secondary" aria-current="page" href="{{ url('/bahan_baku_gu') }}">
                <div class="nav-link-icon text-success-emphasis">
                  <i class="bi bi-arrow-right-short"></i>
                </div>
                <span class="nav-link-text">Bahan Baku - GU</span>
              </a>
            </li>
            <li class="nav-item {{ (request()->is('bahan_penolong')) ? 'active fw-bold' : '' }}">
              <a class="nav-link link-secondary" aria-current="page" href="{{ url('/bahan_penolong') }}">
                <div class="nav-link-icon text-success-emphasis">
                  <i class="bi bi-arrow-right-short"></i>
                </div>
                <span class="nav-link-text">Bahan Penolong</span>
              </a>
            </li>
            <li class="nav-item {{ (request()->is('mesin')) ? 'active fw-bold' : '' }}">
              <a class="nav-link link-secondary" aria-current="page" href="{{ url('/mesin') }}">
                <div class="nav-link-icon text-success-emphasis">
                  <i class="bi bi-arrow-right-short"></i>
                </div>
                <span class="nav-link-text">Barang Modal - Mesin</span>
              </a>
            </li>
            <li class="nav-item {{ (request()->is('sparepart')) ? 'active fw-bold' : '' }}">
              <a class="nav-link link-secondary" aria-current="page" href="{{ url('/sparepart') }}">
                <div class="nav-link-icon text-success-emphasis">
                  <i class="bi bi-arrow-right-short"></i>
                </div>
                <span class="nav-link-text">Barang Modal - Spare Part</span>
              </a>
            </li>
            <li class="nav-item {{ (request()->is('mold')) ? 'active fw-bold' : '' }}">
              <a class="nav-link link-secondary" aria-current="page" href="{{ url('/mold') }}">
                <div class="nav-link-icon text-success-emphasis">
                  <i class="bi bi-arrow-right-short"></i>
                </div>
                <span class="nav-link-text">Barang Modal - Cetakan (Molding)</span>
              </a>
            </li>
            <li class="nav-item {{ (request()->is('peralatan_pabrik')) ? 'active fw-bold' : '' }}">
              <a class="nav-link link-secondary" aria-current="page" href="{{ url('/peralatan_pabrik') }}">
                <div class="nav-link-icon text-success-emphasis">
                  <i class="bi bi-arrow-right-short"></i>
                </div>
                <span class="nav-link-text">Barang Modal - Peralatan Pabrik</span>
              </a>
            </li>
            <li class="nav-item {{ (request()->is('konstruksi')) ? 'active fw-bold' : '' }}">
              <a class="nav-link link-secondary" aria-current="page" href="{{ url('/konstruksi') }}">
                <div class="nav-link-icon text-success-emphasis">
                  <i class="bi bi-arrow-right-short"></i>
                </div>
                <span class="nav-link-text">Barang Modal - Peralatan Konstruksi</span>
              </a>
            </li>
            <li class="nav-item {{ (request()->is('kantor')) ? 'active fw-bold' : '' }}">
              <a class="nav-link link-secondary" aria-current="page" href="{{ url('/kantor') }}">
                <div class="nav-link-icon text-success-emphasis">
                  <i class="bi bi-arrow-right-short"></i>
                </div>
                <span class="nav-link-text">Peralatan Perkantoran</span>
              </a>
            </li>
            @endif
            <li class="nav-item {{ (request()->is('finishgood_gfg')) ? 'active fw-bold' : '' }}">
              <a class="nav-link link-secondary" aria-current="page" href="{{ url('/finishgood_gfg') }}">
                <div class="nav-link-icon text-success-emphasis">
                  <i class="bi bi-arrow-right-short"></i>
                </div>
                <span class="nav-link-text">Hasil Produksi - GFG</span>
              </a>
            </li>
            @if($userid!= 'customs')
            <li class="nav-item {{ (request()->is('finishgood_gu')) ? 'active fw-bold' : '' }}">
              <a class="nav-link link-secondary" aria-current="page" href="{{ url('/finishgood_gu') }}">
                <div class="nav-link-icon text-success-emphasis">
                  <i class="bi bi-arrow-right-short"></i>
                </div>
                <span class="nav-link-text">Hasil Produksi - GU</span>
              </a>
            </li>
            <li class="nav-item {{ (request()->is('pengemas')) ? 'active fw-bold' : '' }}">
              <a class="nav-link link-secondary" aria-current="page" href="{{ url('/pengemas') }}">
                <div class="nav-link-icon text-success-emphasis">
                  <i class="bi bi-arrow-right-short"></i>
                </div>
                <span class="nav-link-text">Pengemas atau Alat Bantu pengemas</span>
              </a>
            </li>
            <li class="nav-item {{ (request()->is('bahan_baku_contoh')) ? 'active fw-bold' : '' }}">
              <a class="nav-link link-secondary" aria-current="page" href="{{ url('/bahan_baku_contoh') }}">
                <div class="nav-link-icon text-success-emphasis">
                  <i class="bi bi-arrow-right-short"></i>
                </div>
                <span class="nav-link-text">Barang Contoh - Bahan Baku</span>
              </a>
            </li>
            <li class="nav-item {{ (request()->is('finishgood_contoh')) ? 'active fw-bold' : '' }}">
              <a class="nav-link link-secondary" aria-current="page" href="{{ url('/finishgood_contoh') }}">
                <div class="nav-link-icon text-success-emphasis">
                  <i class="bi bi-arrow-right-short"></i>
                </div>
                <span class="nav-link-text">Barang Contoh - Barang Jadi</span>
              </a>
            </li>
            <li class="nav-item {{ (request()->is('service')) ? 'active fw-bold' : '' }}">
              <a class="nav-link link-secondary" aria-current="page" href="{{ url('/service') }}">
                <div class="nav-link-icon text-success-emphasis">
                  <i class="bi bi-arrow-right-short"></i>
                </div>
                <span class="nav-link-text">Service Part</span>
              </a>
            </li>
            <li class="nav-item {{ (request()->is('scrap')) ? 'active fw-bold' : '' }}">
              <a class="nav-link link-secondary" aria-current="page" href="{{ url('/scrap') }}">
                <div class="nav-link-icon text-success-emphasis">
                  <i class="bi bi-arrow-right-short"></i>
                </div>
                <span class="nav-link-text">Scrap</span>
              </a>
            </li>
            @endif
          </ul>
        </div>
      </li>
      <li class="nav-item {{ (request()->is('wip')) ? 'bg-light collapsed' : '' }}">
        <a class="nav-link p-3 {{ (request()->is('wip')) ? 'bg-light rounded' : '' }}" data-bs-toggle="collapse" href="#wip" role="button" aria-expanded="{{ (request()->is('wip')) ? 'true':''}}" aria-controls="wip">
          <div class="nav-link-icon text-success">
            <i class="bi bi-cart"></i>
          </div>
          <span class="nav-link-text fw-bold">Laporan Posisi</span>
        </a>
        <div class="collapse {{ (request()->is('wip')) ? 'show' : '' }}" id="wip">
          <ul class="nav flex-column ms-4">
            <li class="nav-item {{ (request()->is('wip')) ? 'active fw-bold' : '' }}">
              <a class="nav-link link-secondary" aria-current="page" href="{{ url('/wip') }}">
                <div class="nav-link-icon text-success-emphasis">
                  <i class="bi bi-arrow-right-short"></i>
                </div>
                <span class="nav-link-text">Barang Dalam Proses (WIP)</span>
              </a>
            </li>
          </ul>
        </div>
      </li>
      {{-- <li class="nav-item {{ (request()->is('opname-bahan_baku_gm') or
                                request()->is('opname-bahan_baku_gu') or
                                request()->is('opname-bahan_penolong') or
                                request()->is('opname-mesin') or
                                request()->is('opname-sparepart') or
                                request()->is('opname-mold') or
                                request()->is('opname-peralatan_pabrik') or
                                request()->is('opname-konstruksi') or
                                request()->is('opname-kantor') or
                                request()->is('opname-finishgood_gfg') or
                                request()->is('opname-finishgood_gu') or
                                request()->is('opname-pengemas') or
                                request()->is('opname-bahan_baku_contoh') or
                                request()->is('opname-finishgood_contoh') or
                                request()->is('opname-service') or
                                request()->is('opname-scrap')
                                ) ? 'bg-light collapsed' : '' }}">
        <a class="nav-link p-3 {{ (request()->is('opname-bahan_baku_gm') or
                                    request()->is('opname-bahan_baku_gu') or
                                    request()->is('opname-bahan_penolong') or
                                    request()->is('opname-mesin') or
                                    request()->is('opname-sparepart') or
                                    request()->is('opname-mold') or
                                    request()->is('opname-peralatan_pabrik') or
                                    request()->is('opname-konstruksi') or
                                    request()->is('opname-kantor') or
                                    request()->is('opname-finishgood_gfg') or
                                    request()->is('opname-finishgood_gu') or
                                    request()->is('opname-pengemas') or
                                    request()->is('opname-bahan_baku_contoh') or
                                    request()->is('opname-finishgood_contoh') or
                                    request()->is('opname-service') or
                                    request()->is('opname-scrap')
                                    ) ? 'bg-light rounded' : '' }}" data-bs-toggle="collapse" href="#stockopname" role="button" aria-expanded="{{ (request()->is('opname-bahan_baku_gm') or
                                    request()->is('opname-bahan_baku_gu') or
                                    request()->is('opname-bahan_penolong') or
                                    request()->is('opname-mesin') or
                                    request()->is('opname-sparepart') or
                                    request()->is('opname-mold') or
                                    request()->is('opname-peralatan_pabrik') or
                                    request()->is('opname-konstruksi') or
                                    request()->is('opname-kantor') or
                                    request()->is('opname-finishgood_gfg') or
                                    request()->is('opname-finishgood_gu') or
                                    request()->is('opname-pengemas') or
                                    request()->is('opname-bahan_baku_contoh') or
                                    request()->is('opname-finishgood_contoh') or
                                    request()->is('opname-service') or
                                    request()->is('opname-scrap')
                                    ) ? 'true':''}}" aria-controls="stockopname">
          <div class="nav-link-icon text-success">
            <i class="bi bi-database-check"></i>
          </div>
          <span class="nav-link-text fw-bold">Stock Opname</span>
        </a>
        <div class="collapse {{ (request()->is('opname-bahan_baku_gm') or
                                    request()->is('opname-bahan_baku_gu') or
                                    request()->is('opname-bahan_penolong') or
                                    request()->is('opname-mesin') or
                                    request()->is('opname-sparepart') or
                                    request()->is('opname-mold') or
                                    request()->is('opname-peralatan_pabrik') or
                                    request()->is('opname-konstruksi') or
                                    request()->is('opname-kantor') or
                                    request()->is('opname-finishgood_gfg') or
                                    request()->is('opname-finishgood_gu') or
                                    request()->is('opname-pengemas') or
                                    request()->is('opname-bahan_baku_contoh') or
                                    request()->is('opname-finishgood_contoh') or
                                    request()->is('opname-service') or
                                    request()->is('opname-scrap')
                                    ) ? 'show' : '' }}" id="stockopname">
          <ul class="nav flex-column ms-4">
            
            <li class="nav-item {{ (request()->is('opname-bahan_baku_gm')) ? 'active fw-bold' : '' }}">
              <a class="nav-link link-secondary" aria-current="page" href="{{ url('/opname-bahan_baku_gm') }}">
                <div class="nav-link-icon text-success-emphasis">
                  <i class="bi bi-arrow-right-short"></i>
                </div>
                <span class="nav-link-text">Bahan Baku - GM</span>
              </a>
            </li>
            <li class="nav-item {{ (request()->is('opname-bahan_baku_gu')) ? 'active fw-bold' : '' }}">
              <a class="nav-link link-secondary" aria-current="page" href="{{ url('/opname-bahan_baku_gu') }}">
                <div class="nav-link-icon text-success-emphasis">
                  <i class="bi bi-arrow-right-short"></i>
                </div>
                <span class="nav-link-text">Bahan Baku - GU</span>
              </a>
            </li>
            <li class="nav-item {{ (request()->is('opname-bahan_penolong')) ? 'active fw-bold' : '' }}">
              <a class="nav-link link-secondary" aria-current="page" href="{{ url('/opname-bahan_penolong') }}">
                <div class="nav-link-icon text-success-emphasis">
                  <i class="bi bi-arrow-right-short"></i>
                </div>
                <span class="nav-link-text">Bahan Penolong</span>
              </a>
            </li>
            <li class="nav-item {{ (request()->is('opname-mesin')) ? 'active fw-bold' : '' }}">
              <a class="nav-link link-secondary" aria-current="page" href="{{ url('/opname-mesin') }}">
                <div class="nav-link-icon text-success-emphasis">
                  <i class="bi bi-arrow-right-short"></i>
                </div>
                <span class="nav-link-text">Barang Modal - Mesin</span>
              </a>
            </li>
            <li class="nav-item {{ (request()->is('opname-sparepart')) ? 'active fw-bold' : '' }}">
              <a class="nav-link link-secondary" aria-current="page" href="{{ url('/opname-sparepart') }}">
                <div class="nav-link-icon text-success-emphasis">
                  <i class="bi bi-arrow-right-short"></i>
                </div>
                <span class="nav-link-text">Barang Modal - Spare Part</span>
              </a>
            </li>
            <li class="nav-item {{ (request()->is('opname-mold')) ? 'active fw-bold' : '' }}">
              <a class="nav-link link-secondary" aria-current="page" href="{{ url('/opname-mold') }}">
                <div class="nav-link-icon text-success-emphasis">
                  <i class="bi bi-arrow-right-short"></i>
                </div>
                <span class="nav-link-text">Barang Modal - Cetakan (Molding)</span>
              </a>
            </li>
            <li class="nav-item {{ (request()->is('opname-peralatan_pabrik')) ? 'active fw-bold' : '' }}">
              <a class="nav-link link-secondary" aria-current="page" href="{{ url('/opname-peralatan_pabrik') }}">
                <div class="nav-link-icon text-success-emphasis">
                  <i class="bi bi-arrow-right-short"></i>
                </div>
                <span class="nav-link-text">Barang Modal - Peralatan Pabrik</span>
              </a>
            </li>
            <li class="nav-item {{ (request()->is('opname-konstruksi')) ? 'active fw-bold' : '' }}">
              <a class="nav-link link-secondary" aria-current="page" href="{{ url('/opname-konstruksi') }}">
                <div class="nav-link-icon text-success-emphasis">
                  <i class="bi bi-arrow-right-short"></i>
                </div>
                <span class="nav-link-text">Barang Modal - Peralatan Konstruksi</span>
              </a>
            </li>
            <li class="nav-item {{ (request()->is('opname-kantor')) ? 'active fw-bold' : '' }}">
              <a class="nav-link link-secondary" aria-current="page" href="{{ url('/opname-kantor') }}">
                <div class="nav-link-icon text-success-emphasis">
                  <i class="bi bi-arrow-right-short"></i>
                </div>
                <span class="nav-link-text">Peralatan Perkantoran</span>
              </a>
            </li>
            <li class="nav-item {{ (request()->is('opname-finishgood_gfg')) ? 'active fw-bold' : '' }}">
              <a class="nav-link link-secondary" aria-current="page" href="{{ url('/opname-finishgood_gfg') }}">
                <div class="nav-link-icon text-success-emphasis">
                  <i class="bi bi-arrow-right-short"></i>
                </div>
                <span class="nav-link-text">Hasil Produksi - GFG</span>
              </a>
            </li>
            <li class="nav-item {{ (request()->is('opname-finishgood_gu')) ? 'active fw-bold' : '' }}">
              <a class="nav-link link-secondary" aria-current="page" href="{{ url('/opname-finishgood_gu') }}">
                <div class="nav-link-icon text-success-emphasis">
                  <i class="bi bi-arrow-right-short"></i>
                </div>
                <span class="nav-link-text">Hasil Produksi - GU</span>
              </a>
            </li>
            <li class="nav-item {{ (request()->is('opname-pengemas')) ? 'active fw-bold' : '' }}">
              <a class="nav-link link-secondary" aria-current="page" href="{{ url('/opname-pengemas') }}">
                <div class="nav-link-icon text-success-emphasis">
                  <i class="bi bi-arrow-right-short"></i>
                </div>
                <span class="nav-link-text">Pengemas atau Alat Bantu pengemas</span>
              </a>
            </li>
            <li class="nav-item {{ (request()->is('opname-bahan_baku_contoh')) ? 'active fw-bold' : '' }}">
              <a class="nav-link link-secondary" aria-current="page" href="{{ url('/opname-bahan_baku_contoh') }}">
                <div class="nav-link-icon text-success-emphasis">
                  <i class="bi bi-arrow-right-short"></i>
                </div>
                <span class="nav-link-text">Barang Contoh - Bahan Baku</span>
              </a>
            </li>
            <li class="nav-item {{ (request()->is('opname-finishgood_contoh')) ? 'active fw-bold' : '' }}">
              <a class="nav-link link-secondary" aria-current="page" href="{{ url('/opname-finishgood_contoh') }}">
                <div class="nav-link-icon text-success-emphasis">
                  <i class="bi bi-arrow-right-short"></i>
                </div>
                <span class="nav-link-text">Barang Contoh - Barang Jadi</span>
              </a>
            </li>
            <li class="nav-item {{ (request()->is('opname-service')) ? 'active fw-bold' : '' }}">
              <a class="nav-link link-secondary" aria-current="page" href="{{ url('/opname-service') }}">
                <div class="nav-link-icon text-success-emphasis">
                  <i class="bi bi-arrow-right-short"></i>
                </div>
                <span class="nav-link-text">Service Part</span>
              </a>
            </li>
            <li class="nav-item {{ (request()->is('opname-scrap')) ? 'active fw-bold' : '' }}">
              <a class="nav-link link-secondary" aria-current="page" href="{{ url('/opname-scrap') }}">
                <div class="nav-link-icon text-success-emphasis">
                  <i class="bi bi-arrow-right-short"></i>
                </div>
                <span class="nav-link-text">Scrap</span>
              </a>
            </li>
          </ul>
        </div>
      </li> --}}
      {{-- <li class="nav-item">
        <a class="nav-link p-3" data-bs-toggle="collapse" href="#ecommerceExamples" role="button" aria-expanded="false" aria-controls="ecommerceExamples">
          <div class="nav-link-icon text-info">
            <i class="bi bi-cart"></i>
          </div>
          <span class="nav-link-text fw-bold">Ecommerce</span>
        </a>
        <div class="collapse" id="ecommerceExamples">
          <ul class="nav flex-column ms-4">
            <li class="nav-item">
              <a class="nav-link link-secondary" aria-current="page" href="#!">
                <div class="nav-link-icon text-info-emphasis">
                  <i class="bi bi-arrow-right-short"></i>
                </div>
                <span class="nav-link-text">Overview</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link link-secondary" aria-current="page" href="#!">
                <div class="nav-link-icon text-info-emphasis">
                  <i class="bi bi-arrow-right-short"></i>
                </div>
                <span class="nav-link-text">Products</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link link-secondary" aria-current="page" href="#!">
                <div class="nav-link-icon text-info-emphasis">
                  <i class="bi bi-arrow-right-short"></i>
                </div>
                <span class="nav-link-text">Orders</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link link-secondary" aria-current="page" href="#!">
                <div class="nav-link-icon text-info-emphasis">
                  <i class="bi bi-arrow-right-short"></i>
                </div>
                <span class="nav-link-text">Referral</span>
              </a>
            </li>
          </ul>
        </div>
      </li> --}}
      {{-- <li class="nav-item">
        <a class="nav-link p-3" data-bs-toggle="collapse" href="#componentExamples" role="button" aria-expanded="false" aria-controls="componentExamples">
          <div class="nav-link-icon text-warning">
            <i class="bi bi-database-check"></i>
          </div>
          <span class="nav-link-text fw-bold">Stock Opname</span>
        </a>
        <div class="collapse" id="componentExamples">
          <ul class="nav flex-column ms-4">
            <li class="nav-item">
              <a class="nav-link link-secondary" aria-current="page" href="#!">
                <div class="nav-link-icon text-warning-emphasis">
                  <i class="bi bi-arrow-right-short"></i>
                </div>
                <span class="nav-link-text">Buttons</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link link-secondary" aria-current="page" href="#!">
                <div class="nav-link-icon text-warning-emphasis">
                  <i class="bi bi-arrow-right-short"></i>
                </div>
                <span class="nav-link-text">Charts</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link link-secondary" aria-current="page" href="#!">
                <div class="nav-link-icon text-warning-emphasis">
                  <i class="bi bi-arrow-right-short"></i>
                </div>
                <span class="nav-link-text">Forms</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link link-secondary" aria-current="page" href="#!">
                <div class="nav-link-icon text-warning-emphasis">
                  <i class="bi bi-arrow-right-short"></i>
                </div>
                <span class="nav-link-text">Icons</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link link-secondary" aria-current="page" href="#!">
                <div class="nav-link-icon text-warning-emphasis">
                  <i class="bi bi-arrow-right-short"></i>
                </div>
                <span class="nav-link-text">Widgets</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link link-secondary" aria-current="page" href="#!">
                <div class="nav-link-icon text-warning-emphasis">
                  <i class="bi bi-arrow-right-short"></i>
                </div>
                <span class="nav-link-text">Notifications</span>
              </a>
            </li>
          </ul>
        </div>
      </li> --}}
      {{-- <li class="nav-item mt-3">
        <h6 class="py-1 text-secondary text-uppercase fs-7">Docs</h6>
      </li>
      <li class="nav-item">
        <a class="nav-link p-3" data-bs-toggle="collapse" href="#basicExamples" role="button" aria-expanded="false" aria-controls="basicExamples">
          <div class="nav-link-icon text-dark">
            <i class="bi bi-pen"></i>
          </div>
          <span class="nav-link-text fw-bold">Basic</span>
        </a>
        <div class="collapse" id="basicExamples">
          <ul class="nav flex-column ms-4">
            <li class="nav-item">
              <a class="nav-link link-secondary" aria-current="page" href="#!">
                <div class="nav-link-icon text-dark-emphasis">
                  <i class="bi bi-arrow-right-short"></i>
                </div>
                <span class="nav-link-text">Getting Started</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link link-secondary" aria-current="page" href="#!">
                <div class="nav-link-icon text-dark-emphasis">
                  <i class="bi bi-arrow-right-short"></i>
                </div>
                <span class="nav-link-text">Foundation</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link link-secondary" aria-current="page" href="#!">
                <div class="nav-link-icon text-dark-emphasis">
                  <i class="bi bi-arrow-right-short"></i>
                </div>
                <span class="nav-link-text">FAQs</span>
              </a>
            </li>
          </ul>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link p-3" data-bs-toggle="collapse" href="#frameworkExamples" role="button" aria-expanded="false" aria-controls="frameworkExamples">
          <div class="nav-link-icon text-dark">
            <i class="bi bi-shield-plus"></i>
          </div>
          <span class="nav-link-text fw-bold">Framework</span>
        </a>
        <div class="collapse" id="frameworkExamples">
          <ul class="nav flex-column ms-4">
            <li class="nav-item">
              <a class="nav-link link-secondary" aria-current="page" href="#!">
                <div class="nav-link-icon text-dark-emphasis">
                  <i class="bi bi-arrow-right-short"></i>
                </div>
                <span class="nav-link-text">Developers</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link link-secondary" aria-current="page" href="#!">
                <div class="nav-link-icon text-dark-emphasis">
                  <i class="bi bi-arrow-right-short"></i>
                </div>
                <span class="nav-link-text">API</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link link-secondary" aria-current="page" href="#!">
                <div class="nav-link-icon text-dark-emphasis">
                  <i class="bi bi-arrow-right-short"></i>
                </div>
                <span class="nav-link-text">Changelog</span>
              </a>
            </li>
          </ul>
        </div>
      </li> --}}
    </ul>
    <hr class="sidebar-divider my-4">
    <div class="bg-light rounded-3 position-relative px-4 pt-5 pb-4 mt-7">
      <div class="bsb-w-80 bsb-h-80 d-flex align-items-center justify-content-center text-bg-primary border border-5 border-white rounded-circle position-absolute top-0 start-50 translate-middle">
        <i class="bi bi-rocket-takeoff lh-1 fs-3"></i>
      </div>
      <div class="text-center">
        <h3 class="h5">GIT ver. 2.0.0</h3>
        <p class="fs-7">JKEI IT INVENTORY</p>
      </div>
    </div>
  </div>
</aside>

<!-- Footer -->
<footer class="footer bg-body-tertiary fixed-bottom">
  <div class="container">
    <div class="row">
      <div class="col">
        <div class="py-3">
          JKEI IT Inventory v.2.0.0 since {{ date('Y')=='2024' ? '2024' : '2024 - ' . date('Y') }}

        </div>
      </div>
    </div>
  </div>
</footer>
    
<script src="https://unpkg.com/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @yield('stylejavascript')
</body>
</html>
