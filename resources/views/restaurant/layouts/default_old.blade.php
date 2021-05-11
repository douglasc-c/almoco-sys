<!DOCTYPE html>
<html lang="zxx" class="js">
<head>
	@include('restaurant/layouts/head', array('title'=>'Npocoin Wallet'))
</head>
<body class="bg-theme bg-theme1">
    <div id="wrapper">
        <div class="sk-three-bounce">
            <div class="sk-child sk-bounce1"></div>
            <div class="sk-child sk-bounce2"></div>
            <div class="sk-child sk-bounce3"></div>
        </div>
    </div>

    <div class="page-wrapper">

    @include('restaurant/layouts/header')
    @include('restaurant/layouts/sidebar')

    <div class="page-content-wrapper">
        <div class="page-content">
            @include('partials.flash-messages')
            @include('partials.error-block')
            @yield('content')

        </div>
    </div>
  </div>

  @yield('styles')
  @yield('scripts_default')
  @yield('scripts')

</body>
</html>
