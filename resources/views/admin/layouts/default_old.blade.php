<!doctype html>
<html class="no-js " lang="en">
<head>
	@include('admin/layouts/head', array('title'=>'Admin'))
</head>

<body class="font-kumbh h_menu">
	<div id="body" class="theme-blue">

		<!-- <div class="page-loader-wrapper">
	        <div class="loader">
	            <div class="mt-3"><img class="zmdi-hc-spin w60" src="/assets/theme/images/loader.svg" alt="Amaze"></div>
	            <p>Please wait...</p>        
	        </div>
	    </div> -->

	    <div class="overlay"></div>

	    @include('admin/layouts.top')
	    @include('admin/layouts.sidebar')

	    <div class="body_area after_bg">

	    	<div class="block-header">
	            <div class="container">
	                <div class="row clearfix">
	                    <div class="col-lg-6 col-md-12">
	                        <ul class="breadcrumb pl-0 pb-0 ">
	                            <li class="breadcrumb-item"><a href="index.html">Admin</a></li>
	                            <li class="breadcrumb-item active">{{$title}}</li>
	                        </ul>
	                        <h1 class="mb-1 mt-1">Hello, {{Auth::user()->name}}</h1>
	                        <span>Welcome back to your admin, if need a help <a href="javascript:void(0);" class="text-secondary">Contact</a> us.</span>
	                    </div>            
	                    <div class="col-lg-6 col-md-12 text-md-right">
	                        <button class="btn btn-default hidden-xs ml-2" disabled="">You are in: ADMIN</button>
	                    </div>
	                </div>
	            </div>
	        </div>

	        <div class="container">
	        	@include('partials.flash-messages')
   				@include('partials.error-block')
	        	@yield('content')
	        </div>

	    </div>

	</div>

	@yield('styles')
	@yield('scripts_default')
	@yield('scripts')

	<div id="modal-dialog" class="modal fade animate black-overlay" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	    <div class="modal-dialog modal-sm">
	      <div class="modal-content flip-y">
	        <div class="modal-body text-center">          
	          <p class="py-3 mt-3"><i class="zmdi zmdi-check-circle"></i></p>
	          <p>Are you sure to make this action?</p>
	        </div>
	        <div class="modal-footer">
	          <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
	          <a href="#" id="confirm" class="btn btn-success text-white">Yes</a>
	        </div>
	      </div>
	    </div>
  	</div>

</body>
</html>