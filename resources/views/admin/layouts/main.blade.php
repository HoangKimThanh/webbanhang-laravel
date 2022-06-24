@include('admin.partials.header')

<div id="layoutSidenav">
    @include('admin.partials.sidebar')

    <div id="layoutSidenav_content">
        @yield('content')
    </div>
</div>

@yield('scripts')

@include('admin.partials.footer')