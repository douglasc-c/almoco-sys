<!DOCTYPE html>
<html lang="zxx" class="js">
<head>
	@include('admin/layouts/head', array('title'=>'MEu Almoço'))
</head>
<body class="bg-theme bg-theme1">

    <div id="wrapper">

            @include('admin/layouts/sidebar')
            @include('admin/layouts/header')

        <div class="page-wrapper">

            <div class="page-content-wrapper">
                    <div class="page-content">
                        @include('partials.flash-messages')
                        @include('partials.error-block')
                        @yield('content')

                    </div>
            </div>
        </div>
    </div>

  @yield('styles')
  @yield('scripts_default')
  @yield('scripts')

</body>
</html>
