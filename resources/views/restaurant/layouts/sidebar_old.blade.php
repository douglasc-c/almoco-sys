
<div class="sidebar-wrapper" data-simplebar="true">
    <!--navigation-->
    <ul class="metismenu" id="menu">
        <li>
            <a href="{{URL::action('Restaurant\HomeController@index')}}">
                <div class="parent-icon"><i class="bx bx-user-circle"></i>
                </div>
                <div class="menu-title">Home</div>
            </a>
        </li>
        <li>
            <a href="{{URL::action('Restaurant\MenuController@index')}}">
                <div class="parent-icon"><i class="bx bx-user-circle"></i>
                </div>
                <div class="menu-title">Cardapios</div>
            </a>
        </li>
        <li>
            <a href="{{URL::action('Restaurant\FoodController@foodIndex')}}">
                <div class="parent-icon"><i class="bx bx-user-circle"></i>
                </div>
                <div class="menu-title">Alimentos</div>
            </a>
        </li>
    </ul>
    <!--end navigation-->
    <div class="copyright" style=" position: absolute; bottom: 50px;">
            <p class="fs-14 font-w200">©© 2021 Meu Almoço. Todos os direitos reservados</p>
    </div>
</div>
