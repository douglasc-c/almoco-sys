    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Site Title  -->
    <title>
      @section('title')
          {{{$title}}}
      @show
    </title>
    <!-- Vendor Bundle CSS -->
	<!--favicon-->
	<link rel="icon" href="/assets/admin-theme/images/favicon-32x32.png" type="image/png" />
	<!-- Vector CSS -->
	<link href="/assets/admin-theme/plugins/vectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet" />
	<!--plugins-->
	<link href="/assets/admin-theme/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
	<link href="/assets/admin-theme/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
	<link href="/assets/admin-theme/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
	<link href="/assets/admin-theme/plugins/animate/animate.min.css" rel="stylesheet" />
	<!-- loader-->
	<link href="/assets/admin-theme/css/pace.min.css" rel="stylesheet" />
	<script src="/assets/admin-theme/js/pace.min.js"></script>
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="/assets/admin-theme/css/bootstrap.min.css" />
	<!-- Icons CSS -->
	<link rel="stylesheet" href="/assets/admin-theme/css/icons.css" />
	<!-- App CSS -->
	<link rel="stylesheet" href="/assets/admin-theme/css/app.css" />

 <meta name="csrf_token" content="{{ csrf_token() }}" />


	@yield('styles')

	@section('scripts_default')
    {{-- new theme --}}
    <script src="/assets/admin-theme/js/jquery.min.js"></script>
	<script src="/assets/admin-theme/js/popper.min.js"></script>
	<script src="/assets/admin-theme/js/bootstrap.min.js"></script>
	<!--plugins-->
	<script src="/assets/admin-theme/plugins/simplebar/js/simplebar.min.js"></script>
	<script src="/assets/admin-theme/plugins/metismenu/js/metisMenu.min.js"></script>
	<script src="/assets/admin-theme/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
	<!-- Vector map JavaScript -->
	<script src="/assets/admin-theme/plugins/vectormap/jquery-jvectormap-2.0.2.min.js"></script>
	<script src="/assets/admin-theme/plugins/vectormap/jquery-jvectormap-world-mill-en.js"></script>
	<script src="/assets/admin-theme/plugins/vectormap/jquery-jvectormap-in-mill.js"></script>
	<script src="/assets/admin-theme/plugins/vectormap/jquery-jvectormap-us-aea-en.js"></script>
	<script src="/assets/admin-theme/plugins/vectormap/jquery-jvectormap-uk-mill-en.js"></script>
	<script src="/assets/admin-theme/plugins/vectormap/jquery-jvectormap-au-mill.js"></script>
	{{-- <script src="/assets/admin-theme/plugins/apexcharts-bundle/js/apexcharts.min.js"></script> --}}
	<script src="/assets/admin-theme/js/index.js"></script>
    {{--end  new theme --}}

	@stop
