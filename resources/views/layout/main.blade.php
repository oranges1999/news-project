<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    @yield('style')
    @include('layout.css')
</head>
    <section>
    <!-- navbar -->
    @include('layout.nav')
    </section>

    <section>
    <!-- content -->
    @yield('content')
    </section>
    
    <section>
    <!-- script -->
    @include('layout.js')
    @yield('script')
    </section>
</body>
</html>