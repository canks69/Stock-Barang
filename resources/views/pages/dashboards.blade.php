@php
    $html_tag_data = [];
    $title = 'Dashboards';
    $description = 'Layouts that are focused on different project needs. Contains html blocks and specific plugins that are fit for the context.';
    $breadcrumbs = ["/dashboards"=>"Dashboards"]
@endphp

@extends('layouts.app',['html_tag_data'=>$html_tag_data, 'title'=>$title, 'description'=>$description])

@section('css')
@endsection

@section('js_vendor')
    <script src="/js/vendor/Chart.bundle.min.js"></script>
    <script src="/js/vendor/chartjs-plugin-datalabels.js"></script>
    <script src="/js/vendor/chartjs-plugin-rounded-bar.min.js"></script>
@endsection

@section('js_page')
    <script src="/js/cs/charts.extend.js"></script>
    <script src="/js/pages/dashboard.analytic.js"></script>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="page-title-container">
                <h1 class="mb-0 pb-0 display-4" id="title">{{ $title }}</h1>
                @include('components.breadcrumb',['breadcrumbs'=>$breadcrumbs])
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-lg-6">
            <!-- Stats Start -->
            <div class="d-flex">
                <div class="dropdown-as-select me-3" data-setActive="false" data-childSelector="span">
                    <a class="pe-0 pt-0 align-top lh-1 dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-expanded="false" aria-haspopup="true">
                        <span class="small-title"></span>
                    </a>
                    <div class="dropdown-menu font-standard">
                        <div class="nav flex-column" role="tablist">
                            <a class="active dropdown-item text-medium" href="#" aria-selected="true" role="tab">Today's</a>
                            <a class="dropdown-item text-medium" href="#" aria-selected="false" role="tab">Weekly</a>
                            <a class="dropdown-item text-medium" href="#" aria-selected="false" role="tab">Monthly</a>
                            <a class="dropdown-item text-medium" href="#" aria-selected="false" role="tab">Yearly</a>
                        </div>
                    </div>
                </div>
                <h2 class="small-title">Stats</h2>
            </div>

            <div class="mb-5">
                <div class="row g-2">
                    <div class="col-12 col-sm-12 col-lg-6">
                        <div class="card sh-11 hover-scale-up cursor-pointer">
                            <div class="h-100 row g-0 card-body align-items-center py-3">
                                <div class="col-auto pe-3">
                                    <div class="bg-gradient-light sh-5 sw-5 rounded-xl d-flex justify-content-center align-items-center">
                                        <i data-acorn-icon="navigate-diagonal" class="text-white"></i>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="row gx-2 d-flex align-content-center">
                                        <div class="col-12 col-xl d-flex">
                                            <div class="d-flex align-items-center lh-1-25">Total Kasus Selesai</div>
                                        </div>
                                        <div class="col-12 col-xl-auto">
                                            <div class="cta-2 text-primary">22</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-sm-6 col-lg-6">
                        <div class="card sh-11 hover-scale-up cursor-pointer">
                            <div class="h-100 row g-0 card-body align-items-center py-3">
                                <div class="col-auto pe-3">
                                    <div class="bg-gradient-light sh-5 sw-5 rounded-xl d-flex justify-content-center align-items-center">
                                        <i data-acorn-icon="check" class="text-white"></i>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="row gx-2 d-flex align-content-center">
                                        <div class="col-12 col-xl d-flex">
                                            <div class="d-flex align-items-center lh-1-25">Delivered Orders</div>
                                        </div>
                                        <div class="col-12 col-xl-auto">
                                            <div class="cta-2 text-primary">35</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-sm-6 col-lg-6">
                        <div class="card sh-11 hover-scale-up cursor-pointer">
                            <div class="h-100 row g-0 card-body align-items-center py-3">
                                <div class="col-auto pe-3">
                                    <div class="bg-gradient-light sh-5 sw-5 rounded-xl d-flex justify-content-center align-items-center">
                                        <i data-acorn-icon="alarm" class="text-white"></i>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="row gx-2 d-flex align-content-center">
                                        <div class="col-12 col-xl d-flex">
                                            <div class="d-flex align-items-center lh-1-25">Pending Orders</div>
                                        </div>
                                        <div class="col-12 col-xl-auto">
                                            <div class="cta-2 text-primary">14</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-sm-6 col-lg-6">
                        <div class="card sh-11 hover-scale-up cursor-pointer">
                            <div class="h-100 row g-0 card-body align-items-center py-3">
                                <div class="col-auto pe-3">
                                    <div class="bg-gradient-light sh-5 sw-5 rounded-xl d-flex justify-content-center align-items-center">
                                        <i data-acorn-icon="sync-horizontal" class="text-white"></i>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="row gx-2 d-flex align-content-center">
                                        <div class="col-12 col-xl d-flex">
                                            <div class="d-flex align-items-center lh-1-25">Unconfirmed Orders</div>
                                        </div>
                                        <div class="col-12 col-xl-auto">
                                            <div class="cta-2 text-primary">3</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Stats End -->

            <!-- Sales Start -->
            <h2 class="small-title">Sales</h2>
            <div class="card mb-5 sh-40">
                <div class="card-body">
                    <div class="custom-legend-container mb-3 pb-3 d-flex flex-row"></div>
                    <!-- Custom legend template used by js -->
                    <template class="custom-legend-item">
                        <a href="#" class="d-flex flex-row g-0 align-items-center me-5">
                            <div class="pe-2">
                                <div class="icon-container border sh-5 sw-5 rounded-xl d-flex justify-content-center align-items-center">
                                    <i class="icon"></i>
                                </div>
                            </div>
                            <div>
                                <div class="text p mb-0 d-flex align-items-center text-small text-muted">Title</div>
                                <div class="value cta-4">Value</div>
                            </div>
                        </a>
                    </template>
                    <!-- Custom Legend Template End -->
                    <div class="sh-25">
                        <canvas id="customLegendBarChart"></canvas>
                        <!-- Custom tooltip template used by js -->
                        <div class="custom-tooltip position-absolute bg-foreground rounded-md border border-separator pe-none p-3 d-flex z-index-1 align-items-center opacity-0 basic-transform-transition">
                            <div class="icon-container border d-flex align-middle align-items-center justify-content-center align-self-center rounded-xl sh-5 sw-5 rounded-xl me-3">
                                <span class="icon"></span>
                            </div>
                            <div>
                                <span class="text d-flex align-middle text-muted align-items-center text-small">Bread</span>
                                <span class="value d-flex align-middle align-items-center cta-4">300</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Sales End -->
        </div>

        <!-- Products Start -->
        <div class="col-12 col-lg-6 mb-5">
            <div class="d-flex justify-content-between">
                <h2 class="small-title">Stocks</h2>
                <button class="btn btn-icon btn-icon-end btn-xs btn-background-alternate p-0 text-small" type="button">
                    <span class="align-bottom">View More</span>
                    <i data-acorn-icon="chevron-right" class="align-middle" data-acorn-size="12"></i>
                </button>
            </div>
            <div class="scroll-out">
                <div class="scroll-by-count" data-count="8">
                    <div class="card mb-2 sh-10 sh-md-8">
                        <div class="card-body pt-0 pb-0 h-100">
                            <div class="row g-0 h-100 align-content-center">
                                <div class="col-12 col-md-5 d-flex align-items-center mb-2 mb-md-0">
                                    <a href="/Pages/Portfolio/Detail" class="body-link text-truncate">Barmbrack</a>
                                </div>
                                <div class="col-4 col-md-2 d-flex align-items-center text-muted text-medium mb-1 mb-md-0">
                                    <span class="badge bg-outline-tertiary me-1">STOCK</span>
                                </div>
                                <div class="col-4 col-md-3 d-flex align-items-center text-medium text-danger justify-content-center">
                                    <i data-acorn-icon="arrow-bottom" data-acorn-size="14" class="me-1"></i>
                                    <span class="text-medium">-18.4%</span>
                                </div>
                                <div class="col-4 col-md-2 d-flex align-items-center justify-content-end text-muted text-medium">
                                    <span>$ 3.25</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-2 sh-10 sh-md-8">
                        <div class="card-body pt-0 pb-0 h-100">
                            <div class="row g-0 h-100 align-content-center">
                                <div class="col-12 col-md-5 d-flex align-items-center mb-2 mb-md-0">
                                    <a href="/Pages/Portfolio/Detail" class="body-link text-truncate">Cheesymite Scroll</a>
                                </div>
                                <div class="col-4 col-md-2 d-flex align-items-center text-muted text-medium mb-1 mb-md-0">
                                    <span class="badge bg-outline-tertiary me-1">STOCK</span>
                                </div>
                                <div class="col-4 col-md-3 d-flex align-items-center text-medium text-danger justify-content-center">
                                    <i data-acorn-icon="arrow-bottom" data-acorn-size="14" class="me-1"></i>
                                    <span class="text-medium">-13.4%</span>
                                </div>
                                <div class="col-4 col-md-2 d-flex align-items-center justify-content-end text-muted text-medium">
                                    <span>$ 4.50</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-2 sh-10 sh-md-8">
                        <div class="card-body pt-0 pb-0 h-100">
                            <div class="row g-0 h-100 align-content-center">
                                <div class="col-12 col-md-5 d-flex align-items-center mb-2 mb-md-0">
                                    <a href="/Pages/Portfolio/Detail" class="body-link text-truncate">Cholermüs</a>
                                </div>
                                <div class="col-4 col-md-2 d-flex align-items-center text-muted text-medium mb-1 mb-md-0">
                                    <span class="badge bg-outline-primary me-1">SALE</span>
                                </div>
                                <div class="col-4 col-md-3 d-flex align-items-center text-medium text-success justify-content-center">
                                    <i data-acorn-icon="arrow-top" data-acorn-size="14" class="me-1"></i>
                                    <span class="text-medium">+9.7%</span>
                                </div>
                                <div class="col-4 col-md-2 d-flex align-items-center justify-content-end text-muted text-medium">
                                    <span>$ 1.75</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-2 sh-10 sh-md-8">
                        <div class="card-body pt-0 pb-0 h-100">
                            <div class="row g-0 h-100 align-content-center">
                                <div class="col-12 col-md-5 d-flex align-items-center mb-2 mb-md-0">
                                    <a href="/Pages/Portfolio/Detail" class="body-link text-truncate">Ruisreikäleipä</a>
                                </div>
                                <div class="col-4 col-md-2 d-flex align-items-center text-muted text-medium mb-1 mb-md-0">
                                    <span class="badge bg-outline-primary me-1">SALE</span>
                                </div>
                                <div class="col-4 col-md-3 d-flex align-items-center text-medium text-success justify-content-center">
                                    <i data-acorn-icon="arrow-top" data-acorn-size="14" class="me-1"></i>
                                    <span class="text-medium">+5.3%</span>
                                </div>
                                <div class="col-4 col-md-2 d-flex align-items-center justify-content-end text-muted text-medium">
                                    <span>$ 3.00</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-2 sh-10 sh-md-8">
                        <div class="card-body pt-0 pb-0 h-100">
                            <div class="row g-0 h-100 align-content-center">
                                <div class="col-12 col-md-5 d-flex align-items-center mb-2 mb-md-0">
                                    <a href="/Pages/Portfolio/Detail" class="body-link text-truncate">Bagel</a>
                                </div>
                                <div class="col-4 col-md-2 d-flex align-items-center text-muted text-medium mb-1 mb-md-0">
                                    <span class="badge bg-outline-tertiary me-1">STOCK</span>
                                </div>
                                <div class="col-4 col-md-3 d-flex align-items-center text-medium text-danger justify-content-center">
                                    <i data-acorn-icon="arrow-bottom" data-acorn-size="14" class="me-1"></i>
                                    <span class="text-medium">-2.3%</span>
                                </div>
                                <div class="col-4 col-md-2 d-flex align-items-center justify-content-end text-muted text-medium">
                                    <span>$ 4.25</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-2 sh-10 sh-md-8">
                        <div class="card-body pt-0 pb-0 h-100">
                            <div class="row g-0 h-100 align-content-center">
                                <div class="col-12 col-md-5 d-flex align-items-center mb-2 mb-md-0">
                                    <a href="/Pages/Portfolio/Detail" class="body-link text-truncate">Buccellato di Lucca</a>
                                </div>
                                <div class="col-4 col-md-2 d-flex align-items-center text-muted text-medium mb-1 mb-md-0">
                                    <span class="badge bg-outline-secondary me-1">TREND</span>
                                </div>
                                <div class="col-4 col-md-3 d-flex align-items-center text-medium text-danger justify-content-center">
                                    <i data-acorn-icon="arrow-bottom" data-acorn-size="14" class="me-1"></i>
                                    <span class="text-medium">-5.3%</span>
                                </div>
                                <div class="col-4 col-md-2 d-flex align-items-center justify-content-end text-muted text-medium">
                                    <span>$ 3.75</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-2 sh-10 sh-md-8">
                        <div class="card-body pt-0 pb-0 h-100">
                            <div class="row g-0 h-100 align-content-center">
                                <div class="col-12 col-md-5 d-flex align-items-center mb-2 mb-md-0">
                                    <a href="/Pages/Portfolio/Detail" class="body-link text-truncate">Chapati</a>
                                </div>
                                <div class="col-4 col-md-2 d-flex align-items-center text-muted text-medium mb-1 mb-md-0">
                                    <span class="badge bg-outline-primary me-1">SALE</span>
                                </div>
                                <div class="col-4 col-md-3 d-flex align-items-center text-medium text-success justify-content-center">
                                    <i data-acorn-icon="arrow-top" data-acorn-size="14" class="me-1"></i>
                                    <span class="text-medium">+7.1%</span>
                                </div>
                                <div class="col-4 col-md-2 d-flex align-items-center justify-content-end text-muted text-medium">
                                    <span>$ 1.85</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-2 sh-10 sh-md-8">
                        <div class="card-body pt-0 pb-0 h-100">
                            <div class="row g-0 h-100 align-content-center">
                                <div class="col-12 col-md-5 d-flex align-items-center mb-2 mb-md-0">
                                    <a href="/Pages/Portfolio/Detail" class="body-link text-truncate">Pullman Loaf</a>
                                </div>
                                <div class="col-4 col-md-2 d-flex align-items-center text-muted text-medium mb-1 mb-md-0">
                                    <span class="badge bg-outline-secondary me-1">TREND</span>
                                </div>
                                <div class="col-4 col-md-3 d-flex align-items-center text-medium text-success justify-content-center">
                                    <i data-acorn-icon="arrow-top" data-acorn-size="14" class="me-1"></i>
                                    <span class="text-medium">+2.3%</span>
                                </div>
                                <div class="col-4 col-md-2 d-flex align-items-center justify-content-end text-muted text-medium">
                                    <span>$ 2.25</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-2 sh-10 sh-md-8">
                        <div class="card-body pt-0 pb-0 h-100">
                            <div class="row g-0 h-100 align-content-center">
                                <div class="col-12 col-md-5 d-flex align-items-center mb-2 mb-md-0">
                                    <a href="/Pages/Portfolio/Detail" class="body-link text-truncate">Chapati</a>
                                </div>
                                <div class="col-4 col-md-2 d-flex align-items-center text-muted text-medium mb-1 mb-md-0">
                                    <span class="badge bg-outline-primary me-1">SALE</span>
                                </div>
                                <div class="col-4 col-md-3 d-flex align-items-center text-medium text-success justify-content-center">
                                    <i data-acorn-icon="arrow-top" data-acorn-size="14" class="me-1"></i>
                                    <span class="text-medium">+7.1%</span>
                                </div>
                                <div class="col-4 col-md-2 d-flex align-items-center justify-content-end text-muted text-medium">
                                    <span>$ 1.85</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-2 sh-10 sh-md-8">
                        <div class="card-body pt-0 pb-0 h-100">
                            <div class="row g-0 h-100 align-content-center">
                                <div class="col-12 col-md-5 d-flex align-items-center mb-2 mb-md-0">
                                    <a href="/Pages/Portfolio/Detail" class="body-link text-truncate">Fougasse</a>
                                </div>
                                <div class="col-4 col-md-2 d-flex align-items-center text-muted text-medium mb-1 mb-md-0">
                                    <span class="badge bg-outline-primary me-1">SALE</span>
                                </div>
                                <div class="col-4 col-md-3 d-flex align-items-center text-medium text-success justify-content-center">
                                    <i data-acorn-icon="arrow-top" data-acorn-size="14" class="me-1"></i>
                                    <span class="text-medium">+2.3%</span>
                                </div>
                                <div class="col-4 col-md-2 d-flex align-items-center justify-content-end text-muted text-medium">
                                    <span>$ 2.25</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-2 sh-10 sh-md-8">
                        <div class="card-body pt-0 pb-0 h-100">
                            <div class="row g-0 h-100 align-content-center">
                                <div class="col-12 col-md-5 d-flex align-items-center mb-2 mb-md-0">
                                    <a href="/Pages/Portfolio/Detail" class="body-link text-truncate">Biscotti</a>
                                </div>
                                <div class="col-4 col-md-2 d-flex align-items-center text-muted text-medium mb-1 mb-md-0">
                                    <span class="badge bg-outline-secondary me-1">TREND</span>
                                </div>
                                <div class="col-4 col-md-3 d-flex align-items-center text-medium text-success justify-content-center">
                                    <i data-acorn-icon="arrow-top" data-acorn-size="14" class="me-1"></i>
                                    <span class="text-medium">+2.3%</span>
                                </div>
                                <div class="col-4 col-md-2 d-flex align-items-center justify-content-end text-muted text-medium">
                                    <span>$ 2.25</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Products End -->
    </div>
</div>
@endsection