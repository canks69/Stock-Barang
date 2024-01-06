@php
    $title = 'Forgot Password Page';
    $description = 'Forgot Password Page'
@endphp
@extends('layouts.app_full',['title'=>$title, 'description'=>$description])
@section('css')
@endsection

@section('js_vendor')
    <script src="/js/vendor/jquery.validate/jquery.validate.min.js"></script>
    <script src="/js/vendor/jquery.validate/additional-methods.min.js"></script>
@endsection

@section('js_page')
    <script src="/js/pages/auth.forgotpassword.js"></script>
@endsection

@section('content_left')
    <div class="min-h-100 d-flex align-items-center">
        <div class="w-100 w-lg-75 w-xxl-50">
            <div>
                <div class="mb-5">
                    <h1 class="display-3 text-white">{{ config('app.name', 'Laravel') }}</h1>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content_right')
    <div class="sw-lg-70 min-h-100 bg-foreground d-flex justify-content-center align-items-center shadow-deep py-5 full-page-content-right-border">
        <div class="sw-lg-50 px-5">
            <div class="mb-5">
                <h2 class="cta-1 mb-0 text-primary">Password is gone?</h2>
                <h2 class="cta-1 text-primary">Let's reset it!</h2>
            </div>
            <div class="mb-5">
                <p class="h6">
                    If you are a member, please
                    <a href="{{ route('login') }}">login</a>
                    .
                </p>
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
            </div>
            <div>
                <form id="forgotPasswordForm" class="tooltip-end-bottom" method="POST" action="{{ route('password.email') }}" novalidate>
                    @csrf
                    <div class="mb-3 filled form-group tooltip-end-top">
                        <i data-acorn-icon="email"></i>
                        <input id="email" class="form-control  @error('email') is-invalid @enderror" placeholder="Email" name="email" value="{{ old('email') }}" autofocus/>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-lg btn-primary">Send Reset Email</button>
                </form>
            </div>
        </div>
    </div>
@endsection