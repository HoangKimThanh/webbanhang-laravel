@include('admin.partials.header')

<div id="layoutSidenav">
    @include('admin.partials.sidebar')

    <div id="layoutSidenav_content">
        @yield('content')
    </div>
</div>

@include('admin.partials.footer')