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
    <link rel="stylesheet" href="{{ asset("site/css/bootstrap.min.css") }}?v={{ time() }}">
    <link rel="stylesheet" href="{{ asset("site/css/style.css") }}?v={{ time() }}">
    <link rel="stylesheet" href="{{ asset("site/css/responsive.css") }}?v={{ time() }}">
@endsection
@section('site.content')
    <section class="home-one home1-overlay bg-img2">
        <div class="container">
            <div class="row posr">
                <div class="col-lg-12">
                    <div class="home_content home1">
                        <div class="home-text text-center">
                            <h2 class="fz50">Həyatını asanlaşdır!</h2>
                            <p class="fz18 color-white">Keyfiyyətli seçim və vaxta qənaət!</p>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-lg-10 col-xl-8">
                                <div class="home_adv_srch_opt text-center">
                                    <div class="wrapper">
                                        <div class="home_adv_srch_form home2">
                                            <form class="bgc-white bgct-767 pl30 pt10 pl0-767" action="{{ route('site.search') }}" method="GET">
                                                <div class="form-row align-items-center">
                                                    <div class="col-auto home_form_input mb20-xsd">
                                                        <label class="sr-only">Müəssisə kateqoriyası</label>
                                                        <div class="input-group style mb-2 mb0-767">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text pb0-767">Nə?</div>
                                                            </div>
                                                            <div class="select-wrap style2-dropdown">
                                                                <select name="category_id" class="form-control js-searchBox2">
                                                                    <option value="">Müəssisə kateqoriyası</option>
                                                                    @if(!empty($categories[0]))
                                                                        @foreach($categories as $category)
                                                                            <option value="{{$category['id']}}">{{$category['title'][$currentLang]}}</option>
                                                                        @endforeach
                                                                    @endif
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-auto home_form_input">
                                                        <label class="sr-only">Sənin şəhərin</label>
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


    @if(!empty($allCompaniesIsPremium[0]))
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
                        <div class="nav nav-tabs mb50 col-lg-12 justify-content-center " role="tablist">
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
                                                <div class="feat_property" style="height: 430px;">
                                                    <div class="thumb">
                                                        <img class="img-whp" style="width: 100%; max-height: 163px; object-fit: cover; border-radius: 8px; background-color: #f9f9f9;!important;" src="{{ asset("uploads/company/".$companyIsPremium['image']) }}" alt="fp1.jpg">
                                                        <div class="thmb_cntnt">
                                                            <ul class="tag mb0">
                                                                <li class="list-inline-item" style="background: radial-gradient(47.12% 309% at 47.12% 40.18%, rgba(254, 255, 134, 0.7) 0%, rgba(251, 206, 61, 0.7) 50.48%, rgba(132, 77, 32, 0.7) 100%); border:none !important;" ><a href="{{ route('site.companyDetails',['slug' => $companyIsPremium['slug']]) }}" style="font-size: 12px !important;">Premium</a></li>
                                                            </ul>
                                                            @if(!empty($companyIsPremium['comments']))
                                                            <ul class="listing_reviews">
                                                                    <div class="list-inline-item sspd_review">
                                                                            <?php
                                                                            $comments = $companyIsPremium['comments'];

                                                                            $avgCleanliness = round($comments->avg('cleanliness'), 1);
                                                                            $avgComfort = round($comments->avg('comfort'), 1);
                                                                            $avgStaff = round($comments->avg('staf'), 1);
                                                                            $avgFacilities = round($comments->avg('facilities'), 1);
                                                                            $overallAverage = round(collect([
                                                                                $avgCleanliness, $avgComfort, $avgStaff, $avgFacilities
                                                                            ])->filter()->avg(), 2);

                                                                            $reviewCount = $comments->count();
                                                                            ?>
                                                                        @php
                                                                            $categories = [
                                                                                'Təmizlik' => $avgCleanliness,
                                                                                'Heyət' => $avgStaff,
                                                                                'Rahatlıq' => $avgComfort,
                                                                                'İmkanlar' => $avgFacilities,
                                                                            ];

                                                                            // ümumi cəm
                                                                            $totalScore = array_sum($categories);

                                                                            // neçə kateqoriya varsa
                                                                            $count = count($categories);

                                                                            // orta qiymət
                                                                            $averageScore = $count > 0 ? $totalScore / $count : 0;
                                                                        @endphp

                                                                        <div class="rating-stars">
                                                                            @for ($i = 1; $i <= 5; $i++)
                                                                                <i class="fa fa-star{{ $i <= round($averageScore) ? '' : '-o' }}"></i>
                                                                            @endfor
                                                                        </div>
                                                                    </div>
                                                            </ul>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="details">
                                                        <div class="tc_content" style="height:181px; padding-bottom: 5px;">
                                                            <h4><a href="{{ route('site.companyDetails',['slug' => $companyIsPremium['slug']]) }}">{{ $companyIsPremium['full_name'] }}</a></h4>
                                                            <p>{{ \Illuminate\Support\Str::limit($companyIsPremium['text'], 50, '...') }}</p>
                                                            @php $data = $companyIsPremium['data']; @endphp
                                                            <ul class="prop_details mb0">
                                                                <li class="list-inline-item"><a href="tel:{{ $companyIsPremium['social']['one_phone'] }}"><span class="flaticon-phone pr5"></span> {{ $companyIsPremium['social']['one_phone'] }}</a></li>
                                                                <li class="list-inline-item"><a><span class="flaticon-pin pr5"></span> {{ $data['address'] ?? '' }}</a></li>
                                                            </ul>
                                                        </div>
                                                        <div class="fp_footer">
                                                            <ul class="fp_meta float-left mb0">
                                                                @if(!empty($companyIsPremium['category']['image']))
                                                                <li class="list-inline-item">
                                                                    <a href="{{ route('site.category',['categorySlug' => $companyIsPremium['category']['slug'][$currentLang]]) }}">
                                                                        <img src="{{ asset("uploads/categories/".$companyIsPremium['category']['image']) }}" alt="{{$companyIsPremium['category']['title'][$currentLang]}}" style="max-height: 28px;!important;">
                                                                    </a>
                                                                </li>
                                                                @endif
                                                                <li class="list-inline-item"><a href="{{ route('site.category',['categorySlug' => $companyIsPremium['category']['slug'][$currentLang]]) }}">{{ $companyIsPremium['category']['title'][$currentLang] }}</a></li>
                                                            </ul>
                                                            <ul class="fp_meta float-right mb0">
                                                                <li class="list-inline-item"><a href="{{ route('site.companyDetails',['slug' => $companyIsPremium['slug']]) }}"><span class="flaticon-zoom" style="color:#777777;"></span> Daha ətraflı</a></li>

                                                                @if(!empty(auth('user')->user()->id))
                                                                <li class="list-inline-item">
                                                                    <a href="javascript:void(0);" class="like-btn icon"
                                                                       data-item-id="{{ $companyIsPremium['id'] }}"
                                                                       data-item-type="company"
                                                                       data-liked="{{ (!empty($companyIsPremium['userLikes']['user_id']) && $companyIsPremium['userLikes']['user_id'] == auth('user')->user()->id) ?? false }}">
                                                                        <span class="flaticon-love {{ (!empty($companyIsPremium['userLikes']['user_id']) && $companyIsPremium['userLikes']['user_id'] == auth('user')->user()->id)? 'active' : '' }}"></span>
                                                                    </a>
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
                                                        <div class="feat_property" >
                                                            <div class="thumb">
                                                                <img class="img-whp" style="width: 100%; max-height: 200px; object-fit: cover; border-radius: 8px; background-color: #f9f9f9;!important; object-fit: cover;" src="{{ asset("uploads/company/".$companyIsPremium['image']) }}" alt="fp1.jpg">
                                                                <div class="thmb_cntnt">
                                                                    <ul class="tag mb0">
                                                                        <li class="list-inline-item" style="background: radial-gradient(47.12% 309% at 47.12% 40.18%, rgba(254, 255, 134, 0.7) 0%, rgba(251, 206, 61, 0.7) 50.48%, rgba(132, 77, 32, 0.7) 100%); border:none !important;" ><a href="{{ route('site.companyDetails',['slug' => $companyIsPremium['slug']]) }}" style="font-size: 12px !important;">Premium</a></li>
                                                                    </ul>
                                                                    @if(!empty($companyIsPremium['comments']))
                                                                        <ul class="listing_reviews">
                                                                            <div class="list-inline-item sspd_review">
                                                                                    <?php
                                                                                    $comments = $companyIsPremium['comments'];

                                                                                    $avgCleanliness = round($comments->avg('cleanliness'), 1);
                                                                                    $avgComfort = round($comments->avg('comfort'), 1);
                                                                                    $avgStaff = round($comments->avg('staf'), 1);
                                                                                    $avgFacilities = round($comments->avg('facilities'), 1);
                                                                                    $overallAverage = round(collect([
                                                                                        $avgCleanliness, $avgComfort, $avgStaff, $avgFacilities
                                                                                    ])->filter()->avg(), 2);

                                                                                    $reviewCount = $comments->count();
                                                                                    ?>
                                                                                @php
                                                                                    $categories = [
                                                                                        'Təmizlik' => $avgCleanliness,
                                                                                        'Heyət' => $avgStaff,
                                                                                        'Rahatlıq' => $avgComfort,
                                                                                        'İmkanlar' => $avgFacilities,
                                                                                    ];

                                                                                    // ümumi cəm
                                                                                    $totalScore = array_sum($categories);

                                                                                    // neçə kateqoriya varsa
                                                                                    $count = count($categories);

                                                                                    // orta qiymət
                                                                                    $averageScore = $count > 0 ? $totalScore / $count : 0;
                                                                                @endphp

                                                                                <div class="rating-stars">
                                                                                    @for ($i = 1; $i <= 5; $i++)
                                                                                        <i class="fa fa-star{{ $i <= round($averageScore) ? '' : '-o' }}"></i>
                                                                                    @endfor
                                                                                </div>
                                                                            </div>
                                                                        </ul>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="details">
                                                                <div class="tc_content" style="height: 200px;">
                                                                    <h4><a href="{{ route('site.companyDetails',['slug' => $companyIsPremium['slug']]) }}">{{ $companyIsPremium['full_name'] }}</a></h4>
                                                                    <p style="width:90%;">{{ \Illuminate\Support\Str::limit($companyIsPremium['text'], 50, '...') }}</p>
                                                                    @php $data = $companyIsPremium['data']; @endphp
                                                                    <ul class="prop_details mb0">
                                                                        <li class="list-inline-item"><a href="tel:{{ $companyIsPremium['social']['one_phone'] ?? null }}"><span class="flaticon-phone pr5"></span> {{ $companyIsPremium['social']['one_phone'] ?? null }}</a></li>
                                                                        <li class="list-inline-item"><a><span class="flaticon-pin pr5"></span>{{ $data['address'] ?? '' }}</a></li>
                                                                    </ul>
                                                                </div>
                                                                <div class="fp_footer">
                                                                    <ul class="fp_meta float-left mb0">
                                                                        @if(!empty($companyIsPremium['category']['image']))
                                                                            <li class="list-inline-item">
                                                                                <a href="{{ route('site.category',['categorySlug' => $companyIsPremium['category']['slug'][$currentLang]]) }}">
                                                                                    <img src="{{ asset("uploads/categories/".$companyIsPremium['category']['image']) }}" alt="{{$companyIsPremium['category']['title'][$currentLang]}}" style="max-height: 28px;!important;">
                                                                                </a>
                                                                            </li>
                                                                        @endif
                                                                        <li class="list-inline-item"><a href="{{ route('site.category',['categorySlug' => $companyIsPremium['category']['slug'][$currentLang]]) }}">{{ $companyIsPremium['category']['title'][$currentLang] }}</a></li>
                                                                    </ul>
                                                                    <ul class="fp_meta float-right mb0">
                                                                        <li class="list-inline-item"><a href="{{ route('site.companyDetails',['slug' => $companyIsPremium['slug']]) }}"><span class="flaticon-zoom"></span> Daha ətraflı</a></li>

                                                                        @if(!empty(auth('user')->user()->id))
                                                                            <li class="list-inline-item">
                                                                                <a href="javascript:void(0);" class="like-btn icon"
                                                                                   data-item-id="{{ $companyIsPremium['id'] }}"
                                                                                   data-item-type="company"
                                                                                   data-liked="{{ (!empty($companyIsPremium['userLikes']['user_id']) && $companyIsPremium['userLikes']['user_id'] == auth('user')->user()->id) ?? false }}">
                                                                                    <span class="flaticon-love {{ (!empty($companyIsPremium['userLikes']['user_id']) && $companyIsPremium['userLikes']['user_id'] == auth('user')->user()->id)? 'active' : '' }}"></span>
                                                                                </a>
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
    @endif

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

