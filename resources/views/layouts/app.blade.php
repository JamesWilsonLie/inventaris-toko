<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title', 'Dashboard | Sistem Inventaris')</title>
  <link rel="shortcut icon" type="image/png" href="{{ asset('backend/assets/images/logos/favicon.png') }}" />
  <link rel="stylesheet" href="{{ asset('backend/assets/css/styles.min.css') }}" />
</head>

<body>
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6"
       data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">

    <!-- Sidebar -->
    @include('components.sidebar')

    <!-- Main Content -->
    <div class="body-wrapper">
      <!-- Header -->
      @include('components.header')

      <!-- Page Content -->
      <div class="container-fluid">
        @yield('content')
      </div>

      <!-- Footer -->
      @include('components.footer')
    </div>
  </div>

  <script src="{{ asset('backend/assets/libs/jquery/dist/jquery.min.js') }}"></script>
  <script src="{{ asset('backend/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('backend/assets/js/sidebarmenu.js') }}"></script>
  <script src="{{ asset('backend/assets/js/app.min.js') }}"></script>
  <script src="{{ asset('backend/assets/libs/apexcharts/dist/apexcharts.min.js') }}"></script>
  <script src="{{ asset('backend/assets/libs/simplebar/dist/simplebar.js') }}"></script>
  <script src="{{ asset('backend/assets/js/dashboard.js') }}"></script>
</body>
</html>
