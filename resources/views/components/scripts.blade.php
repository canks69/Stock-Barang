<!-- Vendor Scripts Start -->
<script src="/js/vendor/jquery-3.5.1.min.js"></script>
<script src="/js/vendor/bootstrap.bundle.min.js"></script>
<script src="/js/vendor/OverlayScrollbars.min.js"></script>
<script src="/js/vendor/autoComplete.min.js"></script>
<script src="/js/vendor/clamp.min.js"></script>
<script src="/icon/acorn-icons.js"></script>
<script src="/icon/acorn-icons-interface.js"></script>
<script src="/js/main.js"></script>
@yield('js_vendor')
<!-- Vendor Scripts End -->
<!-- Template Base Scripts Start -->
<script src="/js/base/helpers.js"></script>
<script src="/js/base/globals.js"></script>
<script src="/js/base/nav.js"></script>
<script src="/js/base/search.js"></script>
<script src="/js/base/settings.js"></script>
<!-- Template Base Scripts End -->
<!-- Page Specific Scripts Start -->
@yield('js_page')
<script src="/js/common.js"></script>
<script src="/js/scripts.js"></script>
<!-- Page Specific Scripts End -->

{{-- sweetalert --}}
<script src="/js/sweetalert/sweetalert2.all.min.js"></script>
<script src="/js/sweetalert/sweetalert.js"></script>

<script>
    const Alert = new SweetAlert();
</script>

@if(session('success'))
    <script>
        Alert.Success('{{ session('success') }}');
    </script>
@endif

@if(session('error'))
    <script>
        Alert.Error('{{ session('error') }}');
    </script>
@endif