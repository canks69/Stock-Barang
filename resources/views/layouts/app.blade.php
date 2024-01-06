<!DOCTYPE html>
<html lang="en" data-url-prefix="/" data-footer="true"
@isset($html_tag_data)
    @foreach ($html_tag_data as $key=> $value) data-{{$key}}='{{$value}}' @endforeach
@endisset
>

<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
    <title>{{ config('app.name', 'Laravel') }} | {{$title}}</title>
    <meta name="description" content="{{$description}}"/>
    @include('components.head')
</head>

<body>
<div id="root" >
    <div id="nav" class="nav-container d-flex" @isset($custom_nav_data) @foreach ($custom_nav_data as $key=> $value)
    data-{{$key}}="{{$value}}"
        @endforeach
        @endisset
    >
        @include('components.nav')
    </div>
    <main>
        @yield('content')
    </main>
    @include('components.footer')
</div>
@include('components.modal_settings')
@include('components.modal_search')
@include('components.scripts')
</body>

</html>
