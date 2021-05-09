<!DOCTYPE html>
<html>

    @include('auth/layouts.head', array('title'=> 'Meu Almoço'))

    <body class="bg-default">

        <!-- loader Start -->
        <!-- <div id="loading">
            <div id="loading-center">
            </div>
        </div> -->
        <!-- loader END -->
        
        @include('auth/layouts.header')
        @yield('content')

        @yield('scripts')
        @include('auth/modals.modals')
        @include('auth/layouts.footer')
        
    </body>

</html>