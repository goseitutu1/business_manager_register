<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Our new innovation for SME's">
    <meta name="keywords" content="Our new innovation for SME's">
    <meta name="author" content="Frederick Amoako-Atta">
    <title>MTN Business Manager Lite</title>
    <link rel="apple-touch-icon" href="{{asset('UI/images/backgrounds/MTN.png')}}">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('UI/images/backgrounds/MTN.png')}}">
    <link href="https://maxcdn.icons8.com/fonts/line-awesome/1.1/css/line-awesome.min.css" rel="stylesheet">

    <!-- BEGIN VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('UI/css/vendors.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('UI/vendors/css/charts/chartist.css')}}">
    <!-- END VENDOR CSS-->

    <!-- BEGIN CHAMELEON  CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('UI/css/app-lite.css')}}">
    <!-- END CHAMELEON  CSS-->
    <!-- BEGIN Page Level CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('UI/css/core/menu/menu-types/vertical-menu.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('UI/css/core/colors/palette-gradient.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('UI/css/pages/dashboard-ecommerce.css')}}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="{{ asset('js/jsgrid/jsgrid.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('js/jsgrid/jsgrid-theme.min.css') }}"/>

    <link rel="stylesheet" href="{{ asset('css/select2.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/select2-bootstrap.min.css') }}"/>

    {{--    <link rel="stylesheet" href="{{ asset('UI/js/scripts/walkthrough/introjs.min.css')}}"/>--}}
    {{--    <link rel="stylesheet" href="{{ asset('UI/js/scripts/walkthrough/introjs-modern.css')}}"/>--}}
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tour/0.12.0/css/bootstrap-tour-standalone.css">

    <style>
        @font-face {
            font-family: "MTNBrighterSans-Regular";
            src: url("{{asset('UI/fonts/MTNBrighterSans-Regular.ttf')}}");
        }
    </style>

    @stack('styles')
</head>

<body class="vertical-layout vertical-menu 2-columns  menu-expanded fixed-navbar" data-open="click"
      data-menu="vertical-menu" data-color="bg-chartbg" data-col="2-columns"
      style="background-color: #fff; font-family: 'MTNBrighterSans-Regular'!important;">


@include('UI_new.navigation')

<div class="app-content content" style="font-family: 'MTNBrighterSans-Regular' !important;">
    <div class="content-wrapper">
        <div class="content-wrapper-before"
             style="background-image: url({{asset('UI/images/backgrounds/dash05.jpg')}}) !important;background-size: cover">
        </div>
        <div class="content-header row">
        </div>
        @section('flash-message')
            <div class="flash-message">
                @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                    @if(Session::has('alert-' . $msg))
                        <p class="alert alert-{{ $msg }}">
                            {{ Session::get('alert-' . $msg) }}
                        </p>
                    @endif
                @endforeach
            </div>
            <div>
                @if (!is_array($errors))
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                @endif
            </div>
        @show

        @yield('content')

    </div>
</div>

<footer class="footer footer-static footer-light navbar-border navbar-shadow">
    <div class="clearfix blue-grey lighten-2 text-sm-center mb-0 px-2"><span
            class="float-md-left d-block d-md-inline-block">
                    <script type="text/javascript">
                        document.write(new Date().getFullYear());
                    </script> &copy; Powered by <a style="color: #1a237e" class="text-bold-800 grey darken-2"
                                                   href="https://npontu.com" target="_blank">Npontu Technologies Ltd</a>
                </span>
        <ul class="list-inline float-md-right d-block d-md-inline-blockd-none d-lg-block mb-0">
        </ul>
    </div>
</footer>

@include('UI_new.sub_menu')


<!-- BEGIN VENDOR JS-->
<script src="{{asset('UI/vendors/js/vendors.min.js')}}" type="text/javascript"></script>
<!-- BEGIN VENDOR JS-->
<!-- BEGIN PAGE VENDOR JS-->
<script src="{{asset('UI/vendors/js/charts/chartist.min.js')}}" type="text/javascript"></script>
<!-- END PAGE VENDOR JS-->
<!-- BEGIN CHAMELEON  JS-->
<script src="{{asset('UI/js/core/app-menu-lite.js')}}" type="text/javascript"></script>
<script src="{{asset('UI/js/core/app-lite.js')}}" type="text/javascript"></script>
<!-- END CHAMELEON  JS-->
<!-- BEGIN PAGE LEVEL JS-->
<script src="{{asset('UI/js/scripts/pages/dashboard-lite.js')}}" type="text/javascript"></script>
<!-- END PAGE LEVEL JS-->
<script src="{{asset('UI/vendors/js/charts/chart.min.js')}}" type="text/javascript"></script>

