<!DOCTYPE html>
<html lang="ar">
    <!-- Head -->
@include('includes.frontend.head')
    <!-- /Head -->
@yield('css')
        <!-- Header -->
        @include('includes.frontend.header')
        <!-- /Header -->
<body>
    <!-- /Content -->
    @yield('content')
    <!-- /Content -->

    <!-- Footer -->
    @include('includes.frontend.footer')
    <!-- /Footer -->
    <!-- Javascript -->
@yield('js')
    <!-- /Javascript -->
</body>

</html>
