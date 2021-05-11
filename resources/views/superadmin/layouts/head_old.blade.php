<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<!-- Site Title  -->
<title>
  @section('title')
      {{{$title}}}
  @show
</title>
<!-- Vendor Bundle CSS -->

{{-- <link href="/assets/theme/ethplus/vendor/owl-carousel/owl.carousel.css" rel="stylesheet">
<link href="/assets/theme/ethplus/vendor/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">
<link href="/assets/theme/ethplus/css/style.css" rel="stylesheet"> --}}
<link href="https://cdn.lineicons.com/2.0/LineIcons.css" rel="stylesheet">
<link rel="shortcut icon" href="/assets/img/favicon.png">

<!-- New theme -->
<link rel="icon" href="/assets/theme2/images/favicon-32x32.png" type="image/png" />
<!-- Vector CSS -->
<link href="/assets/theme2/plugins/vectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet" />
<!--plugins-->
<link href="/assets/theme2/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
<link href="/assets/theme2/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
<link href="/assets/theme2/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
<!-- loader-->
<link href="/assets/theme2/css/pace.min.css" rel="stylesheet" />
<script src="/assets/theme2/js/pace.min.js"></script>
<!-- Bootstrap CSS -->
<link rel="stylesheet" href="/assets/theme2/css/bootstrap.min.css" />
<!-- Icons CSS -->
<link rel="stylesheet" href="/assets/theme2/css/icons.css" />
<!-- App CSS -->
<link rel="stylesheet" href="/assets/theme2/css/app.css" />


<!-- ennd New theme -->

 <meta name="csrf_token" content="{{ csrf_token() }}" />


@yield('styles')

@section('scripts_default')
{{-- <script src="/assets/theme/ethplus/vendor/global/global.min.js"></script>
<script src="/assets/theme/ethplus/vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
<script src="/assets/theme/ethplus/js/custom.min.js"></script>
<script src="/assets/theme/ethplus/vendor/chart.js/Chart.bundle.min.js"></script>
<script src="/assets/theme/ethplus/js/deznav-init.js"></script>
<script src="/assets/theme/ethplus/vendor/owl-carousel/owl.carousel.js"></script>

<!-- Apex Chart -->
<script src="/assets/theme/ethplus/vendor/apexchart/apexchart.js"></script>
<!-- Dashboard 1 -->
<script src="/assets/theme/ethplus/js/dashboard/dashboard-1.js"></script> --}}

{{-- new theme --}}
<script src="/assets/theme2/js/jquery.min.js"></script>
<script src="/assets/theme2/js/popper.min.js"></script>
<script src="/assets/theme2/js/bootstrap.min.js"></script>
<!--plugins-->
<script src="/assets/theme2/plugins/simplebar/js/simplebar.min.js"></script>
<script src="/assets/theme2/plugins/metismenu/js/metisMenu.min.js"></script>
<script src="/assets/theme2/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
<!-- Vector map JavaScript -->
<script src="/assets/theme2/plugins/vectormap/jquery-jvectormap-2.0.2.min.js"></script>
<script src="/assets/theme2/plugins/vectormap/jquery-jvectormap-world-mill-en.js"></script>
<script src="/assets/theme2/plugins/vectormap/jquery-jvectormap-in-mill.js"></script>
<script src="/assets/theme2/plugins/vectormap/jquery-jvectormap-us-aea-en.js"></script>
<script src="/assets/theme2/plugins/vectormap/jquery-jvectormap-uk-mill-en.js"></script>
<script src="/assets/theme2/plugins/vectormap/jquery-jvectormap-au-mill.js"></script>
<script src="/assets/theme2/plugins/apexcharts-bundle/js/apexcharts.min.js"></script>
<script src="/assets/theme2/js/index.js"></script>
{{--end  new theme --}}

@stop