{{--    <section class="our-blog bgc-f4 pb70">--}}
{{--        <div class="container">--}}
{{--            <div class="row">--}}
{{--                <div class="col-lg-6 offset-lg-3">--}}
{{--                    <div class="main-title text-center">--}}
{{--                        <h2>Ən son yeniliklər və anonslar</h2>--}}
{{--                        <p>Biz daima yenilənirik – yeni funksiyalar, təkmilləşdirilmiş dizayn və daha çox!</p>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="row">--}}
{{--                <div class="col-md-6 col-lg-4 col-xl-4">--}}
{{--                    <div class="for_blog feat_property">--}}
{{--                        <div class="thumb">--}}
{{--                            <img class="img-whp" src="{{ asset("site/images/blog/1.jpg") }}" alt="1.jpg">--}}
{{--                            <div class="tag bgc-thm2"><a class="text-white" href="#">Təqdimat çarxı</a></div>--}}
{{--                        </div>--}}
{{--                        <div class="details">--}}
{{--                            <div class="tc_content">--}}
{{--                                <div class="bp_meta">--}}
{{--                                    <ul>--}}
{{--                                        <li class="list-inline-item"><a href="https://nacaspia.com"><span class="flaticon-avatar mr10"></span>NACaspia Information Technologies</a></li>--}}
{{--                                        <li class="list-inline-item"><a href="#"><span class="flaticon-date mr10"></span> 01 Oktyabr, 2025</a></li>--}}
{{--                                    </ul>--}}
{{--                                </div>--}}
{{--                                <h4>Vurtut.com - Gələcəyin platforması</h4>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-md-6 col-lg-4 col-xl-4">--}}
{{--                    <div class="for_blog feat_property">--}}
{{--                        <div class="thumb">--}}
{{--                            <img class="img-whp" src="{{ asset("site/images/blog/1.jpg") }}" alt="2.jpg">--}}
{{--                            <div class="tag bgc-thm2"><a class="text-white" href="#">Yeni funksiya</a></div>--}}
{{--                        </div>--}}
{{--                        <div class="details">--}}
{{--                            <div class="tc_content">--}}
{{--                                <div class="bp_meta">--}}
{{--                                    <ul>--}}
{{--                                        <li class="list-inline-item"><a href="https://nacaspia.com"><span class="flaticon-avatar mr10"></span>NACaspia Information Technologies</a></li>--}}
{{--                                        <li class="list-inline-item"><a href="#"><span class="flaticon-date mr10"></span> 01 Dekabr, 2025</a></li>--}}
{{--                                    </ul>--}}
{{--                                </div>--}}
{{--                                <h4>Rezervasiya - funksiyası Vurtut-la daha rahat!</h4>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-md-6 col-lg-4 col-xl-4">--}}
{{--                    <div class="for_blog feat_property">--}}
{{--                        <div class="thumb">--}}
{{--                            <img class="img-whp" src="{{ asset("site/images/blog/1.jpg") }}" alt="3.jpg">--}}
{{--                            <div class="tag bgc-thm2"><a class="text-white" href="#">Anons</a></div>--}}
{{--                        </div>--}}
{{--                        <div class="details">--}}
{{--                            <div class="tc_content">--}}
{{--                                <div class="bp_meta">--}}
{{--                                    <ul>--}}
{{--                                        <li class="list-inline-item"><a href="https://nacaspia.com"><span class="flaticon-avatar mr10"></span>NACaspia Information Technologies</a></li>--}}
{{--                                        <li class="list-inline-item"><a href="#"><span class="flaticon-date mr10"></span> 07 Dekabr, 2025</a></li>--}}
{{--                                    </ul>--}}
{{--                                </div>--}}
{{--                                <h4>Canlı sifariş xidməti - 2026 ilə birlikdə gəlir!</h4>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </section>--}}

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
    <section class="divider bg-img5 parallax" data-stellar-background-ratio="0.2" style="background-position: 100% -715.433px">
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
