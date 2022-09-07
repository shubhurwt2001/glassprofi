
@include('backend.include.headerfiles')

@include('backend.include.navbar')
@include('backend.include.sidebar')
@include('backend.include.breadcrumb')

@section('container')
@show


@include('backend.include.footer')

@include('backend.include.footerfiles')

@yield('scripts')