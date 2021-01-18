@php
    $route = \Illuminate\Support\Facades\Route::currentRouteName();
    $bus = App\Models\Business::find(session('business_id'));
@endphp
<nav class="header-navbar navbar-expand-md navbar navbar-with-menu navbar-without-dd-arrow fixed-top"
     style="font-family: MTNBrighterSans-Regular !important;">
    <div class="navbar-wrapper">
        <div class="navbar-container content" style="background-color: #ffc423 !important;">
            <div class="collapse navbar-collapse show" id="navbar-mobile">
                <ul class="nav navbar-nav mr-auto float-left">
                    <li class="nav-item d-block d-md-none"><a class="nav-link nav-menu-main menu-toggle hidden-xs"
                                                              href="#"><i class="ft-menu"></i></a></li>

                    <li class="nav-item d-none d-md-block"><a href="{{route('business.index')}}" class="nav-link pt-2" aria-disabled="true">
                            {{ @$bus->name }}
                        </a>
                    </li>

                    <li class="nav-item d-block" id="walk" data-toggle="tooltip" data-placement="top"
                        title="Application WalkThrough"><a class="nav-link nav-link-label" href="#"
                                                           data-toggle="dropdown">
                            <button class="btn btn-block btn-success btn-icon"
                                    style="background-color: #1a237e;border:1px solid #fff;margin-top: -0.5em"><i
                                    class="la la-street-view" style="color: #fff"></i></button>
                        </a>
                    </li>

                </ul>

                <ul class="nav navbar-nav float-right" style="font-family: MTNBrighterSans-Regular !important;">
{{--                    @if($route == 'dashboard')--}}

{{--                    @endif--}}
                    <li class="dropdown dropdown-notification nav-item" data-toggle="tooltip" data-placement="top"
                        title="Switch Business">
                        <a style="color: grey" class="nav-link nav-link-label" href="#" data-toggle="dropdown"><i
                                class="fa fa-briefcase" style="color: #fff"></i> List of Businesses</a>
                        <div class="dropdown-menu dropdown-menu-right">
                            @if(auth()->user()->type == "manager")
                                @php
                                    $business = auth()->user()->businesses()->get();
                                @endphp
                                <div class="arrow_box_right">
                                    @foreach ($business as $item)
                                        <a class="dropdown-item"
                                           href=" {{ route('change-business', ['id' => $item->id_hash]) }} ">
                                            <i class="ft-check-square"></i>{{ $item->name }}</a>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </li>

                    <li class="dropdown dropdown-user nav-item"><a class="dropdown-toggle nav-link dropdown-user-link"
                                                                   href="#" data-toggle="dropdown">
                            <span><img style="width: 3em" src="{{ asset(@$selected_business->logo ?? 'UI/images/backgrounds/MTN.png')}}"
                                    alt="Your Company Logo"><i></i></span></a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <div class="arrow_box_right">
                                <div class="mr-3">
                                    <a class="dropdown-item" href="#"><span class="avatar avatar-online">
                                        <span class="user-name text-bold-700 ml-1">
                                            {{ auth()->user()->full_name }}
                                        </span></span>
                                    </a>
                                    <div class="dropdown-item">
                                        <form id="change-logo-form" action="{{ route('business.change_lgo') }}"
                                              method="post" enctype="multipart/form-data">
                                            @csrf
                                            <div id="js-file-upload"
                                                 onclick="document.getElementById('js-file-upload-org').click();">
                                                <a class="user-name text-bold-700 ml-1"
                                                      role="link">Change Logo</a>
                                            </div>
                                            <input type="file" id="js-file-upload-org" name="business_logo_file"
                                                   onchange="document.getElementById('change-logo-form').submit();" style="display:none;"/>
                                        </form>
                                    </div>
                                </div>
                                <div class="dropdown-divider"></div>
                                {{-- <a class="dropdown-item" href="#">--}}
                                {{-- <i class="ft-user">--}}

                                {{-- </i> Edit Profile</a>--}}

                                {{-- <a class="dropdown-item" href="#"><i class="ft-mail">--}}

                                {{-- </i> My Inbox</a>--}}

                                {{-- <a class="dropdown-item" href="#"><i class="ft-check-square">--}}

                                {{-- </i> Task</a>--}}

                                {{-- <a class="dropdown-item" href="#"><i class="ft-message-square"></i> Chats</a>--}}

                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();" style="color: red">
                                    <i class="ft-power"></i> Logout</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                      style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>


