@php
    $html_tag_data = [];
    $title = 'Kategori';
    $description = '';
    $breadcrumbs = [route('category.index') =>$title, route('category.create') =>"Tambah baru"]
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
                                    <form action="{{ route('category.store') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="mb-3">
                                            <label class="form-label">Nama Kategori</label>
                                            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" placeholder="Nama" required/>
                                        </div>
                                        {{-- button Cancel --}}
                                        <button type="button" onclick="Alert.swallCancel('{{route('category.index')}}')" class="btn btn-danger">Batal</button>
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
