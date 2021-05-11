    <aside id="leftsidebar" class="sidebar">
        <div class="container">
            <div class="row clearfix">
                <div class="col-12">
                    <div class="menu">



                        <ul class="list">
                             @if(!Auth::user()->hasRole('onlyValidation'))
                            <li class="header">MAIN</li>
                            <li class="{{(url('/').'/'.Request::path() == URL::action('Admin\HomeController@index')) ? 'active open': ''}}">
                                <a href="{{URL::action('Admin\HomeController@index')}}" class="menu-toggle"><i class="zmdi zmdi-home"></i><span>Dashboard</span></a>
                            </li>
                            <li class="{{(url('/').'/'.Request::path() == URL::action('Admin\UsersController@index')) ? 'active open': ''}}">
                                <a href="{{URL::action('Admin\UsersController@index')}}" class="menu-toggle"><i class="zmdi zmdi-accounts"></i><span>Users</span></a>
                            </li>
                            @endif

                            <li>
                                <a href="javascript:void(0);" class="menu-toggle">
                                    <i class="zmdi zmdi-check"></i><span>Validations</span>
                                </a>
                                <ul class="ml-menu">
                                    <li><a href="{{URL::action('Admin\UserValidationController@index', 0)}}">Pending</a></li>
                                    <li><a href="{{URL::action('Admin\UserValidationController@index', 1)}}">Complete</a></li>
                                    <li><a href="{{URL::action('Admin\UserValidationController@index', 2)}}">Decline</a></li>
                                    <li><a href="{{URL::action('Admin\UserValidationController@indexSearch')}}">Search</a></li>
                                </ul>
                            </li>

                             @if(!Auth::user()->hasRole('onlyValidation'))
                            <li>
                                <a href="javascript:void(0);" class="menu-toggle">
                                    <img width="13px" src="/assets/images/coins/white_v3-ETHPY.svg"><span>Wallet Default</span>
                                </a>
                                <ul class="ml-menu">
                                    <li><a href="{{URL::action('Admin\CreditsController@deposits', 'default')}}">Deposits</a></li>
                                    <li><a href="{{URL::action('Admin\CreditsController@index', 'default')}}">History</a></li>
                                </ul>
                            </li>

                            <li>
                                <a href="javascript:void(0);" class="menu-toggle">
                                    <i class="zmdi zmdi-refresh-alt"></i><span>Wallet Stake</span>
                                </a>
                                <ul class="ml-menu">
                                    <li><a href="{{URL::action('Admin\DepositsLendingController@index')}}">Deposits</a></li>
                                    <li><a href="{{URL::action('Admin\CreditsController@index', 'stake')}}">History</a></li>
                                </ul>
                            </li>

                            <li class="{{(url('/').'/'.Request::path() == URL::action('Admin\OrdersController@index')) ? 'active open': ''}}">
                                <a href="{{URL::action('Admin\OrdersController@index')}}" class="menu-toggle"><i class="zmdi zmdi-layers"></i><span>Orders</span></a>
                            </li>

                            <li class="{{(url('/').'/'.Request::path() == URL::action('Admin\DepositsLendingController@index')) ? 'active open': ''}}">
                                <a href="{{URL::action('Admin\DepositsLendingController@index')}}" class="menu-toggle"><i class="zmdi zmdi-refresh-alt"></i><span>Deposits Staking</span></a>
                            </li>

                            <li>
                                <a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-file"></i><span>Withdrawals (Default)</span></a>
                                <ul class="ml-menu">
                                    {{-- <li><a href="{{URL::action('Admin\WithdrawalsController@all', ['default', 0])}}">Pending (add queue)</a></li> --}}
                                    <li><a href="{{URL::action('Admin\WithdrawalsController@index', ['default', 0])}}">Pending</a></li>
                                    <li><a href="{{URL::action('Admin\WithdrawalsController@index', ['default', 1])}}">Complete</a></li>
                                    <li><a href="{{URL::action('Admin\WithdrawalsController@index', ['default', 2])}}">Canceled</a></li>
                                </ul>
                            </li>

                            <li>
                                <a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-file"></i><span>Withdrawals (Staking)</span></a>
                                <ul class="ml-menu">
                                    {{-- <li><a href="{{URL::action('Admin\WithdrawalsController@all', ['stake', 0])}}">Pending (add queue)</a></li> --}}
                                    <li><a href="{{URL::action('Admin\WithdrawalsController@index', ['stake', 0])}}">Pending</a></li>
                                    <li><a href="{{URL::action('Admin\WithdrawalsController@index', ['stake', 1])}}">Complete</a></li>
                                    <li><a href="{{URL::action('Admin\WithdrawalsController@index', ['stake', 2])}}">Canceled</a></li>
                                </ul>
                            </li>

                            <li>
                                <a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-calendar"></i><span>Reports</span></a>
                                <ul class="ml-menu">
                                    <li><a href="{{URL::action('Admin\ReportsController@entries', ['default'])}}">Entries Default</a></li>
                                    <li><a href="{{URL::action('Admin\ReportsController@entries', ['stake'])}}">Entries Staking</a></li>
                                </ul>
                            </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </aside>
