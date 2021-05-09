<!DOCTYPE html>
<html>

	@include('dashboard/layouts.head', array('title'=> 'Meu Almoço'))

	<body>

		<!-- loader Start -->
		<!-- <div id="loading">
		 	<div id="loading-center">
		 	</div>
		</div> -->
		<!-- loader END -->

	    @include('partials.flash-messages')
	    @include('partials.error-block')
	    
    	@include('dashboard/layouts.header')
		@yield('content')

		@yield('scripts')
		@include('dashboard/modals.modals')
		@include('dashboard/layouts.footer')
		
	</body>

</html>