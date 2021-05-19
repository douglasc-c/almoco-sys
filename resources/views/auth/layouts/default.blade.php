<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
  @include('auth/layouts/head', array('title'=>'Meu Almoço'))
</head>
<body class="bg-theme auth-bg">
        <!-- wrapper -->
        <div class="wrapper">
            <div class="section-authentication-login d-flex align-items-center justify-content-center">
                @yield('content')
                                
            </div>
        </div>
  

  @yield('styles')
  @yield('scripts_default')
  @yield('scripts')
</body>
</html>