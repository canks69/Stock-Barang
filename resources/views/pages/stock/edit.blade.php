@php
    $html_tag_data = [];
    $title = 'Edit Stok';
    $description = '';
    $breadcrumbs = [route('category.index') =>$title, route('category.edit', ['id' => $data->id]) =>"Edit"]
@endphp
@extends('layouts.app',['html_tag_data'=>$html_tag_data, 'title'=>$title, 'description'=>$description])

@section('css')
@endsection

@section('js_vendor')
@endsection

@section('js_page')
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
                                    <form action="{{ route('stock.update', ['id' => $data->id ]) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="row">
                                            <div class="col-md-2 mb-5">
                                                <label class="form-label">Kode Stok</label>
                                                <input type="text" name="code" id="code" class="form-control" value="{{ old('code') ?  old('code') : $data->code  }}" placeholder="Code" required/>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-8 mb-5">
                                                <label class="form-label">Nama Stok</label>
                                                <input type="text" name="name" id="name" class="form-control" value="{{ old('name') ?  old('name') : $data->name }}" placeholder="Nama" required/>
                                            </div>
                                            <div class="col mb-5">
                                                <label for="Kategori" class="form-label">Kategori</label>
                                                <select class="form-select" name="category" id="category" aria-describedby="PangkatFeedback" required>
                                                    <option selected disabled value="">Pilih...</option>
                                                    @foreach ($category as $item)
                                                        <option value="{{ $item->id }}" 
                                                            @if (old('category') == $item->id || $data->category_id == $item->id)
                                                                selected
                                                            @endif
                                                            >{{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-2 mb-5">
                                                <label class="form-label">Harga Beli</label>
                                                <div class="input-group">
                                                    <span class="input-group-text">Rp.</span>
                                                    <input type="text" name="cogs" id="cogs" class="form-control input-float" value="{{ old('cogs') ?  old('cogs') : $data->cogs  }}" placeholder="00" required/>
                                                </div>
                                            </div>
                                            <div class="col"></div>
                                            <div class="col-md-2 mb-5">
                                                <label class="form-label">Harga Jual</label>
                                                <div class="input-group">
                                                    <span class="input-group-text">Rp.</span>
                                                    <input type="text" name="price" id="price" class="form-control input-float" value="{{ old('price') ?  old('price') : $data->price }}" placeholder="00" required/>
                                                </div>
                                            </div>
                                            <div class="col"></div>
                                            <div class="col-md-2 mb-5">
                                                <label class="form-label">Stok Awal</label>
                                                <input type="text" name="initial" id="initial" class="form-control input-float" value="{{ old('initial') ?  old('initial') : $data->initial }}" placeholder="00" required/>
                                            </div>

                                        </div>

                                        {{-- button Cancel --}}
                                        <button type="button" onclick="Alert.swallCancel('{{route('stock.index')}}')" class="btn btn-danger">Batal</button>
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