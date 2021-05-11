<div class="sidebar-wrapper" data-simplebar="true">
        {{-- <div class="sidebar-header">
            <a href="index.html" class="brand-logo">

                <h3>LOGO</h3>
            </a>
        </div> --}}
        <!--navigation-->
        <ul class="metismenu" id="menu">
            <li>
                <a href="{{URL::action('SuperAdmin\HomeController@index')}}">
                    <div class="parent-icon"><i class="bx bx-user-circle"></i>
                    </div>
                    <div class="menu-title">Home</div>
                </a>
            </li>
            <li>
                <a href="{{URL::action('SuperAdmin\UsersController@index')}}">
                    <div class="parent-icon"><i class="bx bx-user-circle"></i>
                    </div>
                    <div class="menu-title">Usuários</div>
                </a>
            </li>
            <li>
                <a href="{{URL::action('SuperAdmin\FoodController@foodCategoriesIndex')}}">
                    <div class="parent-icon"><i class="bx bx-user-circle"></i>
                    </div>
                    <div class="menu-title">Categorias (Alimentos)</div>
                </a>
            </li>
            <li>
                <a href="{{URL::action('SuperAdmin\FoodController@foodIndex')}}">
                    <div class="parent-icon"><i class="bx bx-user-circle"></i>
                    </div>
                    <div class="menu-title">Alimentos</div>
                </a>
            </li>
        </ul>
        <!--end navigation-->
        <div class="copyright" style=" position: absolute; bottom: 50px;">
                <p class="fs-14 font-w200">© 2021 Meu Almoço. Todos os direitos reservados</p>
        </div>
    </div>
