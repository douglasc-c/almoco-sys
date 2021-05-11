<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div class="">
            <img src="assets/images/logo-icon.png" class="logo-icon-2" alt="" />
        </div>
        <div>
            <h4 class="logo-text">Syntrans</h4>
        </div>
        <a href="javascript:;" class="toggle-btn ml-auto"> <i class="bx bx-menu"></i>
        </a>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">
        <li>
            <a href="{{URL::action('SuperAdmin\HomeController@index')}}">
                <div class="parent-icon"><i class="bx bx-envelope"></i>
                </div>
                <div class="menu-title">Home</div>
            </a>
        </li>
        <li>
            <a href="{{URL::action('SuperAdmin\UsersController@index')}}">
                <div class="parent-icon"><i class="bx bx-group"></i>
                </div>
                <div class="menu-title">Usuários</div>
            </a>
        </li>
        <li>
            <a href="{{URL::action('SuperAdmin\FoodController@foodCategoriesIndex')}}">
                <div class="parent-icon"><i class="bx bx-archive"></i>
                </div>
                <div class="menu-title">Categorias (Alimentos)</div>
            </a>
        </li>
        <li>
            <a href="{{URL::action('SuperAdmin\FoodController@foodIndex')}}">
                <div class="parent-icon"> <i class="bx bx-conversation"></i>
                </div>
                <div class="menu-title">Alimentos</div>
            </a>
        </li>
    </ul>
    <!--end navigation-->
</div>
