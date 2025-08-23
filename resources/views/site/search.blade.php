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
@endsection
@section('site.content')
    <!-- 6th Home Design -->
    <section class="listing-home-bg parallax pt30-520" data-stellar-background-ratio="0.2">
        <div class="container">
            <div class="row posr">
                <div class="col-lg-12">
                    <div class="paralax_home_search_content mt50 mt0-767">
                        <div class="home-text text-center">
                            <h2 class="fz50">SƏNİN ŞƏHƏRİN, SƏNİN SEÇİMLƏRİN!</h2>
                            <p class="fz18 color-white">Ən yaxşısını axtarırsansa, doğru yerdəsən, işinin ən yaxşıları bizimlədir - seç, müqayisə et və məkanını tap!</p>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-lg-10 col-xl-8">
                                <div class="home_adv_srch_opt text-center mt0-767">
                                    <div class="wrapper">
                                        <div class="home_adv_srch_form">
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

    <!-- Listing Grid View -->
    <section class="our-listing pb30-991">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        @if(!empty($companies[0]))
                            @foreach($companies as $company)
                                <div class="col-md-6 col-lg-6">
                                    <div class="feat_property"{{-- style="min-height: 404px;max-height: 404px;!important;"--}}>
                                        <div class="thumb">
                                            <img class="img-whp" style="width: 100%; max-height: 164px; object-fit: contain; border-radius: 8px; background-color: #f9f9f9;!important;" src="{{ asset("uploads/company/".$company['image']) }}" alt="{{ $company['full_name'] }}">
                                            <div class="thmb_cntnt">
                                                <ul class="tag mb0">
                                                    @if($company['is_premium'] == 1)<li class="list-inline-item"><a href="{{ route('site.companyDetails',['slug' => $company['slug']]) }}"> PEMIUM </a></li>@endif
                                                </ul>
                                                <ul class="listing_reviews">
                                                    <li class="list-inline-item"><a class="text-white"><span class="fa fa-star"></span></a></li>
                                                    <li class="list-inline-item"><a class="text-white"><span class="fa fa-star"></span></a></li>
                                                    <li class="list-inline-item"><a class="text-white"><span class="fa fa-star"></span></a></li>
                                                    <li class="list-inline-item"><a class="text-white"><span class="fa fa-star"></span></a></li>
                                                    <li class="list-inline-item"><a class="text-white"><span class="fa fa-star"></span></a></li>
                                                    <li class="list-inline-item"><a class="text-white total_review">({{count($company['comments'])}} Rəy)</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="details">
                                            <div class="tc_content">
                                                <h4>
                                                    <a href="{{ route('site.companyDetails',['slug' => $company['slug']]) }}">
                                                        {{ $company['full_name'] }}
                                                    </a>
                                                </h4>
                                                <p>{{ \Illuminate\Support\Str::limit($company['text'], 50, '...') }}</p>
                                                @php
                                                    $data = $company['data'];
                                                @endphp
                                                <ul class="prop_details mb0">
                                                    <li class="list-inline-item"><a href="tel:{{ $company['one_phone']?? $company['phone'] }}"><span class="flaticon-phone pr5"></span> {{ $company['one_phone'] ?? $company['phone'] }}</a></li>
                                                    <li class="list-inline-item"><a><span class="flaticon-pin pr5"></span>{{ $data['address'] ?? null }}</a></li>
                                                </ul>
                                            </div>
                                            <div class="fp_footer">
                                                <ul class="fp_meta float-left mb0">
                                                    @if(!empty($company['category']['image']))
                                                        <li class="list-inline-item">
                                                            <a href="{{ route('site.category',['categorySlug' => $company['category']['slug'][$currentLang]]) }}">
                                                                <img src="{{ asset("uploads/categories/".$company['category']['image']) }}" alt="{{$company['category']['title'][$currentLang] ?? ''}}" style="max-height: 28px;!important;">
                                                            </a>
                                                        </li>
                                                    @endif
                                                    <li class="list-inline-item"><a href="{{ route('site.category',['categorySlug' => $company['category']['slug'][$currentLang]]) }}">{{$company['category']['title'][$currentLang] ?? ''}}</a></li>
                                                </ul>
                                                <ul class="fp_meta float-right mb0">
                                                    <li class="list-inline-item"><a href="{{ route('site.companyDetails',['slug' => $company['slug']]) }}"><span class="flaticon-zoom"></span> Daha ətraflı</a></li>
                                                    @if(!empty(auth('user')->user()->id))
                                                        <li class="list-inline-item">
                                                            <a href="javascript:void(0);" class="like-btn icon"
                                                               data-item-id="{{ $company['id'] }}"
                                                               data-item-type="company"
                                                               data-liked="{{ (!empty($company['userLikes']['user_id']) && $company['userLikes']['user_id'] == auth('user')->user()->id) ?? false }}">
                                                                <span class="flaticon-love {{ (!empty($company['userLikes']['user_id']) && $company['userLikes']['user_id'] == auth('user')->user()->id)? 'active' : '' }}"></span>
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
