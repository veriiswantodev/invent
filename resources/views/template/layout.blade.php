<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>

    {{-- favicon --}}
    {{-- <link rel="icon" href="{{url($setting->favicon)}}" type="image/x-icon"> --}}

    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{ asset('assets/modules/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.5.0/css/all.min.css"
        integrity="sha512-QfDd74mlg8afgSqm3Vq2Q65e9b3xMhJB4GZ9OcHDVy1hZ6pqBJPWWnMsKDXM7NINoKqJANNGBuVRIpIJ5dogfA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('assets/modules/datatable/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/modules/datatable/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/modules/datatable/select.bootstrap4.min.css') }}">
    {{-- iziToast --}}
    <link rel="stylesheet" href="{{ asset('assets/modules/izitoast/iziToast.min.css') }}">
    {{-- select2 --}}
    <link rel="stylesheet" href="{{ asset('assets/modules/select2/select2.min.css') }}">
    


    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/components.css') }}">
    @stack('css')

</head>

<body>
    <div id="app">
        <div class="main-wrapper main-wrapper-1">
            @include('template.navbar')
            @include('template.sidebar')

            <!-- Main Content -->
            @yield('content')
            {{-- <div class="main-content"> --}}
            {{-- <section class="section"> --}}
            {{-- <div class="section-header">
                        <h1>Blank Page</h1>
                    </div>

                    <div class="section-body">
                    </div> --}}
            {{-- </section> --}}
            {{-- </div> --}}
            @include('template.footer')
        </div>
    </div>

    <!-- General JS Scripts -->
    <script src="{{ asset('assets/modules/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/modules/popper.js') }}"></script>
    <script src="{{ asset('assets/modules/tooltip.js') }}"></script>
    <script src="{{ asset('assets/modules/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/modules/jquery.nicescroll.min.js') }}"></script>
    <script src="{{ asset('assets/modules/moment.min.js') }}"></script>
    <script src="{{ asset('assets/modules/stisla.js') }}"></script>

    <!-- JS Libraies -->
    <script src="{{ asset('assets/modules/datatable/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/modules/datatable/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/modules/datatable/dataTables.select.min.js') }}"></script>
    {{-- swweet alert --}}
    <script src="{{ asset('assets/modules/sweetalert/sweetalert.min.js') }}"></script>
    {{-- iziToast --}}
    <script src="{{ asset('assets/modules/iziToast/iziToast.min.js') }}"></script>
    {{-- select2 --}}
    <script src="{{ asset('assets/modules/select2/select2.full.min.js') }}"></script>
    {{-- html5 QrCode --}}

    <!-- Page Specific JS File -->

    <!-- Template JS File -->
    <script src="{{ asset('assets/modules/scripts.js') }}"></script>
    <script src="{{ asset('assets/modules/custom.js') }}"></script>
    @stack('script')

</body>

</html>
