<!DOCTYPE html>
<html lang="zxx" class="js">
<head>
	@include('restaurant/layouts/head', array('title'=>'Meu almoço'))
</head>
<body class="bg-theme main-bg main-body">
    @include('restaurant/layouts/header')
    <div class="page-wrapper">
        <div class="page-content">
            @include('partials.flash-messages')
            @include('partials.error-block')
            @yield('content')
        </div>
        @include('restaurant/layouts.footer')
    </div>
  @yield('styles')
  @yield('scripts_default')
  @yield('scripts')

</body>
</html>
