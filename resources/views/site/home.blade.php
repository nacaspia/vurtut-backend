@extends('site.layouts.app')
@section('site.title')
    @lang('site.home')
@endsection
@section('site.css')
    <style>
        .flaticon-love.active {
            color: red;
        }
    </style>
    <link rel="stylesheet" href="{{ asset("site/css/bootstrap.min.css") }}">
    <link rel="stylesheet" href="{{ asset("site/css/style.css") }}">
    <link rel="stylesheet" href="{{ asset("site/css/responsive.css") }}">
  {{--  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>--}}
@endsection
@section('site.content')
    <!--Aşağıdakı hissə nə işə yarayır bilmədim-->
    <section class="modal fade search_dropdown" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="popup_modal_wrapper">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-lg-12">
                                    <a class="close closer" data-dismiss="modal" aria-label="Close" href="#"><span><img src="{{ asset('site/images/icons/close.svg') }}" alt=""></span></a>
                                </div>
                            </div>
                        </div>
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-12 mb30">
                                    <h3>Filter by Category</h3>
                                </div>
                                <div class="col-sm-6 col-md-4 col-xl-2">
                                    <div class="icon-box text-center">
                                        <div class="icon"><span class="flaticon-cutlery"></span></div>
                                        <div class="content-details">
                                            <div class="title">Restaurant</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-4 col-xl-2">
                                    <div class="icon-box text-center">
                                        <div class="icon"><span class="flaticon-shopping-bag"></span></div>
                                        <div class="content-details">
                                            <div class="title">Shopping</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-4 col-xl-2">
                                    <div class="icon-box text-center">
                                        <div class="icon"><span class="flaticon-tent"></span></div>
                                        <div class="content-details">
                                            <div class="title">Outdoor Activities</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-4 col-xl-2">
                                    <div class="icon-box text-center">
                                        <div class="icon"><span class="flaticon-desk-bell"></span></div>
                                        <div class="content-details">
                                            <div class="title">Hotels</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-4 col-xl-2">
                                    <div class="icon-box text-center">
                                        <div class="icon"><span class="flaticon-mirror"></span></div>
                                        <div class="content-details">
                                            <div class="title">Beautu & Spa</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-4 col-xl-2">
                                    <div class="icon-box text-center">
                                        <div class="icon"><span class="flaticon-brake"></span></div>
                                        <div class="content-details">
                                            <div class="title">Automotive</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 mb15 mt20">
                                    <h3>Explore Hot Location</h3>
                                </div>
                                <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3">
                                    <div class="property_city_home6 tac-xsd">
                                        <div class="thumb"><img class="w100" src="{{ asset("site/images/property/pc18.jpg") }}" alt="pc18.jpg"></div>
                                        <div class="details">
                                            <h4>Miami</h4>
                                            <p>62 Listings</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3">
                                    <div class="property_city_home6 tac-xsd">
                                        <div class="thumb"><img class="w100" src="{{ asset("site/images/property/pc18.jpg") }}" alt="pc19.jpg"></div>
                                        <div class="details">
                                            <h4>Roma</h4>
                                            <p>92 Listings</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3">
                                    <div class="property_city_home6 tac-xsd">
                                        <div class="thumb"><img class="w100" src="{{ asset("site/images/property/pc18.jpg") }}" alt="pc20.jpg"></div>
                                        <div class="details">
                                            <h4>New Delhi</h4>
                                            <p>12 Listings</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3">
                                    <div class="property_city_home6 tac-xsd">
                                        <div class="thumb"><img class="w100" src="{{ asset("site/images/property/pc18.jpg") }}" alt="pc21.jpg"></div>
                                        <div class="details">
                                            <h4>London</h4>
                                            <p>74 Listings</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3">
                                    <div class="property_city_home6 tac-xsd">
                                        <div class="thumb"><img class="w100" src="{{ asset("site/images/property/pc18.jpg") }}" alt="pc22.jpg"></div>
                                        <div class="details">
                                            <h4>Amsterdam</h4>
                                            <p>62 Listings</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3">
                                    <div class="property_city_home6 tac-xsd">
                                        <div class="thumb"><img class="w100" src="{{ asset("site/images/property/pc18.jpg") }}" alt="pc23.jpg"></div>
                                        <div class="details">
                                            <h4>Berlin</h4>
                                            <p>92 Listings</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3">
                                    <div class="property_city_home6 tac-xsd">
                                        <div class="thumb"><img class="w100" src="{{ asset("site/images/property/pc18.jpg") }}" alt="pc24.jpg"></div>
                                        <div class="details">
                                            <h4>Paris</h4>
                                            <p>12 Listings</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3">
                                    <div class="property_city_home6 tac-xsd">
                                        <div class="thumb"><img class="w100" src="{{ asset("site/images/property/pc18.jpg") }}" alt="pc25.jpg"></div>
                                        <div class="details">
                                            <h4>New Zealand</h4>
                                            <p>74 Listings</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="home-one home1-overlay bg-img2">
        <div class="container">
            <div class="row posr">
                <div class="col-lg-12">
                    <div class="home_content home1">
                        <div class="home-text text-center">
                            <h2 class="fz50">SƏNİN ŞƏHƏRİN, SƏNİN SEÇİMLƏRİN!</h2>
                            <p class="fz18 color-white">Ən yaxşısını axtarırsansa, doğru yerdəsən, işinin ən yaxşıları bizimlədir - seç, müqayisə et və məkanını tap!</p>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-lg-10 col-xl-8">
                                <div class="home_adv_srch_opt text-center">
                                    <div class="wrapper">
                                        <div class="home_adv_srch_form home2">
                                            <form class="bgc-white bgct-767 pl30 pt10 pl0-767" action="{{ route('site.search') }}" method="GET">
                                                <div class="form-row align-items-center">
                                                    <div class="col-auto home_form_input mb20-xsd">
                                                        <label class="sr-only">Username</label>
                                                        <div class="input-group style1 mb-2 mb0-767">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text pl0 pb0-767">Nə?</div>
                                                            </div>
                                                            <div class="select-wrap style1-dropdown">
                                                                <select name="category_id" class="form-control js-searchBox">
                                                                    <option value="">müəssisə, xidmət, məhsul...</option>
                                                                    @if(!empty($mainCategories[0]))
                                                                        @foreach($mainCategories as $category)
                                                                            <option value="{{$category['id']}}">{{$category['title'][$currentLang]}}</option>
                                                                        @endforeach
                                                                    @endif
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-auto home_form_input">
                                                        <label class="sr-only">Username</label>
                                                        <div class="input-group style2 mb-2 mb0-767">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text pb0-767">Harada?</div>
                                                            </div>
                                                            <div class="select-wrap style2-dropdown">
                                                                <select name="city_id" class="form-control js-searchBox2">
                                                                    <option value="">Sənin şəhərin</option>
                                                                    @if(!empty($cities[0]))
                                                                        @foreach($cities as $city)
                                                                    <option value="{{$city['id']}}">{{$city['name'][$currentLang]}}</option>
                                                                        @endforeach
                                                                    @endif
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-auto home_form_input2">
                                                        <button type="submit" class="btn search-btn mb-2"><span class="flaticon-loupe"></span></button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="property-city" class="property-city border-bottom pb70">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <div class="main-title text-center">
                        <h2>Ən məhşur şəhərlər</h2>
                        <p>Ən aktiv və canlı şəhərlərlə tanış ol! Bəs sənin şəhərin?</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="feature_place_home2_slider">
                        @foreach($cities as $city)
                            <div class="item">
                                <div class="properti_city">
                                    <div class="thumb">
                                        <a href="{{ route('site.city',['citySlug' => $city['slug'][$currentLang]]) }}">
                                            <img class="img-fluid w100" src="{{ asset("uploads/cities/".$city['image']) }}" alt="{{$city['name'][$currentLang]}}">
                                        </a>
                                    </div>
                                    <div class="overlay">
                                        <a href="{{ route('site.city',['citySlug' => $city['slug'][$currentLang]]) }}">
                                            <div class="details">
                                                <h4>{{$city['name'][$currentLang]}}</h4>
                                                <p>{{ count($city['companies']) }} müəssisə</p>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="bgc-f4">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="main-title text-center mb20">
                        <h2>Premium müəssisələr</h2>
                        <p>Premium xidmət axtaranlar üçün ən doğru seçim</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="popular_listing_sliders row">
                        <!-- Nav tabs -->
                        <div class="nav nav-tabs mb50 col-lg-12 justify-content-center" role="tablist">
                            <a class="nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Bütün Kateqoriyalar</a>
                            @if(!empty($mainCategories[0]))
                                @foreach($mainCategories as $catKey=>$category)
                                    <a class="nav-link" id="nav-{{$category['slug'][$currentLang]}}-tab" data-toggle="tab" href="#nav-{{$category['slug'][$currentLang]}}" role="tab" aria-controls="nav-{{$category['slug'][$currentLang]}}" aria-selected="false">{{$category['title'][$currentLang]}}</a>
                                @endforeach
                            @endif
                        </div>

                        <!-- Tab panes -->
                        <div class="tab-content col-lg-12" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                <div class="popular_listing_slider1">
                                    @if(!empty($allCompaniesIsPremium[0]))
                                        @foreach($allCompaniesIsPremium as $companyIsPremium)
                                            <div class="item">
                                                <div class="feat_property" style="min-height: 404px;max-height: 404px;!important;">
                                                    <div class="thumb">
                                                        <img class="img-whp" style="width: 100%; max-height: 164px; object-fit: contain; border-radius: 8px; background-color: #f9f9f9;!important;" src="{{ asset("uploads/company/".$companyIsPremium['image']) }}" alt="fp1.jpg">
                                                        <div class="thmb_cntnt">
                                                            <ul class="tag mb0">
                                                                <li class="list-inline-item"><a href="{{ route('site.companyDetails',['slug' => $companyIsPremium['slug']]) }}">PEMIUM</a></li>
{{--                                                                <li class="list-inline-item"><a href="#">Açıq</a></li>--}}
                                                            </ul>
                                                            <ul class="listing_reviews">
                                                                <li class="list-inline-item"><a class="text-white" href="#"><span class="fa fa-star"></span></a></li>
                                                                <li class="list-inline-item"><a class="text-white" href="#"><span class="fa fa-star"></span></a></li>
                                                                <li class="list-inline-item"><a class="text-white" href="#"><span class="fa fa-star"></span></a></li>
                                                                <li class="list-inline-item"><a class="text-white" href="#"><span class="fa fa-star"></span></a></li>
                                                                <li class="list-inline-item"><a class="text-white" href="#"><span class="fa fa-star"></span></a></li>
                                                                <li class="list-inline-item"><a class="text-white total_review" href="{{ route('site.companyDetails',['slug' => $companyIsPremium['slug']]) }}">({{count($companyIsPremium['comments'])}} Rəy)</a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="details">
                                                        <div class="tc_content">
                                                            <div class="badge_icon"><a href="{{ route('site.companyDetails',['slug' => $companyIsPremium['slug']]) }}"><img src="{{ asset("site/images/icons/agent1.svg") }}" alt="agent1.svg"></a></div>
                                                            <h4>{{ $companyIsPremium['full_name'] }}</h4>
                                                            <p>{{ \Illuminate\Support\Str::limit($companyIsPremium['text'], 50, '...') }}</p>
                                                            @php $data = $companyIsPremium['data']; @endphp
                                                            <ul class="prop_details mb0">
                                                                <li class="list-inline-item"><a href="tel:{{ $companyIsPremium['phone'] }}"><span class="flaticon-phone pr5"></span> {{ $companyIsPremium['phone'] }}</a></li>
                                                                <li class="list-inline-item"><a href="#"><span class="flaticon-pin pr5"></span>{{ $data['address'] }}</a></li>
                                                            </ul>
                                                        </div>
                                                        <div class="fp_footer">
                                                            <ul class="fp_meta float-left mb0">
                                                                @if(!empty($companyIsPremium['category']['image']))
                                                                <li class="list-inline-item">
                                                                    <a href="{{ route('site.companyDetails',['slug' => $companyIsPremium['slug']]) }}">
                                                                        <img src="{{ asset("uploads/categories/".$companyIsPremium['category']['image']) }}" alt="{{$companyIsPremium['category']['title'][$currentLang]}}" style="max-height: 28px;!important;">
                                                                    </a>
                                                                </li>
                                                                @endif
                                                                <li class="list-inline-item"><a href="{{ route('site.companyDetails',['slug' => $companyIsPremium['slug']]) }}">{{ $companyIsPremium['category']['title'][$currentLang] }}</a></li>
                                                            </ul>
                                                            <ul class="fp_meta float-right mb0">
{{--                                                                <li class="list-inline-item"><a href="#"><span class="flaticon-zoom"></span></a></li>--}}

                                                                @if(!empty(auth('user')->user()->id))
                                                                <li class="list-inline-item">
                                                                    <a href="javascript:void(0);" class="like-btn icon"
                                                                       data-item-id="{{ $companyIsPremium['id'] }}"
                                                                       data-item-type="company"
                                                                       data-liked="{{ (!empty($companyIsPremium['userLikes']['user_id']) && $companyIsPremium['userLikes']['user_id'] == auth('user')->user()->id) ?? false }}">
                                                                        <span class="flaticon-love {{ (!empty($companyIsPremium['userLikes']['user_id']) && $companyIsPremium['userLikes']['user_id'] == auth('user')->user()->id)? 'active' : '' }}"></span>
                                                                    </a>
{{--                                                                    <a class="icon" href="#"><span class="flaticon-love"></span></a>--}}
                                                                </li>
                                                                @endif
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                            @if(!empty($mainCategories[0]))
                                @foreach($mainCategories as $catKey=>$category)
                                    <div class="tab-pane fade" id="nav-{{$category['slug'][$currentLang]}}" role="tabpanel" aria-labelledby="nav-{{$category['slug'][$currentLang]}}-tab">
                                        <div class="popular_listing_slider1">
                                            @if(!empty($category['companiesIsPremium'][0]))
                                                @foreach($category['companiesIsPremium'] as $companyIsPremium)
                                                    <div class="item">
                                                        <div class="feat_property" style="min-height: 404px;max-height: 404px;!important;">
                                                            <div class="thumb">
                                                                <img class="img-whp" style="width: 100%; max-height: 164px; object-fit: contain; border-radius: 8px; background-color: #f9f9f9;!important;" src="{{ asset("uploads/company/".$companyIsPremium['image']) }}" alt="fp1.jpg">
                                                                <div class="thmb_cntnt">
                                                                    <ul class="tag mb0">
                                                                        <li class="list-inline-item"><a href="{{ route('site.companyDetails',['slug' => $companyIsPremium['slug']]) }}">PEMIUM</a></li>
{{--                                                                        <li class="list-inline-item"><a href="#">Açıq</a></li>--}}
                                                                    </ul>
                                                                    <ul class="listing_reviews">
                                                                        <li class="list-inline-item"><a class="text-white" href="#"><span class="fa fa-star"></span></a></li>
                                                                        <li class="list-inline-item"><a class="text-white" href="#"><span class="fa fa-star"></span></a></li>
                                                                        <li class="list-inline-item"><a class="text-white" href="#"><span class="fa fa-star"></span></a></li>
                                                                        <li class="list-inline-item"><a class="text-white" href="#"><span class="fa fa-star"></span></a></li>
                                                                        <li class="list-inline-item"><a class="text-white" href="#"><span class="fa fa-star"></span></a></li>
                                                                        <li class="list-inline-item"><a class="text-white total_review" href="{{ route('site.companyDetails',['slug' => $companyIsPremium['slug']]) }}">({{count($companyIsPremium['comments'])}} Rəy)</a></li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                            <div class="details">
                                                                <div class="tc_content">
                                                                    <div class="badge_icon"><a href="{{ route('site.companyDetails',['slug' => $companyIsPremium['slug']]) }}"><img src="{{ asset("site/images/icons/agent1.svg") }}" alt="agent1.svg"></a></div>
                                                                    <h4>{{ $companyIsPremium['full_name'] }}</h4>
                                                                    <p>{{ \Illuminate\Support\Str::limit($companyIsPremium['text'], 50, '...') }}</p>
                                                                    @php
                                                                        $data = $companyIsPremium['data'];
                                                                    @endphp
                                                                    <ul class="prop_details mb0">
                                                                        <li class="list-inline-item"><a href="tel:{{ $companyIsPremium['phone'] }}"><span class="flaticon-phone pr5"></span> {{ $companyIsPremium['phone'] }}</a></li>
                                                                        <li class="list-inline-item"><a href="#"><span class="flaticon-pin pr5"></span>{{ $data['address'] }}</a></li>
                                                                    </ul>
                                                                </div>
                                                                <div class="fp_footer">
                                                                    <ul class="fp_meta float-left mb0">
                                                                        @if(!empty($companyIsPremium['category']['image']))
                                                                            <li class="list-inline-item">
                                                                                <a href="{{ route('site.companyDetails',['slug' => $companyIsPremium['slug']]) }}">
                                                                                    <img src="{{ asset("uploads/categories/".$companyIsPremium['category']['image']) }}" alt="{{$companyIsPremium['category']['title'][$currentLang]}}"  style="max-height: 28px;!important;">
                                                                                </a>
                                                                            </li>
                                                                        @endif
                                                                        <li class="list-inline-item"><a href="{{ route('site.companyDetails',['slug' => $companyIsPremium['slug']]) }}">{{ $companyIsPremium['category']['title'][$currentLang] }}</a></li>
                                                                    </ul>
                                                                    <ul class="fp_meta float-right mb0">
{{--                                                                        <li class="list-inline-item"><a href="#"><span class="flaticon-zoom"></span></a></li>--}}
                                                                        @if(!empty(auth('user')->user()->id))
                                                                            <li class="list-inline-item">
                                                                                <a href="javascript:void(0);" class="like-btn icon"
                                                                                   data-item-id="{{ $companyIsPremium['id'] }}"
                                                                                   data-item-type="company"
                                                                                   data-liked="{{ (!empty($companyIsPremium['userLikes']['user_id']) && $companyIsPremium['userLikes']['user_id'] == auth('user')->user()->id) ?? false }}">
                                                                                    <span class="flaticon-love {{ (!empty($companyIsPremium['userLikes']['user_id']) && $companyIsPremium['userLikes']['user_id'] == auth('user')->user()->id)? 'active' : '' }}"></span>
                                                                                </a>
                                                                                {{--                                                                    <a class="icon" href="#"><span class="flaticon-love"></span></a>--}}
                                                                            </li>
                                                                        @endif
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Kommentə aldım burayı hələlik
    <section id="why-chose" class="whychose_us pb70">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="main-title text-center">
                        <h2>Filter by Category</h2>
                        <p>Discover some of the most popular listings in Toronto based on user reviews and ratings.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6 col-lg-2">
                    <div class="icon_hvr_img_box" style="background-image: url(images/service/4.jpg);">
                        <div class="overlay">
                            <div class="icon"><span class="flaticon-cutlery"></span></div>
                            <div class="details">
                                <h5 class="title">Restaurant</h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-2">
                    <div class="icon_hvr_img_box" style="background-image: url(images/service/4.jpg);">
                        <div class="overlay">
                            <div class="icon"><span class="flaticon-shopping-bag"></span></div>
                            <div class="details">
                                <h5 class="title">Shopping</h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-2">
                    <div class="icon_hvr_img_box" style="background-image: url(images/service/4.jpg);">
                        <div class="overlay">
                            <div class="icon"><span class="flaticon-tent"></span></div>
                            <div class="details">
                                <h5 class="title">Outdoor Activities</h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-2">
                    <div class="icon_hvr_img_box" style="background-image: url(images/service/4.jpg);">
                        <div class="overlay">
                            <div class="icon"><span class="flaticon-desk-bell"></span></div>
                            <div class="details">
                                <h5 class="title">Hotels</h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-2">
                    <div class="icon_hvr_img_box" style="background-image: url(images/service/4.jpg);">
                        <div class="overlay">
                            <div class="icon"><span class="flaticon-mirror"></span></div>
                            <div class="details">
                                <h5 class="title">Beauty & Spa</h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-2">
                    <div class="icon_hvr_img_box" style="background-image: url(images/service/4.jpg);">
                        <div class="overlay">
                            <div class="icon"><span class="flaticon-brake"></span></div>
                            <div class="details">
                                <h5 class="title">Automotive</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> -->

    <section class="our-blog bgc-f4 pb70">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <div class="main-title text-center">
                        <h2>Ən son yeniliklər və anonslar</h2>
                        <p>Biz daima yenilənirik – yeni funksiyalar, təkmilləşdirilmiş dizayn və daha çox!</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-lg-4 col-xl-4">
                    <div class="for_blog feat_property">
                        <div class="thumb">
                            <img class="img-whp" src="{{ asset("site/images/blog/1.jpg") }}" alt="1.jpg">
                            <div class="tag bgc-thm2"><a class="text-white" href="#">Təqdimat çarxı</a></div>
                        </div>
                        <div class="details">
                            <div class="tc_content">
                                <div class="bp_meta">
                                    <ul>
                                        <li class="list-inline-item"><a href="https://nacaspia.com"><span class="flaticon-avatar mr10"></span>NACaspia Information Technologies</a></li>
                                        <li class="list-inline-item"><a href="#"><span class="flaticon-date mr10"></span> 01 Oktyabr, 2025</a></li>
                                    </ul>
                                </div>
                                <h4>Vurtut.com - Gələcəyin platforması</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 col-xl-4">
                    <div class="for_blog feat_property">
                        <div class="thumb">
                            <img class="img-whp" src="{{ asset("site/images/blog/1.jpg") }}" alt="2.jpg">
                            <div class="tag bgc-thm2"><a class="text-white" href="#">Yeni funksiya</a></div>
                        </div>
                        <div class="details">
                            <div class="tc_content">
                                <div class="bp_meta">
                                    <ul>
                                        <li class="list-inline-item"><a href="https://nacaspia.com"><span class="flaticon-avatar mr10"></span>NACaspia Information Technologies</a></li>
                                        <li class="list-inline-item"><a href="#"><span class="flaticon-date mr10"></span> 01 Dekabr, 2025</a></li>
                                    </ul>
                                </div>
                                <h4>Rezervasiya - funksiyası Vurtut-la daha rahat!</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 col-xl-4">
                    <div class="for_blog feat_property">
                        <div class="thumb">
                            <img class="img-whp" src="{{ asset("site/images/blog/1.jpg") }}" alt="3.jpg">
                            <div class="tag bgc-thm2"><a class="text-white" href="#">Anons</a></div>
                        </div>
                        <div class="details">
                            <div class="tc_content">
                                <div class="bp_meta">
                                    <ul>
                                        <li class="list-inline-item"><a href="https://nacaspia.com"><span class="flaticon-avatar mr10"></span>NACaspia Information Technologies</a></li>
                                        <li class="list-inline-item"><a href="#"><span class="flaticon-date mr10"></span> 07 Dekabr, 2025</a></li>
                                    </ul>
                                </div>
                                <h4>Canlı sifariş xidməti - 2026 ilə birlikdə gəlir!</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Kommentə aldım burayı hələlik
    <section class="our-pricing pb70">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <div class="main-title text-center">
                        <h2>Pricing Packages</h2>
                        <p>Lorem ipsum dolor sit, set do eiusmod tempor.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="pricing_packages_top mb30">
                        <h5 class="save_title">Save up to 10%</h5>
                          <div class="toggle-btn">
                            <span class="pricing_save1">Monthly</span>
                            <label class="switch">
                                <input type="checkbox" id="checbox" onclick="check()"/>
                                <span class="pricing_table_switch_slide round"></span>
                            </label>
                            <span class="pricing_save2">AnnualSave</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6 col-md-6 col-lg-4 col-xl-4">
                      <div class="pricing_packages">
                          <div class="heading text-center">
                            <h5 class="package_title">Basic</h5>
                            <h2 class="text2">$99 <small>/ Monthly</small></h2>
                            <h2 class="text1">$199 <small>/ Monthly</small></h2>
                          </div>
                          <div class="details">
                            <ul	 class="list">
                                <li>Basic Listing Submission</li>
                                <li>One Listing</li>
                                <li>30 Days Availability</li>
                                <li>Limited Support</li>
                                <li>Accept Reviews</li>
                                <li>Edit Your Listing</li>
                            </ul>
                            <a href="#" class="btn package_btn btn-block">View Profile</a>
                          </div>
                      </div>
                </div>
                  <div class="col-sm-6 col-md-6 col-lg-4 col-xl-4">
                      <div class="pricing_packages">
                          <div class="heading text-center">
                            <h5 class="package_title">Standard</h5>
                            <h2 class="text2">$239 <small>/ Monthly</small></h2>
                            <h2 class="text1">$499 <small>/ Monthly</small></h2>
                          </div>
                          <div class="details">
                            <ul class="list">
                                <li>Basic Listing Submission</li>
                                <li>One Listing</li>
                                <li>30 Days Availability</li>
                                <li>Limited Support</li>
                                <li>Accept Reviews</li>
                                <li>Edit Your Listing</li>
                            </ul>
                            <a href="#" class="btn package_btn btn-block">View Profile</a>
                          </div>
                      </div>
                  </div>
                  <div class="col-sm-6 col-md-6 col-lg-4 col-xl-4">
                      <div class="pricing_packages">
                          <div class="heading text-center">
                            <h5 class="package_title">Extended</h5>
                            <h2 class="text2">$359 <small>/ Monthly</small></h2>
                            <h2 class="text1">$799 <small>/ Monthly</small></h2>
                          </div>
                          <div class="details">
                            <ul class="list">
                                <li>Basic Listing Submission</li>
                                <li>One Listing</li>
                                <li>30 Days Availability</li>
                                <li>Limited Support</li>
                                <li>Accept Reviews</li>
                                <li>Edit Your Listing</li>
                            </ul>
                            <a href="#" class="btn package_btn btn-block">View Profile</a>
                          </div>
                      </div>
                  </div>
            </div>
        </div>
    </section>-->
    <section class="divider bg-img5 parallax" data-stellar-background-ratio="0.2">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="business_exposer text-center">
                        <h2 class="title text-white mb20">Reklamınızı burda görün</h2>
                        <p class="text-white mb35">Hər gün minlərlə potensial müştəri reklamınızı burda görəcək – reklamla gücünü göstər!</p>
                        <a class="btn stay_amplace_btn" href="{{ route('site.contact') }}">ƏLAQƏ</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
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
    @if(!empty(auth('user')->user()->id))
    <script>
        $(document).on('click', '.like-btn', function (e) {
            e.preventDefault();

            const $btn = $(this);
            const itemId = $btn.data('item-id');
            const itemType = $btn.data('item-type');
            const isLiked = $btn.data('liked');

            const url = !isLiked ? '{{ route('site.user.like') }}' : '{{ route('site.user.unlike') }}';

            $.ajax({
                url: url,
                type: 'POST',
                data: {
                    item_id: itemId,
                    item_type: itemType,
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    if (response.success) {
                        // toggle class
                        $btn.find('span').toggleClass('active');
                        // update data-liked value
                        $btn.data('liked', !isLiked);
                    }
                },
                error: function (xhr) {
                    alert('Əməliyyatda xəta baş verdi.');
                }
            });
        });

    </script>
    @endif
@endsection
