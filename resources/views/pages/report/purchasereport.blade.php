@php
    $html_tag_data = [];
    $title = 'Laporan Pembelian';
    $description = '';
@endphp

@extends('layouts.app',['html_tag_data'=>$html_tag_data, 'title'=>$title, 'description'=>$description])

@section('css')
    <link rel="stylesheet" href="/css/vendor/bootstrap-datepicker3.standalone.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        #title-head{
            display: none;
        }
        @media print {
            #filterReport {
                display: none;
            }
            #title-head{
                display: block;
            }
        }
    </style>
@endsection

@section('js_vendor')
    <script src="/js/cs/scrollspy.js"></script>
    <script src="/js/vendor/datepicker/bootstrap-datepicker.min.js"></script>
    <script src="/js/vendor/datepicker/locales/bootstrap-datepicker.es.min.js"></script>
    <script src="/js/vendor/bootstrap-submenu.js"></script>
    <script src="/js/vendor/datatables.min.js"></script>
    <script src="/js/vendor/mousetrap.min.js"></script>
@endsection

@section('js_page')
    <script src="/js/forms/controls.datepicker.js"></script>
    <script src="/js/cs/datatable.extend.js"></script>
    <script src="/js/datatable/datatable.js"></script>

    <script>
        Mousetrap.bind('ctrl+p', function(e) {
            e.preventDefault();
            window.print();
        });
    </script>   
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card data-table-rows slim p-3">
                    <p id="title-head" class="mb-5 h3 text-center">Data Laporan Pembelian @if (session('start')){{ session('start') }} - @endif @if (session('end')){{ session('end') }}@endif</p>
                    <form id="filterReport" method="POST" action="{{ route('report.purchase.show') }}">
                        @csrf
                        <div class="row mb-2">
                            <div class="col-lg-4 col-md-4">
                                <label class="form-label">Pilih Tanggal</label>
                                <div class="input-daterange input-group" id="datePickerRange">
                                    <input type="text" class="form-control" name="start" placeholder="Start" value="@if (session('start')){{ session('start') }}@endif" required />
                                    <span class="mx-2"></span>
                                    <input type="text" class="form-control" name="end" placeholder="End" value="@if (session('end')){{ session('end') }}@endif"  required />
                                </div>
                            </div>
                            <div class="col align-self-end">
                                <button type="submit" class="btn btn-primary" id="btn-filter">Filter</button>
                                @if($purchase)
                                    <button type="button" class="btn btn-success" id="btn-print" onclick="window.print()">Print</button>
                                @endif
                            </div>
                        </div>
                    </form>
                    @if ($purchase)
                        <div class="row mt-5">
                            <div class="col">
                                <div class="table-responsive">
                                    <table class="table table-hover" id="table">
                                        <thead>
                                            <tr>
                                                <th class="text-center">No Transaksi</th>
                                                <th class="text-center">Tanggal</th>
                                                <th class="text-center">Nama</th>
                                                <th class="text-center">Alamat</th>
                                                <th class="text-center">Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($purchase as $value)
                                                <tr style="--bs-table-accent-bg: rgba(var(--body-rgb), 0.05);">
                                                    <td>{{ $value->transno }}</td>
                                                    <td>{{ $value->date }}</td>
                                                    <td>{{ $value->name }}</td>
                                                    <td>{{ $value->address }}</td>
                                                    <td class="text-bold" >{{ $value->total }}</td>
                                                </tr>
                                                <tr>
                                                    <th colspan="2">Nama Barang</th>
                                                    <th>Jumlah</th>
                                                    <th>Harga</th>
                                                    <th>Total</th>
                                                </tr>
                                                @foreach ($value->purchasedetail as $detail)
                                                    <tr>
                                                        <td colspan="2" style="padding-left: 50px;" >{{ $detail->stock->name }}</td>
                                                        <td>{{ $detail->qty }}</td>
                                                        <td>{{ $detail->price }}</td>
                                                        <td>{{ $detail->total }}</td>
                                                    </tr>
                                                @endforeach
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection