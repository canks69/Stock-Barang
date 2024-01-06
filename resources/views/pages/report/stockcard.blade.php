@php
    $html_tag_data = [];
    $title = 'Laporan Stok';
    $description = '';
@endphp

@extends('layouts.app',['html_tag_data'=>$html_tag_data, 'title'=>$title, 'description'=>$description])

@section('css')
    <link rel="stylesheet" href="/css/vendor/bootstrap-datepicker3.standalone.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
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
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <form class="card data-table-rows slim p-3" method="POST" action="{{ route('report.stock.show') }}">
                    @csrf
                    <div class="row mb-2">
                        <div class="col-lg-4 col-md-4">
                            <label class="form-label">Pilih Tanggal</label>
                            <div class="input-daterange input-group" id="datePickerRange">
                                <input type="text" class="form-control" name="start" placeholder="Start" required />
                                <span class="mx-2"></span>
                                <input type="text" class="form-control" name="end" placeholder="End" required />
                            </div>
                        </div>
                    </div>
                    <div class="row mb-5">
                        <div class="col-lg-2 col-md-4">
                            <label class="form-label">Stock</label>
                            <select name="stock_id" id="stock_id" class="form-select" required>
                                <option value="all" @if (old('stock_id') == 'all') selected @endif >Semua Stock</option>
                                @foreach ($stocks as $stock)
                                    <option value="{{ $stock->id }}"
                                        @if (old('stock_id') == $stock->id)
                                            selected
                                        @endif 
                                        >{{ $stock->code }} - {{ $stock->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col align-self-end">
                            <button type="submit" class="btn btn-primary" id="btn-filter">Filter</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection