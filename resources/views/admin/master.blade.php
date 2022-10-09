@include('admin.layouts.head')




@include('admin.layouts.nav')





<!--  BEGIN MAIN CONTAINER  -->
<div class="main-container" id="container">

    <div class="overlay"></div>
    <div class="search-overlay"></div>




    @include('admin.layouts.sideNav')





    <!--  BEGIN CONTENT AREA  -->
    <div id="content" class="main-content">
        <div class="layout-px-spacing">

            <div class="row layout-top-spacing">


                @yield('content')


                @include('admin.layouts.footer')
