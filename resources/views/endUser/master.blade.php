@include('endUser.layouts.head')

<!--header-->
<header id="header" class="header header-style-1">
    <div class="container-fluid">
        <div class="row">
            @include('endUser.layouts.top-nav')
            @include('endUser.layouts.primary-nav-section')
        </div>
    </div>
</header>

<!--main area-->
<main id="main" class="main-site left-sidebar">

    <div class="container">
        @include('endUser.layouts.head-pages')
        @yield('content')
        <!--end row-->
    </div>
    <!--end container-->

</main>
<!--main area-->

<!--footer area-->
@include('endUser.layouts.footer')
