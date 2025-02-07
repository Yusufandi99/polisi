<!DOCTYPE html>
<html lang="id">
@include('admin.layout.head')

<body>
    @include('admin.layout.header')
    @include('admin.layout.sidebar')
    @yield('isi')
    @include('admin.layout.footer')
    @include('sweetalert::alert')
</body>

</html>