{{--<script src="{{asset('UI/js/scripts/charts/chartjs/line/line.js')}}" type="text/javascript"></script>--}}

<script src="{{ asset('js/all.js') }}"></script>

<script src="{{ asset('js/app.js') }}"></script>

<script src="{{ asset('vendor/datatables/buttons.server-side.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/jsgrid/jsgrid.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/jsgrid/jsgrid.custom.js') }}"></script>

<script src="{{ asset('vendor/datatables/buttons.server-side.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/jsgrid/jsgrid.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/jsgrid/jsgrid.custom.js') }}"></script>
<script src="{{ asset('js/select2.min.js') }}"></script>
<script src="{{ asset('js/customer.js') }}"></script>
{{--<script type="text/javascript" src="{{ asset('UI/js/scripts/walkthrough/intro.min.js') }}"></script>--}}
<script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tour/0.12.0/js/bootstrap-tour-standalone.js"></script>


@stack('scripts')

<script>
    $('.card-title').css('font-family', 'MTNBrighterSans-Regular');

    $('.heading-elements').css('display', 'none');

    $(document).ready(function () {
        $('#walk').on('click', function () {
            // Instance the tour
            var tour = new Tour({
                backdrop: false,
                steps: [
                    {
                        element: "#_home",
                        title: "Home",
                        content: "Here, the business is able to view paid adverts of other businesses, review FAQs on the MTN Business " +
                            "Application and make compliant requests via the feedback/support section."
                    },
                    {
                        element: "#_dashboard",
                        title: "Dashboard",
                        content: "A business dashboard is an information management tool that is used to track performance " +
                            "metrics and other key data points relevant to a business, department or specific process. Through " +
                            "the use of data visualizations dashboards simplify complex data sets to provide users with at a glance awareness" +
                            " of current performance."
                    },
                    {
                        element: "#_accountmanager",
                        title: "Account Manager",
                        content: "Accounting Manager responsibilities include:\n" +
                            "•\tManaging and overseeing the daily operations of the accounting department.\n" +
                            "•\tMonitoring and analyzing accounting data and produce financial reports or statements"
                    },
                    {
                        element: "#_inventory",
                        title: "Inventory",
                        content: "Inventory is the goods and materials that a business holds for the goal of resale (or repair). Inventory " +
                            "management is a discipline primarily about specifying the shape and placement of stocked goods. It is required at " +
                            "different locations within a facility or within many locations of a supply network to precede the regular and planned " +
                            "course of production and stock of materials."
                    },
                    {
                        element: "#_sales",
                        title: "Sales Manager",
                        content: "In accounting, sales refer to a company's revenue earned from the sales of products or services (net sales). " +
                            "In general business operations, sales refer to any transaction where money or value is exchanged for the ownership " +
                            "of a good or entitlement to a service."
                    },
                    {
                        element: "#_expense",
                        title: "Expense Manager",
                        content: "Expense management refers to the systems deployed by a business to process, pay, and audit employee-initiated\n" +
                            "                expenses. These costs include, but are not limited to, expenses incurred for travel and entertainment."
                    },
                    {
                        element: "#_customer",
                        title: "Customer Manager",
                        content: "A customer is a person or company that receives, consumes or buys a product or service and can choose between different goods and suppliers."
                    },
                    {
                        element: "#_employee",
                        title: "Employee",
                        content: "Employee management is both an individual and team consideration. Here, the business identifies the right " +
                            "people to perform certain tasks and duties within the business. Employees are your most valuable assets, however, " +
                            "getting the management right is key."
                    },
                    {
                        element: "#_suppliers",
                        title: "Suppliers",
                        content: "Suppliers management seeks to manage the host of vendor businesses that ensures the competitive advantage " +
                            "of the company in the long run. Oversight and management of suppliers and their contributions to a company's " +
                            "operations should always be of paramount importance."
                    },
                    {
                        element: "#_general",
                        title: "General",
                        content: "Suppliers management seeks to manage the host of vendor businesses that ensures the competitive advantage " +
                            "of the company in the long run. Oversight and management of suppliers and their contributions to a company's " +
                            "operations should always be of paramount importance."
                    },
                    {
                        element: "#_subscription",
                        title: "Subscription",
                        content: "Suppliers management seeks to manage the host of vendor businesses that ensures the competitive advantage " +
                            "of the company in the long run. Oversight and management of suppliers and their contributions to a company's " +
                            "operations should always be of paramount importance."
                    }

                ]
            });

            tour.init();
            tour.start();
        });
        localStorage.clear();
    });
</script>
</body>

</html>
