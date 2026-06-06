<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>@yield('title')</title>
    @vite(['/resources/vendors/mdi/css/materialdesignicons.min.css', '/resources/vendors/css/vendor.bundle.base.css', '/resources/css/style.css'])
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

     @vite(['/resources/vendors/js/vendor.bundle.base.js', '/resources/vendors/chart.js/Chart.min.js', '/resources/js/jquery.cookie.js', 
        '/resources/js/off-canvas.js', '/resources/js/hoverable-collapse.js', '/resources/js/template.js', '/resources/js/jquery.cookie.js', '/resources/js/dashboard.js'])
    @stack('js')
</body>

</html>