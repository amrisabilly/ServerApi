<!DOCTYPE html>
<html lang="en">

<head>
    @include('landing.partials.header')

    @yield('style')
</head>

<body class="overflow-x-hidden">
    {{-- @include('landing.partials.navbar') --}}

    <div class="min-h-screen font-sora flex justify-center items-center">
        @yield('content')
    </div>

    @yield('script')
</body>

</html>
