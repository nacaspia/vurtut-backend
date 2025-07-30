@extends('site.user.layouts.app')
@section('user.css')
@endsection
@section('user.content')
    <!-- Our Dashbord -->
    <section class="our-dashbord dashbord bgc-f4">
        <div class="container">
            <div class="row">
                @include('site.user.layouts.mobile-menu')
                <div class="col-lg-12 mb15">
                    <div class="breadcrumb_content style2">
                        <h2 class="breadcrumb_title float-left">Rəylərim</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div id="myreview" class="my_dashboard_review mb30-smd">
                        <div class="mbp_pagination_comments">
                            <div class="total_review pt0 float-left fn-smd">
                                <h4>Visitor Reviews</h4>
                            </div>
                            <div class="candidate_revew_select style2 review_page text-right mb30-991 tal-smd tac-xsd">
                                <ul class="mb0 mt10">
                                    <li class="list-inline-item mb30-767">
                                        <select class="selectpicker show-tick">
                                            <option>Hamısı</option>
                                            <option>Son</option>
                                            <option>Gözləyən</option>
                                        </select>
                                    </li>
                                </ul>
                            </div>
                            <div class="mbp_first media">
                                <img src="{{ asset('site/images/blog/reviewer1.png') }}" class="mr-3" alt="reviewer1.png">
                                <div class="media-body">
                                    <h4 class="sub_title mt-0">Jane Cooper</h4>
                                    <div class="sspd_postdate fz14 mb20">April 6, 2021 at 3:21 AM
                                        <div class="sspd_review pull-right">
                                            <ul class="mb0 pl15">
                                                <li class="list-inline-item"><a href="#"><i class="fa fa-star"></i></a></li>
                                                <li class="list-inline-item"><a href="#"><i class="fa fa-star"></i></a></li>
                                                <li class="list-inline-item"><a href="#"><i class="fa fa-star"></i></a></li>
                                                <li class="list-inline-item"><a href="#"><i class="fa fa-star"></i></a></li>
                                                <li class="list-inline-item"><a href="#"><i class="fa fa-star"></i></a></li>
                                                <li class="list-inline-item">(5 reviews)</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <p class="fz14 mt10">Burda tekce istifadeci reyleri olacaq yeni menim reylerim ve mene edilen reyler olaraq bolunmeyecek!</p>
                                    <div class="thumb-list mt30">
                                        <ul>
                                            <li class="list-inline-item"><a href="#"><img src="{{ asset('site/images/blog/bsp1.jpg') }}" alt="bsp1.jpg"></a></li>
                                            <li class="list-inline-item"><a href="#"><img src="{{ asset('site/images/blog/bsp2.jpg') }}" alt="bsp2.jpg"></a></li>
                                        </ul>
                                    </div>
                                    <a class="text-thm tdu" href="#">Cavablandır</a>
                                </div>
                            </div>
                            <div class="mbp_first media">
                                <img src="{{ asset('site/images/blog/reviewer2.png') }}" class="mr-3" alt="reviewer2.png">
                                <div class="media-body">
                                    <h4 class="sub_title mt-0">Bessie Cooper</h4>
                                    <div class="sspd_postdate fz14 mb20">April 6, 2021 at 3:21 AM
                                        <div class="sspd_review pull-right">
                                            <ul class="mb0 pl15">
                                                <li class="list-inline-item"><a href="#"><i class="fa fa-star"></i></a></li>
                                                <li class="list-inline-item"><a href="#"><i class="fa fa-star"></i></a></li>
                                                <li class="list-inline-item"><a href="#"><i class="fa fa-star"></i></a></li>
                                                <li class="list-inline-item"><a href="#"><i class="fa fa-star"></i></a></li>
                                                <li class="list-inline-item"><a href="#"><i class="fa fa-star"></i></a></li>
                                                <li class="list-inline-item">(5 reviews)</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <p class="fz14 mt10">I enjoyed the tour. John is very friendly, observant, and funny. He cares for the guests and really works hard on providing a good experience by understanding each person's needs.…</p>
                                    <a class="text-thm tdu" href="#">Cavablandır</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('user.js')
@endsection
