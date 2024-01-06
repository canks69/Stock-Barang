@php
    $html_tag_data = [];
    $title = 'Edit Penjualan';
    $description = '';
    $breadcrumbs = [route('sales.index') =>$title, route('sales.create') =>"Tambah baru"]
@endphp
@extends('layouts.app',['html_tag_data'=>$html_tag_data, 'title'=>$title, 'description'=>$description])

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
@endsection

@section('js_vendor')

@endsection

@section('js_page')
    <script src="/js/forms/transaction.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        localStorage.setItem('stocks', JSON.stringify(@json($stocks)));
    })
</script>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <!-- Title and Top Buttons Start -->
                <div class="page-title-container">
                    <div class="row">
                        <!-- Title Start -->
                        <div class="col-12 col-md-7">
                            <h1 class="mb-0 pb-0 display-4" id="title">{{ $title }}</h1>
                            @include('components.breadcrumb',['breadcrumbs'=>$breadcrumbs])
                        </div>
                        <!-- Title End -->

                        <section class="scroll-section" id="basic">
                            <div class="card mb-5">
                                <div class="card-body">
                                    <form action="{{ route('sales.update', $sales->id) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="row mb-5">
                                            <div class="col-md-2">
                                                <label class="form-label">Nama</label>
                                                <input type="text" name="transno" id="transno" class="form-control" value="{{  $sales->transno }}" placeholder="Nama" readonly/>
                                            </div>
                                        </div>
                                        <div class="row mb-5">
                                            <div class="col-md-2">
                                                <label class="form-label">Kode Pelanggan</label>
                                                <select name="customer_id" id="customer_id" class="form-select" required>
                                                    <option selected disabled value="">Pilih Pelanggan</option>
                                                    @foreach ($customers as $customer)
                                                        <option value="{{ $customer->id }}"
                                                            @if ($sales->customer_id == $customer->id)
                                                                selected
                                                            @endif 
                                                            >{{ $customer->code }} - {{ $customer->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col align-self-end">
                                                {{-- <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#addNewTransaction">
                                                    Tambah
                                                </button> --}}

                                                <button type="button" class="btn btn-outline-primary" id="addRow">
                                                    Tambah
                                            </div>
                                        </div>
                                        <div class="row mb-2" id="transaction">
                                            <table id="tableTransaction" class="table">
                                                <thead>
                                                    <tr>
                                                        <th width="200px">Barang</th>
                                                        <th width="100px">Jumlah</th>
                                                        <th width="200px">Harga</th>
                                                        <th width="200px">Total</th>
                                                        <th width="50px">Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($salesdetail as $detail)
                                                        <tr>
                                                            <td>
                                                                <select name="code[]" class="form-control select-code">
                                                                    <option selected disabled value="">Pilih barang</option>
                                                                    @foreach ($stocks as $stock)
                                                                        <option value="{{ $stock->id }}"
                                                                            @if ($detail->stock_id == $stock->id)
                                                                                selected
                                                                            @endif
                                                                            >{{ $stock->code }} - {{ $stock->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </td>
                                                            <td>
                                                                <input type="text" name="qty[]" class="form-control input-float" value="{{ $detail->qty }}" placeholder="00"/>
                                                            </td>
                                                            <td>
                                                                <input type="text" name="price[]" class="form-control input-float" value="{{ $detail->price }}" placeholder="00"/>
                                                            </td>
                                                            <td>
                                                                <input type="text" name="rate[]" class="form-control input-float" value="{{ $detail->total   }}" placeholder="00" readonly/>
                                                            </td>
                                                            <td>
                                                                <button type="button" class="btn btn-sm btn-icon btn-icon-only btn-danger mb-1" id="deleteRow"><i class="fas fa-trash"></i></button>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <td colspan="3" class="text-end">Total</td>
                                                        <td>
                                                            <input type="text" name="total" id="netTotal" value="{{ $sales->total }}" class="form-control input-float" placeholder="00" readonly/>
                                                        </td>
                                                        <td></td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                        <div class="row mb-5">
                                            
                                        </div>
                                        {{-- button Cancel --}}
                                        <button type="button" onclick="Alert.swallCancel('{{route('sales.index')}}')" class="btn btn-danger">Batal</button>
                                        {{-- button Simpan --}}
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </form>
                                </div>
                            </div>
                        </section>

                    </div>
                </div>
                <!-- Title and Top Buttons End -->

                <!-- Content Start -->
                
        </div>
    </div>
@endsection
