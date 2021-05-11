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
                <a href="{{URL::action('Restaurant\HomeController@index')}}">
                    <div class="parent-icon"><i class="bx bx-envelope"></i>
                    </div>
                    <div class="menu-title">Home</div>
                </a>
            </li>
            <li>
                <a href="{{URL::action('Restaurant\MenuController@index')}}">
                    <div class="parent-icon"><i class="bx bx-group"></i>
                    </div>
                    <div class="menu-title">Cardapios</div>
                </a>
            </li>
            <li>
                <a href="{{URL::action('Restaurant\FoodController@foodIndex')}}">
                    <div class="parent-icon"><i class="bx bx-archive"></i>
                    </div>
                    <div class="menu-title">Alimentos</div>
                </a>
            </li>
        </ul>
        <!--end navigation-->
    </div>
