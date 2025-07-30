@extends('site.layouts.app')
@section('site.title')
    @lang('site.home')
@endsection
@section('site.css')
    <link rel="stylesheet" href="{{ asset("site/css/bootstrap.min.css") }}">
    <link rel="stylesheet" href="{{ asset("site/css/style.css") }}">
    <link rel="stylesheet" href="{{ asset("site/css/responsive.css") }}">
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
@endsection
@section('site.content')
    <!-- 4th Home Slider -->
    <div class="home-one home1-overlay">
        <div class="container-fluid p0">
            <div class="row">
                <div class="col-lg-12">
                    <div class="main-banner-wrapper">
                        <div class="banner-style-one owl-theme owl-carousel">
                            <div class="slide slide-one" style="background-image: url({{ asset("site/images/home/1.jpg") }});height: 650px;"></div>
                            <div class="slide slide-one" style="background-image: url({{ asset("site/images/home/2.jpg") }});height: 650px;"></div>
                        </div>
                        <div class="carousel-btn-block banner-carousel-btn">
                            <span class="carousel-btn left-btn"><i class="flaticon-arrow-pointing-to-left left"></i></span>
                            <span class="carousel-btn right-btn"><i class="flaticon-arrow-pointing-to-right right"></i></span>
                        </div><!-- /.carousel-btn-block banner-carousel-btn -->
                    </div><!-- /.main-banner-wrapper -->
                </div>
            </div>
        </div>
        <div class="container home_iconbox_container">
            <div class="row posr">
                <div class="col-lg-12">
                    <div class="home_content listing slider_style">
                        <div class="home-text home6 text-center">
                            <h2 class="fz50 color-white">London</h2>
                            <p class="fz18 color-white">Find great places to stay, eat, shop, or visit from local experts.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Main Blog Post Content -->
    <section class="blog_post_container">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="main_blog_post_content">
                        <div class="for_blog list-type feat_property">
                            <div class="thumb w100 pb10">
                                <img class="img-whp" src="{{ asset("site/images/blog/7.jpg") }}" alt="7.jpg">
                                <div class="tag bgc-thm"><a class="text-white" href="#">Health & Care</a></div>
                            </div>
                            <div class="details pb5">
                                <div class="tc_content pt15">
                                    <div class="bp_meta mb20">
                                        <ul>
                                            <li class="list-inline-item"><a href="#"><span class="flaticon-avatar mr10"></span> Jack Wilson</a></li>
                                            <li class="list-inline-item"><a href="#"><span class="flaticon-date mr10"></span> 06 April, 2020</a></li>
                                        </ul>
                                    </div>
                                    <h4 class="mt15 mb20">The Top 25 Bike Stores in Toronto by Neighbourhood</h4>
                                    <p class="mb10">Amet minim mollit non deserunt ullamco est sit aliqua dolor do amet sint. Velit officia consequat duis enim velit mollit.</p>
                                    <a class="tdu text-thm" href="#">Read More</a>
                                </div>
                            </div>
                        </div>
                        <div class="for_blog list-type feat_property">
                            <div class="thumb w100 pb10">
                                <img class="img-whp" src="{{ asset("site/images/blog/8.jpg") }}" alt="8.jpg">
                                <div class="tag bgc-thm"><a class="text-white" href="#">Health & Care</a></div>
                            </div>
                            <div class="details pb5">
                                <div class="tc_content pt15">
                                    <div class="bp_meta mb20">
                                        <ul>
                                            <li class="list-inline-item"><a href="#"><span class="flaticon-avatar mr10"></span> Jack Wilson</a></li>
                                            <li class="list-inline-item"><a href="#"><span class="flaticon-date mr10"></span> 06 April, 2020</a></li>
                                        </ul>
                                    </div>
                                    <h4 class="mt15 mb20">The Top 25 Bike Stores in Toronto by Neighbourhood</h4>
                                    <p class="mb10">Amet minim mollit non deserunt ullamco est sit aliqua dolor do amet sint. Velit officia consequat duis enim velit mollit.</p>
                                    <a class="tdu text-thm" href="#">Read More</a>
                                </div>
                            </div>
                        </div>
                        <div class="for_blog list-type feat_property">
                            <div class="thumb w100 pb10">
                                <img class="img-whp" src="{{ asset("site/images/blog/9.jpg") }}" alt="9.jpg">
                                <div class="tag bgc-thm"><a class="text-white" href="#">Health & Care</a></div>
                            </div>
                            <div class="details pb5">
                                <div class="tc_content pt15">
                                    <div class="bp_meta mb20">
                                        <ul>
                                            <li class="list-inline-item"><a href="#"><span class="flaticon-avatar mr10"></span> Jack Wilson</a></li>
                                            <li class="list-inline-item"><a href="#"><span class="flaticon-date mr10"></span> 06 April, 2020</a></li>
                                        </ul>
                                    </div>
                                    <h4 class="mt15 mb20">The Top 25 Bike Stores in Toronto by Neighbourhood</h4>
                                    <p class="mb10">Amet minim mollit non deserunt ullamco est sit aliqua dolor do amet sint. Velit officia consequat duis enim velit mollit.</p>
                                    <a class="tdu text-thm" href="#">Read More</a>
                                </div>
                            </div>
                        </div>
                        <div class="for_blog list-type feat_property">
                            <div class="thumb w100 pb10">
                                <img class="img-whp" src="{{ asset("site/images/blog/10.jpg") }}" alt="10.jpg">
                                <div class="tag bgc-thm"><a class="text-white" href="#">Health & Care</a></div>
                            </div>
                            <div class="details pb5">
                                <div class="tc_content pt15">
                                    <div class="bp_meta mb20">
                                        <ul>
                                            <li class="list-inline-item"><a href="#"><span class="flaticon-avatar mr10"></span> Jack Wilson</a></li>
                                            <li class="list-inline-item"><a href="#"><span class="flaticon-date mr10"></span> 06 April, 2020</a></li>
                                        </ul>
                                    </div>
                                    <h4 class="mt15 mb20">The Top 25 Bike Stores in Toronto by Neighbourhood</h4>
                                    <p class="mb10">Amet minim mollit non deserunt ullamco est sit aliqua dolor do amet sint. Velit officia consequat duis enim velit mollit.</p>
                                    <a class="tdu text-thm" href="#">Read More</a>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="mbp_pagination mt30">
                                    <ul class="page_navigation">
                                        <li class="page-item">
                                            <a class="page-link" href="#" tabindex="-1" aria-disabled="true"> <span class="fa fa-angle-left"></span></a>
                                        </li>
                                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                                        <li class="page-item active" aria-current="page">
                                            <a class="page-link" href="#">3 <span class="sr-only">(current)</span></a>
                                        </li>
                                        <li class="page-item"><a class="page-link" href="#">4</a></li>
                                        <li class="page-item"><a class="page-link" href="#">5</a></li>
                                        <li class="page-item"><a class="page-link" href="#">...</a></li>
                                        <li class="page-item"><a class="page-link" href="#">15</a></li>
                                        <li class="page-item">
                                            <a class="page-link" href="#"><span class="fa fa-angle-right"></span></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-xl-4">
                    <div class="sidebar_search_widget">
                        <div class="blog_search_widget">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="To search type and hit enter" aria-label="Recipient's username">
                            </div>
                        </div>
                    </div>
                    <div class="terms_condition_widget">
                        <h4 class="title">Categories Property</h4>
                        <div class="widget_list">
                            <ul class="list_details order_list list-style-type-bullet">
                                <li><a href="#">Accepts Credit Cards</a></li>
                                <li><a href="#">Smoking Allowed</a></li>
                                <li><a href="#">Bike Parking</a></li>
                                <li><a href="#">Street Parking</a></li>
                                <li><a href="#">Wireless Internet</a></li>
                                <li><a href="#">Alcohol</a></li>
                                <li><a href="#">Pet Friendly</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="sidebar_feature_listing">
                        <h4 class="title">Top Article</h4>
                        <div class="media">
                            <img class="align-self-start mr-3" src="images/blog/fls1.jpg" alt="fls1.jpg">
                            <div class="media-body">
                                <h5 class="mt-0 post_title">Great Business Tips in 2020</h5>
                                <a href="#">January 7, 2021</a>
                            </div>
                        </div>
                        <div class="media">
                            <img class="align-self-start mr-3" src="images/blog/fls2.jpg" alt="fls2.jpg">
                            <div class="media-body">
                                <h5 class="mt-0 post_title">Excited News About Fashion.</h5>
                                <a href="#">January 7, 2021</a>
                            </div>
                        </div>
                        <div class="media mb0">
                            <img class="align-self-start mr-3" src="images/blog/fls3.jpg" alt="fls3.jpg">
                            <div class="media-body">
                                <h5 class="mt-0 post_title">8 Amazing Tricks About Business</h5>
                                <a href="#">January 7, 2021</a>
                            </div>
                        </div>
                    </div>
                    <div class="blog_tag_widget">
                        <h4 class="title">Tags</h4>
                        <ul class="tag_list">
                            <li class="list-inline-item"><a href="#">Travelling</a></li>
                            <li class="list-inline-item"><a href="#">Art</a></li>
                            <li class="list-inline-item"><a href="#">Vacation</a></li>
                            <li class="list-inline-item"><a href="#">Tourism</a></li>
                            <li class="list-inline-item"><a href="#">Culture</a></li>
                            <li class="list-inline-item"><a href="#">Lifestyle</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('site.js')
    <!-- Wrapper End -->
    <script src="{{ asset("site/js/jquery-3.6.0.js") }}"></script>
    <script src="{{ asset("site/js/jquery-migrate-3.0.0.min.js") }}"></script>
    <script src="{{ asset("site/js/popper.min.js") }}"></script>
    <script src="{{ asset("site/js/bootstrap.min.js") }}"></script>
    <script src="{{ asset("site/js/jquery.mmenu.all.js") }}"></script>
    <script src="{{ asset("site/js/ace-responsive-menu.js") }}"></script>
    <script src="{{ asset("site/js/bootstrap-select.min.js") }}"></script>
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
