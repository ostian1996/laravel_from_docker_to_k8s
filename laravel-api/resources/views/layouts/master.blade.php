<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>@yield('title')</title>
    <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="stylesheet" href="{{ asset('vendors/mdi/css/materialdesignicons.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/css/vendor.bundle.base.css') }}">
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
   <link rel="stylesheet" href="{!! asset('css/dataTables.bootstrap5.min.css') !!}">
  
  @stack('css')
  <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}" />
</head>
<body>
  <div class="container-scroller d-flex">
    <!-- partial:./partials/_sidebar.html -->
    @include('layouts.sidebar')
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:./partials/_navbar.html -->
        @include('layouts.navbar')
      <!-- partial -->
        @yield('content')
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

  <script src="{{ asset('vendors/js/vendor.bundle.base.js') }}"></script>
  <script src="{{ asset('vendors/chart.js/Chart.min.js') }}"></script>
  <script src="{{ asset('js/jquery.cookie.js') }}" type="text/javascript"></script>
  <script src="{{ asset('js/off-canvas.js') }}"></script>
  <script src="{{ asset('js/hoverable-collapse.js') }}"></script>
  <script src="{{ asset('js/template.js') }}"></script>
  <script src="{{ asset('js/jquery.cookie.js') }}" type="text/javascript"></script>
  <script src="{{ asset('js/dashboard.js') }}"></script>
  
  <!-- Include jQuery & DataTables JS Scripts -->
  <script src="{!! asset('js/jquery.min.js') !!}"></script>
  <script src="{!! asset('js/jquery.dataTables.min.js') !!}"></script>

    <!-- Select2 -->
  <script src="{!! asset('js/select2.full.min.js') !!}"></script>
  <script src="{!! asset('js/select2.min.js') !!}"></script>
  <script src="{!! asset('js/i18n/fr.js') !!}"></script>
  <script src="{{ asset('js/script.js') }}"></script>
  @include('components.function')
  @stack('js')
</body>

</html>