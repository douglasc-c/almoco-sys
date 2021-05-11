<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<!-- Site Title  -->
<title>
  @section('title')
      {{{$title}}}
  @show
</title>
	<!--favicon-->
	<link rel="icon" href="/assets/theme2/assets/images/favicon-32x32.png" type="image/png" />
	<!-- Vector CSS -->
	<link href="/assets/theme2/assets/plugins/vectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet" />
	<!--plugins-->
	<link href="/assets/theme2/assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
	<link href="/assets/theme2/assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
	<link href="/assets/theme2/assets/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
	<!-- loader-->
	<link href="/assets/theme2/assets/css/pace.min.css" rel="stylesheet" />
	<script src="/assets/theme2/assets/js/pace.min.js"></script>
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="/assets/theme2/assets/css/bootstrap.min.css" />
	<!-- Icons CSS -->
	<link rel="stylesheet" href="/assets/theme2/assets/css/icons.css" />
	<!-- App CSS -->
	<link rel="stylesheet" href="/assets/theme2/assets/css/app.css" />

 <meta name="csrf_token" content="{{ csrf_token() }}" />


@yield('styles')

@section('scripts_default')
<!-- JavaScript -->
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="/assets/theme2/assets/js/jquery.min.js"></script>
	<script src="/assets/theme2/assets/js/popper.min.js"></script>
	<script src="/assets/theme2/assets/js/bootstrap.min.js"></script>
	<!--plugins-->
	<script src="/assets/theme2/assets/plugins/simplebar/js/simplebar.min.js"></script>
	<script src="/assets/theme2/assets/plugins/metismenu/js/metisMenu.min.js"></script>
	<script src="/assets/theme2/assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
	<!-- Vector map JavaScript -->
	<script src="/assets/theme2/assets/plugins/vectormap/jquery-jvectormap-2.0.2.min.js"></script>
	<script src="/assets/theme2/assets/plugins/vectormap/jquery-jvectormap-world-mill-en.js"></script>
	<script src="/assets/theme2/assets/plugins/vectormap/jquery-jvectormap-in-mill.js"></script>
	<script src="/assets/theme2/assets/plugins/vectormap/jquery-jvectormap-us-aea-en.js"></script>
	<script src="/assets/theme2/assets/plugins/vectormap/jquery-jvectormap-uk-mill-en.js"></script>
	<script src="/assets/theme2/assets/plugins/vectormap/jquery-jvectormap-au-mill.js"></script>
	<script src="/assets/theme2/assets/plugins/apexcharts-bundle/js/apexcharts.min.js"></script>
	<script src="/assets/theme2/assets/js/index.js"></script>
	<!-- App JS -->
	<script src="/assets/theme2/assets/js/app.js"></script>
	<script>
		new PerfectScrollbar('.dashboard-social-list');
		new PerfectScrollbar('.dashboard-top-countries');
	</script>

@stop