<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true"
     data-img="{{asset('UI/images/backgrounds/back022.jpg')}}" style="font-family: MTNBrighterSans-Regular !important;">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item mr-auto"><a class="navbar-brand" href="{{route('dashboard')}}"><img class="brand-logo"
                                                                                                    alt="MTN"
                                                                                                    src="{{asset('UI/images/backgrounds/MTN.png')}}"/>
                    <p class="brand-text"
                       style="font-size: 0.9em; color: #ffc423;font-family: MTNBrighterSans-Regular !important;">MTN
                        Business Manager</p>
                </a></li>
            <li class="nav-item d-md-none"><a class="nav-link close-navbar"><i class="ft-x"></i></a></li>
        </ul>
    </div>
    <div class="main-menu-content">
        @php
            $subscription = @\App\Models\Business::find(session('business_id'))->owner->subscription;
        @endphp
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li id="_home" class="{{ preg_match('/home/', $route) ? 'active nav-item' : '' }}"><a
                    style="font-family: MTNBrighterSans-Regular !important;" href="{{ route('home') }}"><i
                        class="ft-home"></i><span class="menu-title" data-i18n="">Home</span></a>
            </li>

                <li id="_dashboard" class="{{ preg_match('/dashboard/', $route) ? 'active nav-item' : '' }}">
                    <a href="{{ route('dashboard') }}"><i class="ft-bar-chart-2"></i><span class="menu-title"
                                                                                           style="font-family: MTNBrighterSans-Regular !important;">Dashboard</span></a>
                </li>

                {{-- Subscriptions Module --}}
                @if(isset(auth()->user()->subscription_id))
                    <li id="_subscription" class="{{ preg_match('/subscription.*/', $route) ? 'active nav-item' : '' }}">
                        @php
                            $days = @$subscription->remaining_days;
                        @endphp
                        <a style="font-family: MTNBrighterSans-Regular !important;" href="#">
                            <i class="la la-cubes"></i><span class="menu-title" data-i18n="">
                            <font style="margin-top: -2em">Manage Accounts</font>
                        </span>
                            @if(isset($days))
                                <span class='badge badge-info' style="margin-top: -0.9em">{{ $days }} days left</span>
                            @endif
                        </a>
                        <ul class="submenu-angle" aria-expanded="false">
                            <li class="{{ preg_match('/subscription.plans.*/', $route) ? 'active' : '' }}">
                                {{-- TODO!: change to subscription plans --}}
                                <a title="Business" href="{{ route('subscription.plan.index') }}"><span class="mini-sub-pro"
                                                                                                        style="font-family: MTNBrighterSans-Regular !important;">Sign Up</span></a>
                            </li>
                            <li class="{{ preg_match('/business.paid.*/', $route) ? 'active' : '' }}">
                                <a title="Business" href="{{ route('business.index') }}"><span class="mini-sub-pro"
                                                                                               style="font-family: MTNBrighterSans-Regular !important;">Business</span></a>
                            </li>
                            <li class="{{ preg_match('/subscription.payment.*/', $route) ? 'active' : '' }}">
                                {{-- TODO!: change to subscription plans --}}
                                <a title="Business" href="{{ route('subscription.payment.index') }}"><span
                                        class="mini-sub-pro"
                                        style="font-family: MTNBrighterSans-Regular !important;">Payment History</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif

            @if($subscription != null && !($subscription->expiry_date < today() || $subscription->expiry_date == null))
                <li id="_accountmanager"
                    class="{{ preg_match('/account.gl.*/', $route) ? 'active nav-item open' : '' }} {{ preg_match('/account.journal.*/', $route) ? 'active nav-item open' : '' }}">
                    <a id="accountsmanager"><i class="ft-pie-chart"></i>
                        <span class="menu-title" style="font-family: MTNBrighterSans-Regular !important;">Accounts
                            Manager</span></a>

                    <ul class="submenu-angle" aria-expanded="false">
                        {{-- <li class="{{ preg_match('/account.gl.*/', $route) ? 'active' : '' }}">
                            <a title="General Ledgers" href="{{ route('account.gl.index') }}"><span class="mini-sub-pro"
                                                                                                    style="font-family: MTNBrighterSans-Regular !important;">General
                                    Ledger</span></a>
                        </li> --}}
                        <li class="{{ preg_match('/inventory.service.*/', $route) ? 'active' : ''  }}">
                            <a title="General Journal" href="{{ route('account.journal.index') }}"><span
                                    class="mini-sub-pro"
                                    style="font-family: MTNBrighterSans-Regular !important;">General Journal</span>
                            </a>
                        </li>

                    </ul>

                </li>


                <li id="_inventory"
                    class="{{ preg_match('/inventory/', $route) ? 'active nav-item open' : '' }} {{ preg_match('/inventory.product.*/', $route) ? 'active nav-item open' : '' }} {{ preg_match('/inventory.service.*/', $route) ? 'active nav-item open' : ''  }} {{ preg_match('/inventory.category.*/', $route) ? 'active nav-item open' : '' }}">
                    <a><i class="ft-shopping-cart"></i>
                        <span class="menu-title" data-i18n=""
                              style="font-family: MTNBrighterSans-Regular !important;">Inventory</span></a>

                    <ul class="submenu-angle" aria-expanded="false">
                        <li class="{{ preg_match('/inventory.product.*/', $route) ? 'active' : '' }}">
                            <a title="Inventory Products" href="{{ route('inventory.product.index') }}"><span
                                    class="mini-sub-pro"
                                    style="font-family: MTNBrighterSans-Regular !important;">Products</span></a>
                        </li>
                        <li class="{{ preg_match('/inventory.service.*/', $route) ? 'active' : ''  }}">
                            <a title="Inventory Services" href="{{ route('inventory.service.index') }}"><span
                                    class="mini-sub-pro"
                                    style="font-family: MTNBrighterSans-Regular !important;">Services</span>
                            </a>
                        </li>
                        <li class="{{ preg_match('/inventory.category.*/', $route) ? 'active' : ''  }}">
                            <a title="Inventory Categories" href="{{ route('inventory.category.index') }}"><span
                                    class="mini-sub-pro"
                                    style="font-family: MTNBrighterSans-Regular !important;">Categories</span>
                            </a>
                        </li>

                    </ul>

                </li>


                <li id="_sales"
                    class="{{ preg_match('/sales.product.*/', $route) ? 'active nav-item open' : '' }} {{ preg_match('/sales.service.*/', $route) ? 'active nav-item open' : ''  }} {{ preg_match('/sales.payment*/', $route) ? 'active nav-item open' : ''  }}">
                    <a id="salesmanager"><i class="la la-money"></i>
                        <span class="menu-title" data-i18n=""
                              style="font-family: MTNBrighterSans-Regular !important;">Sales Manager</span></a>
                    <ul class="submenu-angle" aria-expanded="false">
                        <li class="{{ preg_match('/sales.product.*/', $route) ? 'active' : '' }}">
                            <a title="Products Sales" href="{{ route('sales.product.index') }}"><span
                                    class="mini-sub-pro"
                                    style="font-family: MTNBrighterSans-Regular !important;">Products</span></a>
                        </li>
                        <li class="{{ preg_match('/sales.service.*/', $route) ? 'active' : ''  }}">
                            <a title="services sales" href="{{ route('sales.service.index') }}"><span
                                    class="mini-sub-pro"
                                    style="font-family: MTNBrighterSans-Regular !important;">Services</span>
                            </a>
                        </li>

                        <li class="{{ preg_match('/sales.payment*/', $route) ? 'active' : ''  }}">
                            <a title="services sales" href="{{ route('sales.payment.owing.index') }}"><span
                                    class="mini-sub-pro"
                                    style="font-family: MTNBrighterSans-Regular !important;">Payment</span>
                            </a>
                        </li>

                    </ul>


                </li>

                {{-- Expenses Module --}}
                <li id="_expenses" class="{{ preg_match('/expense/', $route) ? 'active nav-item open' : '' }}">
                    {{-- TODO!: change icon --}}
                    <a><i class="la la-users"></i>
                        <span class="menu-title" data-i18n=""
                              style="font-family: MTNBrighterSans-Regular !important;">Expense Manager</span></a>
                    <ul class="submenu-angle" aria-expanded="false">
                        <li class="{{ preg_match('/[^category]/', $route) ? 'active nav-item' : '' }}"><a
                                style="font-family: MTNBrighterSans-Regular !important;"
                                href="{{ route('expense.index') }}"><span class="mini-sub-pro"
                                                                          data-i18n="">Expenses</span></a>
                        </li>
                        <li class="{{ preg_match('/category/', $route) ? 'active nav-item' : '' }}"><a
                                style="font-family: MTNBrighterSans-Regular !important;"
                                href="{{ route('expense.category.index') }}"><span class="mini-sub-pro"
                                                                                   data-i18n="">Categories</span></a>
                        </li>
                    </ul>

                </li>

                {{-- Customers --}}
                <li id="_customer" class="{{ preg_match('/customer/', $route) ? 'active nav-item' : '' }}">
                    <a href="{{ route('customer.index') }}"><i class="ft-user"></i><span class="menu-title" data-i18n=""
                                                                                         style="font-family: MTNBrighterSans-Regular !important;">Customer Manager</span></a>
                </li>

                {{-- Employees --}}
                <li id="_employee" class="{{ preg_match('/employee/', $route) ? 'active nav-item' : '' }}"><a
                        style="font-family: MTNBrighterSans-Regular !important;" href="{{ route('employee.index') }}"><i
                            class="la la-users"></i><span class="menu-title" data-i18n="">Employees</span></a>
                </li>

                <li id="_supplier" class="{{ preg_match('/suppliers/', $route) ? 'active nav-item' : '' }}"><a
                        style="font-family: MTNBrighterSans-Regular !important;"
                        href="{{ route('suppliers.index') }}"><i class="la la-truck"></i><span class="menu-title"
                                                                                               data-i18n="">Suppliers</span></a>
                </li>


                {{-- General Model --}}
            <!-- TODO!: Add data intro -->
{{--                <li id="_general" class="{{ preg_match('/general|business/', $route) ? 'active nav-item open' : '' }}">--}}
{{--                    <a><i class="la la-list-alt"></i>--}}
{{--                        <span class="menu-title" data-i18n=""--}}
{{--                              style="font-family: MTNBrighterSans-Regular !important;">General</span></a>--}}
{{--                    <ul class="submenu-angle" aria-expanded="false">--}}
{{--                        <li class="{{ preg_match('/business.paid.*/', $route) ? 'active' : '' }}">--}}
{{--                            <a title="Business" href="{{ route('business.index') }}"><span class="mini-sub-pro"--}}
{{--                                                                                           style="font-family: MTNBrighterSans-Regular !important;">Business</span></a>--}}
{{--                        </li>--}}
{{--                    </ul>--}}

{{--                </li>--}}
            @endif


        </ul>

    </div>

    <div class="navigation-background"></div>
</div>
