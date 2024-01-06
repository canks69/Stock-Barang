@php
    $html_tag_data = [];
    $title = 'Pelanggan';
    $description = '';
    $breadcrumbs = [route('customer.index') =>$title, route('customer.edit', ['id' => $data->id]) =>"Edit"]
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
                                    <form action="{{ route('customer.update', ['id' => $data->id]) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="row">
                                            <div class="col-md-2 mb-5">
                                                <label class="form-label">Code</label>
                                                <input type="text" name="code" id="code" class="form-control" value="{{ old('code') ? old('code') : $data->code  }}" placeholder="CS0001" required/>
                                            </div>
                                            <div class="col-md-4 mb-5">
                                                <label class="form-label">Nama</label>
                                                <input type="text" name="name" id="name" class="form-control" value="{{ old('name') ? old('name') : $data->name }}" placeholder="Nama" required/>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="row">
                                                    <div class="col-md-12 mb-5">
                                                        <label class="form-label">Email</label>
                                                        <input type="email" name="email" id="email" class="form-control" value="{{ old('email') ? old('email') : $data->email }}" placeholder="Email" required/>
                                                    </div>
                                                    <div class="col-md-12 mb-5">
                                                        <label class="form-label">Alamat</label>
                                                        <textarea name="address" id="address" class="form-control" placeholder="Alamat" required>{{ old('address') ? old('address') : $data->address }}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="row">
                                                    <div class="col-md-12 mb-5">
                                                        <label class="form-label">Telp</label>
                                                        <input type="text" name="phone" id="phone" class="form-control" value="{{ old('phone') ? old('phone') : $data->phone }}" placeholder="Telp" required/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- button Cancel --}}
                                        <button type="button" onclick="Alert.swallCancel('{{route('customer.index')}}')" class="btn btn-danger">Cancel</button>
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
