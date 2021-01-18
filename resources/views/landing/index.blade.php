<!DOCTYPE html>
<!--[if lt IE 9 ]><html class="no-js oldie" lang="en"> <![endif]-->
<!--[if IE 9 ]><html class="no-js oldie ie9" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html class="no-js" lang="en">
<!--<![endif]-->

<head>

    <!--- basic page needs
   ================================================== -->
    <meta charset="utf-8">
    <title>xMTN Business Manager Lite</title>
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- mobile specific metas
   ================================================== -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('UI/images/backgrounds/MTN.png')}}">

    <!-- CSS
   ================================================== -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('UI/landing/css/base.css')}}">
    <link rel="stylesheet" href="{{asset('UI/landing/css/vendor.css')}}">
    <link rel="stylesheet" href="{{asset('UI/landing/css/main.css')}}">
    <style>
        @font-face {
            font-family: "MTNBrighterSans-Regular";
            src: url("{{asset('UI/fonts/MTNBrighterSans-Regular.ttf')}}");
        }
    </style>

    <!-- favicons
	================================================== -->
{{--    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">--}}
{{--    <link rel="icon" href="favicon.ico" type="image/x-icon">--}}

</head>

<body id="top" style="font-family: MTNBrighterSans-Regular !important;">

    <!-- header
   ================================================== -->
   <header id="header" class="row">

   		<div>
	        <a href="#"><img src="{{asset('UI/landing/images/MTN.png')}}" style="width: 5em"></a>
	    </div>

	   	<nav id="header-nav-wrap">
			<ul class="header-main-nav">
				<li class="current"><a class="smoothscroll"  href="#home" title="home">Home</a></li>
                <li><a class="smoothscroll"  href="#about" title="about">About</a></li>
                <li><a class="smoothscroll"  href="#modules" title="Modules">Modules</a></li>
                <li><a class="smoothscroll"  href="#pricing" title="pricing">Pricing</a></li>
				<li><a class="smoothscroll"  href="#download" title="download">Download</a></li>
			</ul>

            <a href="{{route('register')}}" title="sign-up" class="button button-warning cta" style="background-color: #ffc107">Sign Up</a>
            <a href="{{route('login')}}" title=login class="button button-warning cta" style="background-color: #fff;border-color: #ffc107">Login</a>
        </nav>

		<a class="header-menu-toggle" href="#"><span>Menu</span></a>

   </header> <!-- /header -->


   <!-- home
   ================================================== -->
   <section id="home" data-parallax="scroll" data-image-src="{{asset('UI/landing/images/MTN_Back02.jpg')}}">

        <div class="overlay"></div>
        <div class="home-content">

            <div class="row contents">
                <div class="home-content-left">

                    <h3 data-aos="fade-up">Welcome to </h3>

                    <h1 data-aos="fade-up">
                        MTN Business <br>
                        Manager Lite<br>
                    </h1>

                    <div class="buttons" data-aos="fade-up">
                        <a href="#download" class="smoothscroll button stroke">
                            <span class="icon-circle-down" aria-hidden="true"></span>
                            Download App
                        </a>
                        <button style="background-color:#ffc107;border-color:#fff " data-toggle="modal" data-target="#exampleModal">
                            <span class="icon-phone" aria-hidden="true"></span>
                            Contact Us
                        </button>
<!--                        <a href="http://player.vimeo.com/video/14592941?title=0&amp;byline=0&amp;portrait=0&amp;color=39b54a" data-lity class="button stroke">-->
<!--                        <span class="icon-play" aria-hidden="true"></span>-->
<!--                        Watch Video-->
<!--                    </a>-->
                    </div>

                </div>

<!--                <div class="home-image-right">-->
                    <img src="{{asset('UI/landing/images/MTN-470.png')}}" style="width: 120em;margin-bottom: -4em" data-aos="fade-up">
<!--                </div>-->
            </div>

        </div> <!-- end home-content -->

        <ul class="home-social-list">
            <li>
                <a href="https://web.facebook.com/MTNGhana"><i class="fa fa-facebook-square"></i></a>
            </li>
            <li>
                <a href="https://twitter.com/MTNBusinessGh"><i class="fa fa-twitter"></i></a>
            </li>
            <li>
                <a href="https://www.linkedin.com/company/mtn-ghana/"><i class="fa fa-linkedin-square"></i></a>
            </li>
            <li>
                <a href="https://www.instagram.com/mtnghana/"><i class="fa fa-instagram"></i></a>
            </li>
            <li>
                <a href="https://www.youtube.com/user/mtnghana"><i class="fa fa-youtube-play"></i></a>
            </li>
        </ul>
        <!-- end home-social-list -->

        <div class="home-scrolldown">
            <a href="#about" class="scroll-icon smoothscroll">
                <span>Scroll Down</span>
                <i class="icon-arrow-right" aria-hidden="true"></i>
            </a>
        </div>

    </section> <!-- end home -->


    <!-- about
    ================================================== -->
    <section id="about" style="background-color: #212121">

        <div class="row about-intro">

            <div class="col-four">
                <h1 class="intro-header" data-aos="fade-up" style="color: #ffc107">About Our App</h1>
            </div>
            <div class="col-eight">
                <p class="lead" data-aos="fade-up" style="color: #fff;">
                    The MTN Business Manager is a web and mobile application platform equipped to manage daily operations of small and medium scale enterprises. Capitalising on providing easy access to its users, it also enables quick decision making as it offers mobility and synchronicity across its functions both on web and mobile.
                    As a value added proposition, the MTN Business Manager enables small and medium enterprises benefit from modern and effective ways of transacting business. Making accessible convenient methods for sale payment, increase customer retention. And drive revenue growth
            </div>
        </div>
    </section> <!-- end about -->


<section id="modules" style="background-color: #fff !important;">
    <div class="row about-features">

        <div class="features-list block-1-3 block-m-1-2 block-mob-full group">

            <div class="bgrid feature" data-aos="fade-up">

                <span class="icon"><i class="icon-window"></i></span>

                <div class="service-content">

                    <h3>Dashboard</h3>

                    <p>The dashboard enables the user track performance metrics and other key data points relevant to a business. The data visualizations provided on the dashboard simplifies complex data sets, thus, providing users with at a glance awareness of current performance and a 360 view on the business health and growth.
                    </p>

                </div>

            </div> <!-- /bgrid -->

            <div class="bgrid feature" data-aos="fade-up">

                <span class="icon"><i class="icon-pie-chart"></i></span>

                <div class="service-content">
                    <h3>Account Manager</h3>

                    <p>The account manager gives insight on financial activities such as procurement, utilization of funds and sales of the business. This feature provides reporting on information related to profitability, expenses, cash and credit, so the business can make decisions and carry out its objectives as satisfactorily as possible.
                    </p>

                </div>

            </div> <!-- /bgrid -->

            <div class="bgrid feature" data-aos="fade-up">

                <span class="icon"><i class="fa fa-money"></i></span>

                <div class="service-content">
                    <h3>Sales Manager </h3>

                    <p>Efficient monitoring of sale activities enables business make informed decisions on their clients, and market at large. The sales manager records all sale transactions related to a service or a product, ensuring all revenue is accounted for.
                    </p>

                </div>

            </div> <!-- /bgrid -->

            <div class="bgrid feature" data-aos="fade-up">

                <span class="icon"><i class="icon-shopping-cart"></i></span>

                <div class="service-content">
                    <h3>Inventory</h3>

                    <p>With the right parameters set, the inventory manager ensures inventory items are at the right levels, in the right place, at the right time, and at the right cost as well as price. The inventory management feature provides the necessary supervision of non-capitalized assets and stock items, thus, monitoring the flow of goods from the warehouse or point of storage to the point of sale.
                    </p>

                </div>

            </div> <!-- /bgrid -->



            <div class="bgrid feature" data-aos="fade-up">

                <span class="icon"><i class="icon-sliders"></i></span>

                <div class="service-content">
                    <h3>Expense Manager </h3>

                    <p>Analysing overall expenses, identifying cost saving opportunities and controlling excessive spending became a lot easier with the expense manager. The integration of an easy-to-use reporting tool and increased visibility provides the business with the necessary information to process, pay and audit their business spend.
                    </p>
                </div>

            </div> <!-- /bgrid -->

            <div class="bgrid feature" data-aos="fade-up">

                <span class="icon"><i class="icon-truck"></i></span>

                <div class="service-content">
                    <h3>Supplier Manager </h3>

                    <p>Suppliers management seeks to manage the host of vendor businesses that ensures the competitive advantage of the company in the long run. Oversight and management of suppliers and their contributions to a company's operations should always be of paramount importance.
                    </p>

                </div>

            </div> <!-- /bgrid -->

            <div class="bgrid feature" data-aos="fade-up">

                <span class="icon"><i class="icon-user"></i></span>

                <div class="service-content">
                    <h3>Customer Manager </h3>

                    <p>A customer is priority, and with the MTN business manager the business is able to effectively track its relationship with past and current clients. Using the analysed data about the customer’s purchase history the business is able to make informed decisions to drive the right sales growth and ultimately ensure customer retention
                    </p>

                </div>

            </div> <!-- /bgrid -->


            <div class="bgrid feature" data-aos="fade-up">

                <span class="icon"><i class="icon-users"></i></span>

                <div class="service-content">
                    <h3>Employee Manager </h3>

                    <p>Employee management is both an individual and team consideration. This feature enables businesses store key employee details, and also allows businesses assign the right user assesses to certain selected individuals to perform certain tasks and duties within the business. Employees are your most valuable assets, however, getting the management right is key.
                    </p>

                </div>

            </div> <!-- /bgrid -->



        </div> <!-- end features-list -->

    </div> <!-- end about-features -->

    <div class="row about-bottom-image">

        <img src="{{asset('UI/landing/images/MTN_app_screen.jpg')}}" alt="App Screenshots" data-aos="fade-up">

    </div>  <!-- end about-bottom-image -->

</section>


    <!-- pricing
    ================================================== -->
    <section id="pricing">
        <div class="row pricing-content">

            <div class="col-twelve pricing-intro">
                <h1 class="intro-header" data-aos="fade-up">Our Packages</h1>

                <p data-aos="fade-up">Our packages for individuals and SMEs
                </p>
            </div>

            <div class="col-twelve pricing-table">
                <div class="row">

                    <div class="col-four plan-wrap">
                        <div class="plan-block" data-aos="fade-up">

                            <div class="plan-top-part">
                                <h3 class="plan-block-title">SoHo</h3>
                                <p class="plan-block-price"><sup>Ghc</sup>9.99</p>
                                <p class="plan-block-per">Per Month</p>
                            </div>

                            <div class="plan-bottom-part">
                                <ul class="plan-block-features">
                                    <li><span style="color: #0005af"><i class="fa fa-check"></i></span>1 - 2 Users across businesses</li>
                                    <li><span style="color: #0005af"><i class="fa fa-check"></i></span> Inventory Management</li>
                                    <li><span style="color: #0005af"><i class="fa fa-check"></i></span> Sales Management</li>
                                    <li><span style="color: #0005af"><i class="fa fa-check"></i></span> Expense Management</li>
                                    <li><span style="color: #0005af"><i class="fa fa-check"></i></span> Finance Management</li>
                                    <li><span style="color: #0005af"><i class="fa fa-check"></i></span> Customer Management</li>
                                    <li><span style="color: #0005af"><i class="fa fa-check"></i></span> Business & Human Resource Management</li>
                                </ul>

                                <a class="button button-primary large" href="{{route('register')}}">Get Started</a>
                            </div>

                        </div>
                    </div> <!-- end plan-wrap -->

                    <div class="col-four plan-wrap">
                        <div class="plan-block" data-aos="fade-up">

                            <div class="plan-top-part">
                                <h3 class="plan-block-title">Starter</h3>
                                <p class="plan-block-price"><sup>Ghc</sup>45</p>
                                <p class="plan-block-per">Per Month</p>
                            </div>

                            <div class="plan-bottom-part">
                                <ul class="plan-block-features">
                                    <li><span style="color: #0005af"><i class="fa fa-check"></i></span>1 - 5 Employees across businesses</li>
                                    <li><span style="color: #0005af"><i class="fa fa-check"></i></span> Inventory Management</li>
                                    <li><span style="color: #0005af"><i class="fa fa-check"></i></span> Sales Management</li>
                                    <li><span style="color: #0005af"><i class="fa fa-check"></i></span> Expense Management</li>
                                    <li><span style="color: #0005af"><i class="fa fa-check"></i></span> Finance Management</li>
                                    <li><span style="color: #0005af"><i class="fa fa-check"></i></span> Customer Management</li>
                                    <li><span style="color: #0005af"><i class="fa fa-check"></i></span> Business & Human Resource Management</li>
                                </ul>

                                <a class="button button-primary large" href="{{route('register')}}">Get Started</a>
                            </div>

                        </div>
                    </div> <!-- end plan-wrap -->

                    <div class="col-four plan-wrap">
                        <div class="plan-block primary" data-aos="fade-up" style="background-color: #ffc107">

                            <div class="plan-top-part">
                                <h3 class="plan-block-title" style="color:#212121">Regular</h3>
                                <p class="plan-block-price" style="color:#212121"><sup>Ghc</sup>70</p>
                                <p class="plan-block-per" style="color:#212121">Per Month</p>
                            </div>

                            <div class="plan-bottom-part">
                                <ul class="plan-block-features">
                                    <li style="color:#212121"><span style="color: #0005af"><i class="fa fa-check"></i></span>1 - 10 Employees across businesses</li>
                                    <li style="color:#212121"><span style="color: #0005af"><i class="fa fa-check"></i></span> Inventory Management</li>
                                    <li style="color:#212121"><span style="color: #0005af"><i class="fa fa-check"></i></span> Sales Management</li>
                                    <li style="color:#212121"><span style="color: #0005af"><i class="fa fa-check"></i></span> Expense Management</li>
                                    <li style="color:#212121"><span style="color: #0005af"><i class="fa fa-check"></i></span> Finance Management</li>
                                    <li style="color:#212121"><span style="color: #0005af"><i class="fa fa-check"></i></span> Customer Management</li>
                                    <li style="color:#212121"><span style="color: #0005af"><i class="fa fa-check"></i></span> Business & Human Resource Management</li>
                                </ul>

                                <a class="button button-primary large" href="{{route('register')}}">Get Started</a>
                            </div>

                        </div>
                    </div> <!-- end plan-wrap -->

                    <div class="col-four plan-wrap">
                        <div class="plan-block primary" data-aos="fade-up" style="background-color: #fff">

                            <div class="plan-top-part">
                                <h3 class="plan-block-title" style="color:#212121">Enterprise</h3>
                                <p class="plan-block-price" style="color:#212121"><sup>Ghc</sup>99</p>
                                <p class="plan-block-per" style="color:#212121">Per Month</p>
                            </div>

                            <div class="plan-bottom-part">
                                <ul class="plan-block-features">
                                    <li style="color:#212121"><span style="color: #0005af"><i class="fa fa-check"></i></span>1 - 20+ Employees across businesses</li>
                                    <li style="color:#212121"><span style="color: #0005af"><i class="fa fa-check"></i></span> Inventory Management</li>
                                    <li style="color:#212121"><span style="color: #0005af"><i class="fa fa-check"></i></span> Sales Management</li>
                                    <li style="color:#212121"><span style="color: #0005af"><i class="fa fa-check"></i></span> Expense Management</li>
                                    <li style="color:#212121"><span style="color: #0005af"><i class="fa fa-check"></i></span> Finance Management</li>
                                    <li style="color:#212121"><span style="color: #0005af"><i class="fa fa-check"></i></span> Customer Management</li>
                                    <li style="color:#212121"><span style="color: #0005af"><i class="fa fa-check"></i></span> Business & Human Resource Management</li>
                                </ul>

                                <a class="button button-danger large" href="{{route('register')}}">Get Started</a>
                            </div>

                        </div>
                    </div> <!-- end plan-wrap -->

                </div>
            </div> <!-- end pricing-table -->

        </div> <!-- end pricing-content -->
    </section>

    <!-- end pricing -->

    <!-- download
    ================================================== -->
    <section id="download" style="background-color : url({{asset('UI/landing/images/MTN_foot.jpg')}});background-size: cover;background-position: center;">

        <div class="row">
            <div class="col-full">
                <h1 class="intro-header"  data-aos="fade-up" style="color:#ffc107">Download Our App Today!</h1>
                <ul class="download-badges">
                    <li><a href="#" title="" class="badge-appstore"  data-aos="fade-up">App Store</a></li>
                    <li><a href="https://play.google.com/store/apps/details?id=com.mtn.businessmanagerlite" title="" class="badge-googleplay" data-aos="fade-up">Play Store</a></li>
                </ul>

            </div>
        </div>

    </section> <!-- end download -->


    <section id="about" style="background-color: #fff">

        <div class="row about-intro">

            <div class="col-four">
                <h1 class="intro-header" data-aos="fade-up" style="color: #ffc107">About Our Partner</h1>
                <img src="{{asset('UI/landing/images/npontu.png')}}"/>
            </div>
            <div class="col-eight">
                <p class="lead" data-aos="fade-up">
                    Trends that matter, Technology that redefines. Our quest is to help you focus on your main task whilst we shoulder getting you there using technology that matters. We provide solutions custom made for your unique challenges. We believe the most similar situations are unique even in their similarities. Under our 3 main service umbrellas: AI/Big Data, Platform and Mobile Apps, Value Added Service. We are well positioned to give you a comprehensive service. Call us!! lets plan your future Tech together!!
            </div>
        </div>
    </section> <!-- end about -->


    <!-- footer
    ================================================== -->
    <footer>

      <div class="footer-bottom">

      	<div class="row">

      		<div class="col-twelve">
	      		<div class="copyright">
                    <p class="text-white mb-3">Contact us on <a href="mailto:mtnbusinessmanager.gh@mtn.com">mtnbusinessmanager.gh@mtn.com</a> or call on 0244308111 / 100</p>
		         	<span>© Copyright MTN<script type="text/javascript">document.write(new Date().getFullYear());</script>.</span>
		         	<span>Crafted by <a href="https://npontu.com/" style="color:#ffc107">Npontu Technologies</a></span>
		         </div>

		         <div id="go-top">
		            <a class="smoothscroll" title="Back to Top" href="#top"><i class="icon-arrow-up"></i></a>
		         </div>
	      	</div>

      	</div> <!-- end footer-bottom -->

      </div>

    </footer>


    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Contact Information</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Contact us on <strong style="font-weight: bold; color:#212121">mtnbusinessmanager.gh@mtn.com</strong> and call on <strong style="font-weight: bold; color:#212121"> 0244308111 / 100</strong>
                </div>
                <div class="modal-footer">
{{--                    <button type="button"  class="btn btn-danger" data-dismiss="modal">Close</button>--}}
{{--                    <button type="button" class="btn btn-primary">Save changes</button>--}}
                </div>
            </div>
        </div>
    </div>



    <div id="preloader">
    	<div id="loader"></div>
    </div>

    <!-- Java Script
    ================================================== -->
    <!-- script
================================================== -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <script src="{{asset('UI/landing/js/modernizr.js')}}"></script>
    <script src="{{asset('UI/landing/js/pace.min.js')}}"></script>

    <script src="{{asset('UI/landing/js/jquery-2.1.3.min.js')}}"></script>
    <script src="{{asset('UI/landing/js/plugins.js')}}"></script>
    <script src="{{asset('UI/landing/js/main.js')}}"></script>

</body>

</html>
