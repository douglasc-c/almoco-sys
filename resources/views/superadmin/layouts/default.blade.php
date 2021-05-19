<!DOCTYPE html>
<html lang="zxx" class="js">
<head>
	@include('superadmin/layouts/head', array('title'=>'Meu almoço'))
</head>
<body class="bg-theme main-bg">
        @include('superadmin/layouts/header')
        <div class="page-wrapper">
            <div class="page-content">
                @include('partials.flash-messages')
                @include('partials.error-block')
                @yield('content')
    
            </div>
        </div>
    
      @yield('styles')
      @yield('scripts_default')
      @yield('scripts')
    
    </body>
</html>
