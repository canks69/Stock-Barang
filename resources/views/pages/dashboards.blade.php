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
                {{-- <div class="dropdown-as-select me-3" data-setActive="false" data-childSelector="span">
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
                </div> --}}
                <h2 class="small-title">Transaksi</h2>
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
                                            <div class="d-flex align-items-center lh-1-25">Total Penjualan</div>
                                        </div>
                                        <div class="col-12 col-xl-auto">
                                            <div class="cta-2 text-primary">{{ $sales }}</div>
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
                                            <div class="d-flex align-items-center lh-1-25">Total Pembelian</div>
                                        </div>
                                        <div class="col-12 col-xl-auto">
                                            <div class="cta-2 text-primary">{{ $purchase }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Stats End -->
        </div>

        <!-- Products Start -->
        <div class="col-12 col-lg-6 mb-5">
            <div class="d-flex justify-content-between">
                <h2 class="small-title">Stocks</h2>
                @if (Auth::user()->role != 'pengguna')
                <a href="{{ route('stock.index') }}" class="btn btn-icon btn-icon-end btn-xs btn-background-alternate p-0 text-small" type="button">
                    <span class="align-bottom">Lihat Stock</span>
                    <i data-acorn-icon="chevron-right" class="align-middle" data-acorn-size="12"></i>
                </a>
                @endif
            </div>
            <div class="scroll-out">
                <div class="scroll-by-count" data-count="8">
                    @foreach ($stock as $item)
                    <div class="card mb-2 sh-10 sh-md-8">
                        <div class="card-body pt-0 pb-0 h-100">
                            <div class="row g-0 h-100 align-content-center">
                                <div class="col-12 col-md-5 d-flex align-items-center mb-2 mb-md-0">
                                    <label class="body-link text-truncate">{{ $item->name }}</label>
                                </div>
                                <div class="col-4 col-md-2 d-flex align-items-center text-bold mb-1 mb-md-0">
                                    <span class="badge bg-outline-primary me-1">{{ $item->category->name }}</span>
                                </div>
                                <div class="col-4 col-md-3 d-flex align-items-center text-medium justify-content-center">
                                   
                                </div>
                                <div class="col-4 col-md-2 d-flex align-items-center justify-content-end text-bold">
                                    @if($item->stock < 100)
                                        <span class="text-medium text-danger">{{ $item->stock }}</span>
                                    @else
                                        <span class="text-medium text-success">{{ $item->stock }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <!-- Products End -->
    </div>
</div>
@endsection