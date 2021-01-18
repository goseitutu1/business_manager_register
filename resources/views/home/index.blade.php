@extends('UI_new.master')

@push('styles')
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.2.1/assets/owl.carousel.css'>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.2.1/assets/owl.theme.default.css'>
<style>

    img {
        max-width: 100%;
        height: auto;
        vertical-align: bottom;
    }

    .owl-carousel {
        position: relative;
        margin-top: 30px;
    }
    .owl-nav {
        position: absolute;
        top: -60px;
        left: 10px;
    }
    .uk-card-primary {
        border-radius: 8px;
    }
    h3 {
        margin-top: 10px
    }
    .uk-card > :last-child {
        margin-top:0;
        margin-bottom: 10px
    }
    p {
        margin-top: 30px;
        margin-bottom: 0;
    }
    .owl-next {
        background: #3286f0;
    }
    .owl-theme .owl-nav [class*='owl-'] {
        background: #383838;
    }
    .owl-dots {
        margin-top: 30px;
    }
    .uk-card-title {
        padding-bottom: 20px
    }
    .modal-backdrop
    {
        opacity:0.3 !important;
        background-color: #212121;

    }
</style>
@endpush
@section('content')
    <div class="content-body" style="margin-top: 3em">

{{--        <div class="card">--}}
{{--            <!--Carousel-->--}}
{{--            <div class="bd-example">--}}
{{--                <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">--}}

{{--                    <ol class="carousel-indicators">--}}
{{--                        @foreach($adverts as $value)--}}
{{--                            <li data-target=".carouselExampleCaptions" data-slide-to="{{ $loop->index }}" class="{{ $loop->first ? 'active' : '' }}"></li>--}}
{{--                        @endforeach--}}
{{--                    </ol>--}}
{{--                    <div class="carousel-inner">--}}
{{--                        @foreach( $adverts as $value )--}}
{{--                            <div class="carousel-item {{ $loop->first ? 'active' : '' }}">--}}
{{--                                <img src="{{ is_null($value->feature_image) ? asset('UI/images/backgrounds/dash.jpg') : asset('adverts/'.$value->feature_image) }}" class="d-block w-100" alt="...">--}}
{{--                                <div class="carousel-caption d-none d-md-block">--}}
{{--                                    <h5>{{$value->title}}</h5>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        @endforeach--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <!--Carousel-->--}}
{{--            <div class="card-footer border-top-blue-grey border-top-lighten-5 text-muted">--}}
{{--                <span class="float-left">MTN Business Manager Lite</span>--}}
{{--                <span class="tags float-right">--}}
{{--                    <a href="{{ route('advert.create') }}" style="color: #fff" class="btn btn-icon btn-primary" data-toggle="tooltip" data-placement="top" title="Create Advert"><i class="la la-plus"></i></a>--}}
{{--                    <a href="{{ route('advert.index') }}" style="color: #fff" class="btn btn-icon btn-success" data-toggle="tooltip" data-placement="top" title="All Adverts"><i class="la la-eye"></i></a>--}}
{{--                </span>--}}
{{--            </div>--}}
{{--        </div>--}}

        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-4">
                       <span>
                            <i class="fa fa-envelope-o"></i> Email : <a href="mailto:mtnbusinessmanager.gh@mtn.com">mtnbusinessmanager.gh@mtn.com</a>
                       </span>
                    </div>

                    <div class="col-lg-4">
                          <span>
                            <i class="fa fa-phone"></i> Call : +233 24 430 8111 / 100
                       </span>
                    </div>

                    <div class="col-lg-4">

                    </div>

                </div>
            </div>
        </div>

        <div class="uk-margin" style="margin-top: 8em"></div>
        <div class="uk-section"><div class="owl-carousel owl-theme">
                <div class="card" style="background-image: url({{asset('UI/images/backgrounds/mtn_m01.jpg')}});background-size: cover">
                    <div class="card-body">
                       <br>
                       <br>
                       <br>
                        <p style="font-size: 1.4em;color:#fff">Dashboard</p>
                        <button data-toggle="modal" data-target="#exampleModal" class="btn btn-primary" style="border-color: transparent;border-radius: 3em;background-color: #ffc107">Read info</button>
                    </div>
                </div>


                <div class="card">
                    <div class="card-body" style="background-image: url({{asset('UI/images/backgrounds/mtn_m02.jpg')}});background-size: cover">
                        <br>
                        <br>
                        <br>
                        <p style="font-size: 1.4em;color:#fff">Account Manager</p>
                        <button data-toggle="modal" data-target="#exampleModal2" class="btn btn-primary" style="border-color: transparent;border-radius: 3em;background-color: #ffc107">Read info</button>
                    </div>
                </div>

                <div class="card" style="background-image: url({{asset('UI/images/backgrounds/mtn_m03.jpg')}});background-size: cover">
                    <div class="card-body">
                        <br>
                        <br>
                        <br>
                        <p style="font-size: 1.4em;color:#fff">Sales Manager</p>
                        <button data-toggle="modal" data-target="#exampleModal3" class="btn btn-primary" style="border-color: transparent;border-radius: 3em;background-color: #ffc107">Read info</button>
                    </div>
                </div>


                <div class="card" style="background-image: url({{asset('UI/images/backgrounds/mtn_m04.jpg')}});background-size: cover">
                    <div class="card-body">
                        <br>
                        <br>
                        <br>
                        <p style="font-size: 1.4em;color:#fff">Inventory</p>
                        <button data-toggle="modal" data-target="#exampleModal4" class="btn btn-primary" style="border-color: transparent;border-radius: 3em;background-color: #ffc107">Read info</button>
                    </div>
                </div>


                <div class="card" style="background-image: url({{asset('UI/images/backgrounds/mtn_m05.jpg')}});background-size: cover">
                    <div class="card-body">
                        <br>
                        <br>
                        <br>
                        <p style="font-size: 1.4em;color:#fff">Expense Manager</p>
                        <button data-toggle="modal" data-target="#exampleModal5" class="btn btn-primary" style="border-color: transparent;border-radius: 3em;background-color: #ffc107">Read info</button>
                    </div>
                </div>


                <div class="card" style="background-image: url({{asset('UI/images/backgrounds/mtn_m06.jpg')}});background-size: cover">
                    <div class="card-body">
                        <br>
                        <br>
                        <br>
                        <p style="font-size: 1.4em;color:#fff">Supplier Manager</p>
                        <button data-toggle="modal" data-target="#exampleModal6" class="btn btn-primary" style="border-color: transparent;border-radius: 3em;background-color: #ffc107">Read info</button>
                    </div>
                </div>


                <div class="card" style="background-image: url({{asset('UI/images/backgrounds/mtn_m07.jpg')}});background-size: cover">
                    <div class="card-body">
                        <br>
                        <br>
                        <br>
                        <p style="font-size: 1.4em;color:#fff">Customer Manager</p>
                        <button data-toggle="modal" data-target="#exampleModal7" class="btn btn-primary" style="border-color: transparent;border-radius: 3em;background-color: #ffc107">Read info</button>
                    </div>
                </div>


                <div class="card" style="background-image: url({{asset('UI/images/backgrounds/mtn_m08.jpg')}});background-size: cover">
                    <div class="card-body">
                        <br>
                        <br>
                        <br>
                        <p style="font-size: 1.4em;color:#fff">Employee Manager</p>
                        <button data-toggle="modal" data-target="#exampleModal8" class="btn btn-primary" style="border-color: transparent;border-radius: 3em;background-color: #ffc107">Read info</button>
                    </div>
                </div>


                <div class="card" style="background-image: url({{asset('UI/images/backgrounds/mtn_m09.jpg')}});background-size: cover">
                    <div class="card-body">
                        <br>
                        <br>
                        <br>
                        <p style="font-size: 1.4em;color:#fff">Subscription Module</p>
                        <button data-toggle="modal" data-target="#exampleModal9" class="btn btn-primary" style="border-color: transparent;border-radius: 3em;background-color: #ffc107">Read info</button>
                    </div>
                </div>


            </div>
        </div>




        <section id="header-footer">
            <div class="row match-height">
                <div class="col-lg-4 col-md-12">
                    <a href="https://www.mtn.com.gh/" target="_blank">
                    <div class="card" id="mycard">
                        <div class="card-footer border-top-blue-grey border-top-lighten-5 text-muted">
                            <span class="float-left">Visit MTN Gh</span>
                            <span class="float-right"><i class="la la-arrow-circle-o-right"></i></span>
                        </div>
                        <img class="" src="{{asset('UI/images/backgrounds/website.jpg')}}" alt="Card image cap">
                    </div>
                    </a>
                </div>


                <div class="col-lg-4 col-md-12">
                    <a href="{{ route('customer_support.feedback.index') }}">
                    <div class="card">
                        <div class="card-footer border-top-blue-grey border-top-lighten-5 text-muted">
                            <span class="float-left">Feedback/Support</span>
                            <span class="float-right"><i class="la la-arrow-circle-o-right"></i></span>
                        </div>
                        <img class="" src="{{asset('UI/images/backgrounds/support.jpg')}}" alt="Card image cap">
                    </div>
                    </a>
                </div>


                <div class="col-lg-4 col-md-12">
                    <a href="{{route('customer_support.faq')}}">
                    <div class="card">
                        <div class="card-footer border-top-blue-grey border-top-lighten-5 text-muted">
                            <span class="float-left">Frequently Asked (FAQ's)</span>
                            <span class="float-right"><i class="la la-arrow-circle-o-right"></i></span>
                        </div>
                        <img class="" src="{{asset('UI/images/backgrounds/FAQ.jpg')}}" alt="Card image cap">
                    </div>
                    </a>
                </div>
            </div>
        </section>



        {{--    Dashboard--}}
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Dashboard</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        The dashboard enables the user track performance metrics and other key data points relevant to a business. The data visualizations provided on the dashboard simplifies complex data sets, thus, providing users with at a glance awareness of current performance and a 360 view on the business health and growth.
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>



        {{--    Account Manager--}}
        <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Account Manager</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        The account manager gives insight on financial activities such as procurement, utilization of funds and sales of the business. This feature provides reporting on information related to profitability, expenses, cash and credit, so the business can make decisions and carry out its objectives as satisfactorily as possible.
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>




        {{--    Sales Manager--}}
        <div class="modal fade" id="exampleModal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Sales Manager</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Efficient monitoring of sale activities enables business make informed decisions on their clients, and market at large. The sales manager records all sale transactions related to a service or a product, ensuring all revenue is accounted for.
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>



        {{--    Inventory--}}
        <div class="modal fade" id="exampleModal4" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Inventory</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        With the right parameters set, the inventory manager ensures inventory items are at the right levels, in the right place, at the right time, and at the right cost as well as price. The inventory management feature provides the necessary supervision of non-capitalized assets and stock items, thus, monitoring the flow of goods from the warehouse or point of storage to the point of sale.
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>



        {{--    Expense Manager--}}
        <div class="modal fade" id="exampleModal5" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Expense Manager</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Analysing overall expenses, identifying cost saving opportunities and controlling excessive spending became a lot easier with the expense manager. The integration of an easy-to-use reporting tool and increased visibility provides the business with the necessary information to process, pay and audit their business spend.
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>


        {{--    Suppiler Manager--}}
        <div class="modal fade" id="exampleModal6" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Supplier Manager</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Suppliers management seeks to manage the host of vendor businesses that ensures the competitive advantage of the company in the long run. Oversight and management of suppliers and their contributions to a company's operations should always be of paramount importance.
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>



        {{--    Customer Manager--}}
        <div class="modal fade" id="exampleModal7" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Customer Manager</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        A customer is priority, and with the MTN business manager the business is able to effectively track its relationship with past and current clients. Using the analysed data about the customer’s purchase history the business is able to make informed decisions to drive the right sales growth and ultimately ensure customer retention
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>


        {{--    Employee Manager--}}
        <div class="modal fade" id="exampleModal8" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Employee Manager</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Employee management is both an individual and team consideration. This feature enables businesses store key employee details, and also allows businesses assign the right user assesses to certain selected individuals to perform certain tasks and duties within the business. Employees are your most valuable assets, however, getting the management right is key.
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>


        {{--    Subscription Module--}}
        <div class="modal fade" id="exampleModal9" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Subscription Module</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Suppliers management seeks to manage the host of vendor businesses that ensures the competitive advantage of the company in the long run. Oversight and management of suppliers and their contributions to a company's operations should always be of paramount importance.
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

    </div>







@endsection

@push('scripts')
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.0-beta.40/js/uikit.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.0-beta.40/js/uikit-icons.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.2.1/owl.carousel.js'></script>
    <script>
        $(document).ready(function () {
            $( ".card" ).hover(
                function() {
                    $(this).addClass('shadow-lg').css('cursor', 'pointer');
                }, function() {
                    $(this).removeClass('shadow-lg');
                }
            );
        });

        $('.owl-carousel').owlCarousel({
            loop:false,
            stagePadding: 15,
            margin:10,
            nav:true,
            navText : ['<span class="uk-margin-small-right uk-icon" uk-icon="icon: chevron-left"></span>','<span class="uk-margin-small-left uk-icon" uk-icon="icon: chevron-right"></span>'],
            responsive:{
                0:{
                    items:1
                },
                640:{
                    items:2
                },
                960:{
                    items:3
                },
                1200:{
                    items:4
                }
            }
        })
    </script>
@endpush
