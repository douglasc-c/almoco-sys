<!--begin::Header-->
<div id="kt_header" class="header header-fixed">
        <!--begin::Container-->
        <div class="container d-flex align-items-stretch justify-content-between">
            <!--begin::Left-->
            <div class="d-flex align-items-stretch mr-3">
                <!--begin::Header Logo-->
                <div class="header-logo">
                    <a href="#" style="cursor: default;">
                        <img alt="Logo" src="/assets/images/logo/Logo.svg" class="logo-default max-h-40px" />
                    </a>
                </div>
                <!--end::Header Logo-->
                <!--begin::Header Menu Wrapper-->
                <div class="header-menu-wrapper header-menu-wrapper-left" id="kt_header_menu_wrapper">
                    <!--begin::Header Menu-->
                    <div id="kt_header_menu" class="header-menu header-menu-left header-menu-mobile header-menu-layout-default">
                        <!--begin::Header Nav-->
                        <ul class="menu-nav">
                            <li class="menu-item menu-item-open menu-item-here menu-item-submenu menu-item-rel menu-item-open menu-item-here" data-menu-toggle="click" aria-haspopup="true">
                                <a href="{{URL::action('Admin\HomeController@index')}}" class="menu-link">
                                    <span class="menu-text">Dashboard</span>
                                    <i class="menu-arrow"></i>
                                </a>
                            </li>
                            <li class="menu-item menu-item-open menu-item-here menu-item-submenu menu-item-rel menu-item-open menu-item-here" data-menu-toggle="click" aria-haspopup="true">
                                <a href="{{URL::action('Admin\HomeController@showWallet')}}" class="menu-link">
                                    <span class="menu-text">Wallets</span>
                                    <i class="menu-arrow"></i>
                                </a>
                            </li>
                            <li class="menu-item menu-item-submenu menu-item-rel" data-menu-toggle="click" aria-haspopup="true">
                                <a href="{{URL::action('Admin\UsersController@index')}}" class="menu-link">
                                    <span class="menu-text">Users</span>
                                    <i class="menu-arrow"></i>
                                </a>
                            </li>
                            <li class="menu-item menu-item-submenu menu-item-rel" data-menu-toggle="click" aria-haspopup="true">
                                <a href="javascript:;" class="menu-link menu-toggle">
                                    <span class="menu-text">Validations</span>
                                    <i class="menu-arrow"></i>
                                </a>
                                <div class="menu-submenu menu-submenu-classic menu-submenu-left">
                                    <ul class="menu-subnav">
                                        <li class="menu-item menu-item-active" aria-haspopup="true">
                                            <a href="{{URL::action('Admin\UserValidationController@index', 0)}}" class="menu-link">
                                                <span class="menu-text">Pending</span>
                                                <span class="menu-desc"></span>
                                            </a>
                                        </li>
                                        <li class="menu-item menu-item-active" aria-haspopup="true">
                                            <a href="{{URL::action('Admin\UserValidationController@index', 1)}}" class="menu-link">
                                                <span class="menu-text">Complete</span>
                                                <span class="menu-desc"></span>
                                            </a>
                                        </li>
                                        <li class="menu-item menu-item-active" aria-haspopup="true">
                                            <a href="{{URL::action('Admin\UserValidationController@index', 2)}}" class="menu-link">
                                                <span class="menu-text">Decline</span>
                                                <span class="menu-desc"></span>
                                            </a>
                                        </li>
                                        <li class="menu-item menu-item-active" aria-haspopup="true">
                                            <a href="{{URL::action('Admin\UserValidationController@indexSearch')}}" class="menu-link">
                                                <span class="menu-text">Search</span>
                                                <span class="menu-desc"></span>
                                            </a>
                                        </li>

                                    </ul>
                                </div>
                            </li>
                            @if(!Auth::user()->hasRole('onlyValidation'))
                                <li class="menu-item menu-item-submenu menu-item-rel" data-menu-toggle="click" aria-haspopup="true">
                                    <a href="javascript:;" class="menu-link menu-toggle">
                                        <span class="menu-text">Wallet Default</span>
                                        <i class="menu-arrow"></i>
                                    </a>
                                    <div class="menu-submenu menu-submenu-classic menu-submenu-left">
                                        <ul class="menu-subnav">
                                            <li class="menu-item menu-item-active" aria-haspopup="true">
                                                <a href="{{URL::action('Admin\CreditsController@deposits', 'default')}}" class="menu-link">
                                                    <span class="menu-text">Deposits</span>
                                                    <span class="menu-desc"></span>
                                                </a>
                                            </li>
                                            <li class="menu-item" aria-haspopup="true">
                                                <a href="{{URL::action('Admin\CreditsController@index', 'default')}}" class="menu-link">
                                                    <span class="menu-text">History</span>
                                                    <span class="menu-desc"></span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                                <li class="menu-item menu-item-submenu menu-item-rel" data-menu-toggle="click" aria-haspopup="true">
                                    <a href="javascript:;" class="menu-link menu-toggle">
                                        <span class="menu-text">Wallet Stake</span>
                                        <i class="menu-arrow"></i>
                                    </a>
                                    <div class="menu-submenu menu-submenu-classic menu-submenu-left">
                                        <ul class="menu-subnav">
                                            <li class="menu-item menu-item-active" aria-haspopup="true">
                                                <a href="{{URL::action('Admin\DepositsLendingController@index')}}" class="menu-link">
                                                    <span class="menu-text">Deposits</span>
                                                    <span class="menu-desc"></span>
                                                </a>
                                            </li>
                                            <li class="menu-item" aria-haspopup="true">
                                                <a href="{{URL::action('Admin\CreditsController@index', 'stake')}}" class="menu-link">
                                                    <span class="menu-text">History</span>
                                                    <span class="menu-desc"></span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                                <li class="menu-item menu-item-submenu menu-item-rel" data-menu-toggle="click" aria-haspopup="true">
                                    <a href="{{URL::action('Admin\OrdersController@index')}}" class="menu-link">
                                        <span class="menu-text">Orders</span>
                                        <i class="menu-arrow"></i>
                                    </a>
                                </li>
                                <li class="menu-item menu-item-submenu menu-item-rel" data-menu-toggle="click" aria-haspopup="true">
                                    <a href="{{URL::action('Admin\DepositsLendingController@index')}}" class="menu-link">
                                        <span class="menu-text">Deposits Staking</span>
                                        <i class="menu-arrow"></i>
                                    </a>
                                </li>
                                <li class="menu-item menu-item-submenu menu-item-rel" data-menu-toggle="click" aria-haspopup="true">
                                    <a href="javascript:;" class="menu-link menu-toggle">
                                        <span class="menu-text">Withdrawals (Default)</span>
                                        <i class="menu-arrow"></i>
                                    </a>
                                    <div class="menu-submenu menu-submenu-classic menu-submenu-left">
                                        <ul class="menu-subnav">
                                            <li class="menu-item" aria-haspopup="true">
                                                <a href="{{URL::action('Admin\WithdrawalsController@index', ['default', 0])}}" class="menu-link">
                                                    <span class="menu-text">Pending</span>
                                                    <span class="menu-desc"></span>
                                                </a>
                                            </li>
                                            <li class="menu-item" aria-haspopup="true">
                                                <a href="{{URL::action('Admin\WithdrawalsController@index', ['default', 1])}}" class="menu-link">
                                                    <span class="menu-text">Complete</span>
                                                    <span class="menu-desc"></span>
                                                </a>
                                            </li>
                                            <li class="menu-item" aria-haspopup="true">
                                                <a href="{{URL::action('Admin\WithdrawalsController@index', ['default', 2])}}" class="menu-link">
                                                    <span class="menu-text">Canceled</span>
                                                    <span class="menu-desc"></span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                                <li class="menu-item menu-item-submenu menu-item-rel" data-menu-toggle="click" aria-haspopup="true">
                                    <a href="javascript:;" class="menu-link menu-toggle">
                                        <span class="menu-text">Withdrawals (Staking)</span>
                                        <i class="menu-arrow"></i>
                                    </a>
                                    <div class="menu-submenu menu-submenu-classic menu-submenu-left">
                                        <ul class="menu-subnav">
                                            {{-- <li class="menu-item menu-item-active" aria-haspopup="true">
                                                <a href="{{URL::action('Admin\WithdrawalsController@all', ['stake', 0])}}" class="menu-link">
                                                    <span class="menu-text">Pending (add queue)</span>
                                                    <span class="menu-desc"></span>
                                                </a>
                                            </li> --}}
                                            <li class="menu-item" aria-haspopup="true">
                                                <a href="{{URL::action('Admin\WithdrawalsController@index', ['stake', 0])}}" class="menu-link">
                                                    <span class="menu-text">Pending</span>
                                                    <span class="menu-desc"></span>
                                                </a>
                                            </li>
                                            <li class="menu-item" aria-haspopup="true">
                                                <a href="{{URL::action('Admin\WithdrawalsController@index', ['stake', 1])}}" class="menu-link">
                                                    <span class="menu-text">Complete</span>
                                                    <span class="menu-desc"></span>
                                                </a>
                                            </li>
                                            <li class="menu-item" aria-haspopup="true">
                                                <a href="{{URL::action('Admin\WithdrawalsController@index', ['stake', 2])}}" class="menu-link">
                                                    <span class="menu-text">Canceled</span>
                                                    <span class="menu-desc"></span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                                <li class="menu-item menu-item-submenu menu-item-rel" data-menu-toggle="click" aria-haspopup="true">
                                    {{-- <a href="javascript:;" class="menu-link menu-toggle">
                                        <span class="menu-text">Reports</span>
                                        <i class="menu-arrow"></i>
                                    </a> --}}
                                    <div class="menu-submenu menu-submenu-classic menu-submenu-left">
                                        <ul class="menu-subnav">
                                            <li class="menu-item menu-item-active" aria-haspopup="true">
                                                <a href="{{URL::action('Admin\ReportsController@entries', ['default'])}}" class="menu-link">
                                                    <span class="menu-text">Entries Default</span>
                                                    <span class="menu-desc"></span>
                                                </a>
                                            </li>
                                            <li class="menu-item" aria-haspopup="true">
                                                <a href="{{URL::action('Admin\ReportsController@entries', ['stake'])}}" class="menu-link">
                                                    <span class="menu-text">Entries Staking</span>
                                                    <span class="menu-desc"></span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>

                            @endif

                        </ul>
                        <!--end::Header Nav-->
                    </div>
                    <!--end::Header Menu-->
                </div>
                <!--end::Header Menu Wrapper-->
            </div>
            <!--end::Left-->
            <!--begin::Topbar-->
            <div class="topbar">
                <!--begin::Languages-->
                <div class="dropdown">
                    <!--begin::Toggle-->
                    <div class="topbar-item" data-toggle="dropdown" data-offset="10px,0px">
                        <div class="btn btn-icon btn-hover-transparent-white btn-dropdown btn-lg mr-1">
                            <img class="h-60px w-60px" src="/assets/images/NVA_110x110.png" alt="" style="border-radius: 50%; border: 3px solid #46da6c"/>
                        </div>
                    </div>
                    <!--end::Toggle-->
                    <!--begin::Dropdown-->
                    <div class="dropdown-menu p-0 m-0 dropdown-menu-anim-up dropdown-menu-sm dropdown-menu-right">
                        <!--begin::Nav-->
                        <ul class="navi navi-hover py-4">
                            <li class="navi-item text-center">
                                <a style="cursor: default;">
                                    <span class="navi-text text-center" style="color: darkcyan; margin: 0 auto;">{{Auth::user()->name}}</span>
                                </a>
                            </li>
                            <li class="navi-item">
                                <a href="{{URL::action('Wallet\SettingsController@index')}}" class="navi-link">
                                    <span class="navi-text">Settings</span>
                                </a>
                            </li>
                            @if(session()->get('impersonated'))
                            <li class="navi-item">
                                <a href="{{URL::action('Wallet\SettingsController@backToAdmin')}}" class="navi-link">
                                    <span class="navi-text">Back to Admin</span>
                                </a>
                            </li>
                            @endif
                            <li class="navi-item">
                                <a href="{{ route('logout') }}" class="navi-link" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                    <span class="navi-text">Sign Out</span>
                                </a>
                            </li>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </ul>
                        <!--end::Nav-->
                    </div>
                    <!--end::Dropdown-->
                </div>
                <!--end::Languages-->
            </div>
            <!--end::Topbar-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Header-->
