@extends('site.layouts.app')
@section('site.title')
    @lang('site.home')
@endsection
@section('site.css')
    <link rel="stylesheet" href="{{ asset("site/css/bootstrap.min.css") }}">
    <link rel="stylesheet" href="{{ asset("site/css/style.css") }}">
    <link rel="stylesheet" href="{{ asset("site/css/responsive.css") }}">
    {{--<script src="http://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="http://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>--}}
@endsection
@section('site.content')
    <section class="about-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <div class="main-title text-center">
                        <h2>{{ $staticPage['title'][$currentLang] ?? null }}</h2>
                        <p>{{ $staticPage['text'][$currentLang] ?? null }}</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="about_thumb mb30-smd">
                        <img class="img-fluid w100" src="{{ asset("uploads/static-pages/".$staticPage['image']) }}" alt="1.jpg">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="about_content">
                        <p class="large">{!! $staticPage['full_text'][$currentLang] ?? null !!}</p>
                    </div>
                </div>
            </div>
            <div class="row mt50">
                <div class="col-md-8 col-lg-4">
                    <div class="funfact_one style2 text-center">
                        <div class="details">
                            <div class="timer">{{$companyCount}}</div>
                            <h4 class="ff_title">Bizim müştərilər</h4>
                        </div>
                    </div>
                </div>
                <div class="col-md-8 col-lg-4">
                    <div class="funfact_one style2 text-center">
                        <div class="details">
                            <div class="timer">{{$userCount}}</div>
                            <h4 class="ff_title">Bizim istifadəçilər</h4>
                        </div>
                    </div>
                </div>
                <div class="col-md-8 col-lg-4">
                    <div class="funfact_one style2 text-center">
                        <div class="details">
                            <div class="timer">{{$cityCount}}</div>
                            <h4 class="ff_title">Aktiv şəhərlər və regionlar</h4>
                        </div>
                    </div>
                </div>
                {{--<div class="col-md-6 col-lg-3">
                    <div class="funfact_one style2 text-center">
                        <div class="details">
                            <ul>
                                <li class="list-inline-item"><div class="timer">53</div></li>
                                <li class="list-inline-item"><span>K+</span></li>
                            </ul>
                            <h4 class="ff_title">Team members</h4>
                        </div>
                    </div>
                </div>--}}
            </div>
        </div>
    </section>

    {{--<!-- How It Works -->
    <section id="why-chose" class="whychose_us bgc-f7 pb70">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <div class="main-title text-center">
                        <h2>How it Works</h2>
                        <p>Bringing business and community members together.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-lg-4 col-xl-4">
                    <div class="why_chose_us">
                        <div class="icon">
                            <span class="flaticon-find-location"></span>
                        </div>
                        <div class="details">
                            <h4>Find Businesses</h4>
                            <p>Discover & connect with great local businesses in your local neighborhood like dentists, hair stylists and more.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 col-xl-4">
                    <div class="why_chose_us">
                        <div class="icon">
                            <span class="flaticon-comment"></span>
                        </div>
                        <div class="details">
                            <h4>Review Listings</h4>
                            <p>Discover & connect with great local businesses in your local neighborhood like dentists, hair stylists and more.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 col-xl-4">
                    <div class="why_chose_us">
                        <div class="icon">
                            <span class="flaticon-date"></span>
                        </div>
                        <div class="details">
                            <h4>Make a Reservation</h4>
                            <p>Discover & connect with great local businesses in your local neighborhood like dentists, hair stylists and more.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Our Testimonials -->
    <section class="our-testimonials">
        <div class="container ovh max1800">
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <div class="main-title text-center">
                        <h2>Testimonials From Our Customers</h2>
                        <p>Lorem ipsum dolor sit amet elit, sed do eiusmod tempor</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="testimonial_slider_home1">
                        <div class="item">
                            <div class="testimonial_post text-center">
                                <div class="thumb">
                                    <img src="{{ asset("site/images/testimonial/1.png") }}" alt="1.png">
                                    <h4 class="title">Alison Dawn</h4>
                                    <div class="client-postn">WordPress Developer</div>
                                </div>
                                <div class="details">
                                    <div class="icon"><span>“</span></div>
                                    <p>“ I believe in lifelong learning and Skola is a great place to learn from experts. I've learned a lot and recommend it to all my friends “</p>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="testimonial_post text-center">
                                <div class="thumb">
                                    <img src="{{ asset("site/images/testimonial/2.png") }}" alt="2.png">
                                    <h4 class="title">Albert Cole</h4>
                                    <div class="client-postn">Designer</div>
                                </div>
                                <div class="details">
                                    <div class="icon"><span>“</span></div>
                                    <p>“ I believe in lifelong learning and Skola is a great place to learn from experts. I've learned a lot and recommend it to all my friends “</p>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="testimonial_post text-center">
                                <div class="thumb">
                                    <img src="{{ asset("site/images/testimonial/3.png") }}" alt="3.png">
                                    <h4 class="title">Daniel Parker</h4>
                                    <div class="client-postn">Front-end Developer</div>
                                </div>
                                <div class="details">
                                    <div class="icon"><span>“</span></div>
                                    <p>“ I believe in lifelong learning and Skola is a great place to learn from experts. I've learned a lot and recommend it to all my friends “</p>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="testimonial_post text-center">
                                <div class="thumb">
                                    <img src="{{ asset("site/images/testimonial/2.png") }}" alt="2.png">
                                    <h4 class="title">Alison Dawn</h4>
                                    <div class="client-postn">WordPress Developer</div>
                                </div>
                                <div class="details">
                                    <div class="icon"><span>“</span></div>
                                    <p>“ I believe in lifelong learning and Skola is a great place to learn from experts. I've learned a lot and recommend it to all my friends “</p>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="testimonial_post text-center">
                                <div class="thumb">
                                    <img src="{{ asset("site/images/testimonial/1.png") }}" alt="1.png">
                                    <h4 class="title">Albert Cole</h4>
                                    <div class="client-postn">Designer</div>
                                </div>
                                <div class="details">
                                    <div class="icon"><span>“</span></div>
                                    <p>“ I believe in lifelong learning and Skola is a great place to learn from experts. I've learned a lot and recommend it to all my friends “</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Our Partners -->
    <section id="our-partners" class="our-partners bt1 pt60 pb60">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-md-4 col-lg-2">
                    <div class="our_partner">
                        <img class="img-fluid" src="{{ asset("site/images/partners/1.png") }}" alt="1.png">
                    </div>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-2">
                    <div class="our_partner">
                        <img class="img-fluid" src="{{ asset("site/images/partners/1.png") }}" alt="2.png">
                    </div>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-2">
                    <div class="our_partner">
                        <img class="img-fluid" src="{{ asset("site/images/partners/1.png") }}" alt="3.png">
                    </div>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-2">
                    <div class="our_partner">
                        <img class="img-fluid" src="{{ asset("site/images/partners/1.png") }}" alt="4.png">
                    </div>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-2">
                    <div class="our_partner">
                        <img class="img-fluid" src="{{ asset("site/images/partners/1.png") }}" alt="5.png">
                    </div>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-2">
                    <div class="our_partner">
                        <img class="img-fluid" src="{{ asset("site/images/partners/1.png") }}" alt="6.png">
                    </div>
                </div>
            </div>
        </div>
    </section>--}}
@endsection
@section('site.js')
    <script src="{{ asset("site/js/jquery-3.6.0.js") }}"></script>
    <script src="{{ asset("site/js/jquery-migrate-3.0.0.min.js") }}"></script>
    <script src="{{ asset("site/js/popper.min.js") }}"></script>
    <script src="{{ asset("site/js/bootstrap.min.js") }}"></script>
    <script src="{{ asset("site/js/jquery.mmenu.all.js") }}"></script>
    <script src="{{ asset("site/js/ace-responsive-menu.js") }}"></script>
    <script src="{{ asset("site/js/bootstrap-select.min.js") }}"></script>
    <script src="{{ asset("site/js/isotop.js") }}"></script>
    <script src="{{ asset("site/js/snackbar.min.js") }}"></script>
    <script src="{{ asset("site/js/simplebar.js") }}"></script>
    <script src="{{ asset("site/js/parallax.js") }}"></script>
    <script src="{{ asset("site/js/scrollto.js") }}"></script>
    <script src="{{ asset("site/js/jquery-scrolltofixed-min.js") }}"></script>
    <script src="{{ asset("site/js/jquery.counterup.js") }}"></script>
    <script src="{{ asset("site/js/wow.min.js") }}"></script>
    <script src="{{ asset("site/js/progressbar.js") }}"></script>
    <script src="{{ asset("site/js/slider.js") }}"></script>
    <script src="{{ asset("site/js/timepicker.js") }}"></script>
    <!-- Custom script for all pages -->
    <script src="{{ asset("site/js/script.js") }}"></script>
@endsection
