@extends('site.user.layouts.app')
@section('user.css')
    <style>
        .flaticon-love.active {
            color: red;
        }
    </style>
@endsection
@section('user.content')
    <!-- Hazirdi -->
    <section class="our-dashbord dashbord bgc-f4">
        <div class="container">
            <div class="row">
                @include('site.user.layouts.mobile-menu')
                <div class="col-lg-9">
                    <div class="author_content">
                        <div class="author_thumb float-left fn-xsd mr20">
                            <img style="max-width: 115px;!important;" src="{{ !empty($user->image)? asset("uploads/user/".$user->image): asset('site/images/Vurtut logo icon/account.png') }}" alt="author2.png">
                        </div>
                        <div class="author_details">
                            <h2 class="author_title">{{$user->full_name}}</h2>
                        </div>
                    </div>
                    @if(!empty($user->bio ))
                    <div class="listing_single_description mb60">
                        <h4 class="mb30">{{$user->bio ?? ''}}</h4>
{{--                        <p class="first-para mb25"></p>--}}
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <section class="feature-property bgc-f4">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="main-title text-center">
                        <h2>Ən son ziyarət edilənlər</h2>
                        <p>Ən son ziyarət etdiyiniz müəssisələri buradan izləyə bilərsiniz.</p>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="popular_listing_slider1">
                        @if(!empty($user['userLikes'][0]))
                            @foreach($user['userLikes'] as $like)
                                <div class="item">
                                    <div class="feat_property" style="min-height: 404px;max-height: 404px;!important;">
                                        <div class="thumb">
                                            <img class="img-whp" style="width: 100%; max-height: 164px; object-fit: contain; border-radius: 8px; background-color: #f9f9f9;!important;" src="{{ asset("uploads/company/".$like['companyItem']['image']) }}" alt="{{ $like['companyItem']['full_name'] }}">
                                            <div class="thmb_cntnt">
                                                <ul class="tag mb0">
                                                    @if($like['companyItem']['is_premium'] == 1)<li class="list-inline-item"><a href="{{ route('site.companyDetails',['slug' => $like['companyItem']['slug']]) }}"> PEMIUM </a></li>@endif
                                                    {{--                                            <li class="list-inline-item"><a href="#">Open</a></li>--}}
                                                </ul>
                                                <ul class="listing_reviews">
                                                    <li class="list-inline-item"><a class="text-white" href="#"><span class="fa fa-star"></span></a></li>
                                                    <li class="list-inline-item"><a class="text-white" href="#"><span class="fa fa-star"></span></a></li>
                                                    <li class="list-inline-item"><a class="text-white" href="#"><span class="fa fa-star"></span></a></li>
                                                    <li class="list-inline-item"><a class="text-white" href="#"><span class="fa fa-star"></span></a></li>
                                                    <li class="list-inline-item"><a class="text-white" href="#"><span class="fa fa-star"></span></a></li>
                                                    <li class="list-inline-item"><a class="text-white total_review" href="{{ route('site.companyDetails',['slug' => $like['companyItem']['slug']]) }}">({{count($like['companyItem']['comments']) ?? 0}} Rəy)</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="details">
                                            <div class="tc_content">
                                                <div class="badge_icon"><a href="{{ route('site.companyDetails',['slug' => $like['companyItem']['slug']]) }}"><img src="{{ asset("site/images/icons/agent1.svg") }}" alt="agent1.svg"></a></div>
                                                <h4>{{ $like['companyItem']['full_name'] }}</h4>
                                                <p>{{ \Illuminate\Support\Str::limit($like['companyItem']['text'], 50, '...') }}</p>
                                                @php
                                                    $data = $like['companyItem']['data'];
                                                @endphp
                                                <ul class="prop_details mb0">
                                                    <li class="list-inline-item"><a href="tel:{{ $like['companyItem']['phone'] }}"><span class="flaticon-phone pr5"></span> {{ $like['companyItem']['phone'] }}</a></li>
                                                    <li class="list-inline-item"><a href="#"><span class="flaticon-pin pr5"></span>{{ $data['address'] ?? null }}</a></li>
                                                </ul>
                                            </div>
                                            <div class="fp_footer">
                                                <ul class="fp_meta float-left mb0">
                                                    @if(!empty($like['companyItem']['category']['image']))
                                                        <li class="list-inline-item">
                                                            <a href="{{ route('site.companyDetails',['slug' => $like['companyItem']['slug']]) }}">
                                                                <img src="{{ asset("uploads/categories/".$like['companyItem']['category']['image']) }}" alt="{{$like['companyItem']['category']['title'][$currentLang]}}">
                                                            </a>
                                                        </li>
                                                    @endif
                                                    <li class="list-inline-item"><a href="{{ route('site.companyDetails',['slug' => $like['companyItem']['slug']]) }}">{{ $like['companyItem']['category']['title'][$currentLang] }}</a></li>
                                                </ul>
                                                <ul class="fp_meta float-right mb0">
                                                    <a href="javascript:void(0);" class="like-btn icon"
                                                       data-item-id="{{ $like['companyItem']['id'] }}"
                                                       data-item-type="company"
                                                       data-liked="{{ (!empty($like['user_id']) && $like['user_id'] == auth('user')->user()->id) ?? false }}">
                                                        <span class="flaticon-love {{ (!empty($like['user_id']) && $like['user_id'] == auth('user')->user()->id)? 'active' : '' }}"></span>
                                                    </a>
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
@section('user.js')
    <script>
        $(document).on('click', '.like-btn', function (e) {
            e.preventDefault();

            const $btn = $(this);
            const itemId = $btn.data('item-id');
            const itemType = $btn.data('item-type');
            const isLiked = $btn.data('liked');
            const url = '{{ route('site.user.unlike') }}';

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
                        window.location.reload();
                    }
                },
                error: function (xhr) {
                    alert('Əməliyyatda xəta baş verdi.');
                }
            });
        });

    </script>
@endsection
