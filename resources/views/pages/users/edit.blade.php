@php
    $html_tag_data = [];
    $title = 'Edit Pengguna';
    $description = '';
    $breadcrumbs = [route('user.index') =>$title, route('user.edit', ['id' => $data->id]) =>"Edit"]
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
                                    <form action="{{ route('user.update', ['id' => $data->id ]) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="row">
                                            <div class="col-md-2 mb-6">
                                                <label class="form-label">Nama</label>
                                                <input type="text" name="name" id="name" class="form-control" value="{{ old('name') ? old('name') : $data->name }}" placeholder="Nama Lengkap" required/>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-5 mb-5">
                                                <label class="form-label">Email</label>
                                                <input type="email" name="email" id="email" class="form-control" value="{{ old('email') ? old('email') : $data->email }}"placeholder="Email" required/>
                                            </div>
                                            <div class="col mb-5">
                                                <label for="Kategori" class="form-label">Role</label>
                                                <select class="form-select" name="role" id="role" aria-describedby="PangkatFeedback" required>
                                                    <option selected disabled value="">Pilih...</option>
                                                    <option value="admin" @if ($data->role == 'admin') selected @endif>Admin</option>
                                                    <option value="pengguna" @if ($data->role == 'pengguna') selected @endif>Pengguna</option>
                                                    <option value="gudang" @if ($data->role == 'gudang') selected @endif>Staff Gudang</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-2 mb-5">
                                                <label class="form-label">Password</label>
                                                <input type="password" name="password" id="password" class="form-control input-float" value="{{ old('password') }}" placeholder="*********"/>
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