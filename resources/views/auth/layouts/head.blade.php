<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<title>
  @section('title')
      {{{$title}}}
  @show
</title>

	<link rel="icon" href="assets/admin-theme/images/favicon-32x32.png" type="image/png" />
	<!-- loader-->
	<link href="assets/admin-theme/css/pace.min.css" rel="stylesheet" />
	<script src="assets/admin-theme/js/pace.min.js"></script>
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="assets/admin-theme/css/bootstrap.min.css" />
	<!-- Icons CSS -->
	<link rel="stylesheet" href="assets/admin-theme/css/icons.css" />
	<!-- App CSS -->
	<link rel="stylesheet" href="assets/admin-theme/css/app.css" />

<style type="text/css">
	.btn-language-auth{
		color: #3597a4;
    	background: #eeeeee;
    	margin-bottom: 15px;
	}

</style>

<meta name="csrf_token" content="{{ csrf_token() }}" />

@yield('styles')

@section('scripts_default')
{{-- <script src="assets/admin-theme/vendor/global/global.min.js"></script>
<script src="assets/admin-theme/vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
<script src="assets/admin-theme/js/custom.min.js"></script>
<script src="assets/admin-theme/js/deznav-init.js"></script> --}}
@stop
