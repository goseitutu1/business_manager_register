@php
$route = \Illuminate\Support\Facades\Route::currentRouteName();
@endphp
<nav class="header-navbar navbar-expand-md navbar navbar-with-menu navbar-without-dd-arrow fixed-top"
    style="font-family: MTNBrighterSans-Regular !important;">
    <div class="navbar-wrapper">
        <div class="navbar-container content" style="background-color: #ffc423 !important;">
            <div class="collapse navbar-collapse show" id="navbar-mobile">
                <ul class="nav navbar-nav mr-auto float-left">
                    <li class="nav-item d-block d-md-none"><a class="nav-link nav-menu-main menu-toggle hidden-xs"
                            href="#"><i class="ft-menu"></i></a></li>
                    <li class="nav-item d-none d-md-block"><a class="nav-link nav-link-expand" href="#"><i
                                class="ficon ft-maximize" style="color: #212121"></i></a></li>
                    <li class="nav-item dropdown navbar-search"><a class="nav-link dropdown-toggle hide"
                            data-toggle="dropdown" href="#"><i class="ficon ft-search" style="color: #fff"></i></a>
                        <ul class="dropdown-menu">
                            <li class="arrow_box">
                                <form>
                                    <div class="input-group search-box">
                                        <div class="position-relative has-icon-right full-width">
                                            <input class="form-control" id="search" type="text"
                                                placeholder="Search here...">
                                            <div class="form-control-position navbar-search-close"><i class="ft-x"> </i>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>

                <ul class="nav navbar-nav float-right" style="font-family: MTNBrighterSans-Regular !important;">
                    @if($route == 'dashboard')
                    <li class="nav-item d-block" id="walk" data-toggle="tooltip" data-placement="top"
                        title="Application WalkThrough"><a class="nav-link nav-link-label" href="#"
                            data-toggle="dropdown">
                            <button class="btn btn-block btn-success btn-icon"
                                style="background-color: #1a237e;border:1px solid #fff;margin-top: -0.5em"><i
                                    class="la la-street-view" style="color: #fff"></i></button>
                        </a></li>
                    @endif
                    <li class="dropdown dropdown-user nav-item"><a class="dropdown-toggle nav-link dropdown-user-link"
                            href="#" data-toggle="dropdown">
                            <span class="avatar avatar-online"><img src="{{asset('UI/images/backgrounds/MTN.png')}}"
                                    alt="avatar"><i></i></span></a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <div class="arrow_box_right">
                                <a class="dropdown-item" href="#"><span class="avatar avatar-online">
                                        <span class="user-name text-bold-700 ml-1">
                                            {{ auth()->user()->full_name }}
                                        </span></span>
                                </a>
                                <div class="dropdown-divider"></div>

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
            <li class="nav-item mr-auto"><a class="navbar-brand" href="#"><img class="brand-logo"
                        alt="MTN" src="{{asset('UI/images/backgrounds/MTN.png')}}" />
                    <p class="brand-text"
                        style="font-size: 0.9em; color: #ffc423;font-family: MTNBrighterSans-Regular !important;">MTN
                        Business Manager</p>
                </a></li>
            <li class="nav-item d-md-none"><a class="nav-link close-navbar"><i class="ft-x"></i></a></li>
        </ul>
    </div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">

            {{-- Dashboard --}}
            <li id="_dashboard" class="{{ preg_match('/dashboard/', $route) ? 'active nav-item' : '' }}">
                <a href="{{ route('admin.dashboard') }}"><i class="ft-bar-chart-2"></i><span class="menu-title"
                        style="font-family: MTNBrighterSans-Regular !important;">Dashboard</span></a>
            </li>

            {{-- Users --}}
            <li id="_dashboard" class="{{ preg_match('/users/', $route) ? 'active nav-item' : '' }}">
                <a href="{{ route('admin.user.index') }}"><i class="ft-bar-chart-2"></i><span class="menu-title"
                        style="font-family: MTNBrighterSans-Regular !important;">Users</span></a>
            </li>

            {{-- Advertisment --}}
            <li id="_dashboard" class="{{ preg_match('/advert/', $route) ? 'active nav-item' : '' }}">
                <a href="{{ route('admin.advert.index') }}"><i class="ft-bar-chart-2"></i><span class="menu-title"
                        style="font-family: MTNBrighterSans-Regular !important;">Advertisment</span></a>
            </li>

            {{-- Subscriptions Module --}}
            <li id="_subscription" class="{{ preg_match('/subscription/', $route) ? 'active nav-item' : '' }}">
                <a style="font-family: MTNBrighterSans-Regular !important;" href="#">
                    <i class="la la-cubes"></i><span class="menu-title" data-i18n="">
                        Subscriptions
                    </span>
                </a>
                <ul class="submenu-angle" aria-expanded="false">
                    <li class="{{ preg_match('/subscription.plans/', $route) ? 'active' : '' }}">
                        <a title="Business" href="{{ route('admin.subscription.plan.index') }}"><span
                                class="mini-sub-pro"
                                style="font-family: MTNBrighterSans-Regular !important;">Setup</span>
                        </a>
                    </li>
                    <li class="{{ preg_match('/subscription.payment.*/', $route) ? 'active' : '' }}">
                        <a title="Business" href="{{ route('admin.subscription.payment.index') }}"><span
                                class="mini-sub-pro"
                                style="font-family: MTNBrighterSans-Regular !important;">Payments</span>
                        </a>
                    </li>
                </ul>
            </li>

            {{-- Businesses --}}
            <li id="_dashboard" class="{{ preg_match('/business/', $route) ? 'active nav-item' : '' }}">
                <a href="{{ route('admin.business.index') }}"><i class="ft-bar-chart-2"></i><span class="menu-title"
                        style="font-family: MTNBrighterSans-Regular !important;">Businesses</span>
                </a>
            </li>

            {{-- Customer Support Module --}}
            <li id="_faqs" class="{{ preg_match('/customer_support/', $route) ? 'active nav-item' : '' }}">
                <a style="font-family: MTNBrighterSans-Regular !important;" href="#">
                    <i class="la la-info"></i><span class="menu-title" data-i18n="">
                        Customer Support
                    </span>
                </a>
                <ul class="submenu-angle" aria-expanded="false">
                    <li class="{{ preg_match('/customer_support.faq.*/', $route) ? 'active' : '' }}">
                        <a title="Frequently Asked Questions"
                            href="{{ route('admin.customer_support.faq.index') }}"><span class="mini-sub-pro"
                                style="font-family: MTNBrighterSans-Regular !important;">FAQs</span>
                        </a>
                    </li>
                    <li class="{{ preg_match('/customer_support.feedback.*/', $route) ? 'active' : '' }}">
                        <a title="Customer feedbacks/complaints"
                            href="{{ route('admin.customer_support.feedback.index') }}"><span class="mini-sub-pro"
                                style="font-family: MTNBrighterSans-Regular !important;">Feedbacks</span>
                        </a>
                    </li>
                </ul>
            </li>

            {{-- Reports Module --}}
            <li id="_subscription" class="{{ preg_match('/report/', $route) ? 'active nav-item' : '' }}">
                <a style="font-family: MTNBrighterSans-Regular !important;" href="#">
                    <i class="la la-cubes"></i><span class="menu-title" data-i18n="">
                        Reports
                    </span>
                </a>
                <ul class="submenu-angle" aria-expanded="false">
                    <li class="{{ preg_match('/report.advert/', $route) ? 'active' : '' }}">
                        <a title="Adverts Report" href="{{ route('admin.reports.advert') }}"><span class="mini-sub-pro"
                                style="font-family: MTNBrighterSans-Regular !important;">Adverts</span>
                        </a>
                    </li>
                    <li class="{{ preg_match('/report.advert/', $route) ? 'active' : '' }}">
                        <a title="Subscription Payments" href="{{ route('admin.reports.subscription_payment') }}"><span class="mini-sub-pro"
                                style="font-family: MTNBrighterSans-Regular !important;">Subscription Payments</span>
                        </a>
                    </li>
                    <li class="{{ preg_match('/report.feedback/', $route) ? 'active' : '' }}">
                        <a title="Feedback Reports" href="{{ route('admin.reports.feedback') }}"><span class="mini-sub-pro"
                                style="font-family: MTNBrighterSans-Regular !important;">Feedback</span>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>

    </div>

    <div class="navigation-background"></div>
</div>
