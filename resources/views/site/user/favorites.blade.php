@extends('site.user.layouts.app')
@section('user.css')
    <style>
        .flaticon-love.active {
            color: red;
        }
    </style>
@endsection
@section('user.content')
    <!-- Our Dashbord -->
    <section class="our-dashbord dashbord bgc-f4 pb70">
        <div class="container">
            <div class="row">
                @include('site.user.layouts.mobile-menu')
                <div class="col-lg-12 mb15">
                    <div class="breadcrumb_content style2">
                        <h2 class="breadcrumb_title float-left">Sevimlilər</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @if(!empty($likeCompanies[0]))
                    @foreach($likeCompanies as $like)
                        <div class="col-md-6 col-lg-4">
                            <div class="feat_property" style="height: 430px;">
                                <div class="thumb">
                                    <img class="img-whp"  style="width: 100%; max-height: 164px; object-fit: contain; border-radius: 8px; background-color: #f9f9f9;!important;" src="{{ asset("uploads/company/".$like['image']) }}" alt="{{ $like['full_name'] }}">
                                    <div class="thmb_cntnt">
                                        <ul class="tag mb0">
                                            @if($like['is_premium'] == 1)<li class="list-inline-item" style="background: radial-gradient(47.12% 309% at 47.12% 40.18%, rgba(254, 255, 134, 0.7) 0%, rgba(251, 206, 61, 0.7) 50.48%, rgba(132, 77, 32, 0.7) 100%); border:none !important;"><a href="{{ route('site.companyDetails',['slug' => $like['slug']]) }}" > Premium </a></li>@endif
                                        </ul>
                                        <ul class="listing_reviews">
                                            <li class="list-inline-item"><a class="text-white" href="{{ route('site.companyDetails',['slug' => $like['slug']]) }}"><span class="fa fa-star"></span></a></li>
                                            <li class="list-inline-item"><a class="text-white" href="{{ route('site.companyDetails',['slug' => $like['slug']]) }}"><span class="fa fa-star"></span></a></li>
                                            <li class="list-inline-item"><a class="text-white" href="{{ route('site.companyDetails',['slug' => $like['slug']]) }}"><span class="fa fa-star"></span></a></li>
                                            <li class="list-inline-item"><a class="text-white" href="{{ route('site.companyDetails',['slug' => $like['slug']]) }}"><span class="fa fa-star"></span></a></li>
                                            <li class="list-inline-item"><a class="text-white" href="{{ route('site.companyDetails',['slug' => $like['slug']]) }}"><span class="fa fa-star"></span></a></li>
                                            <li class="list-inline-item"><a class="text-white total_review" href="{{ route('site.companyDetails',['slug' => $like['slug']]) }}">({{count($like['comments']) ?? 0}} Rəy)</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="details">
                                    <div class="tc_content">
{{--                                        <div class="badge_icon"><a href="{{ route('site.companyDetails',['slug' => $like['slug']]) }}"><img src="{{ asset("site/images/icons/agent1.svg") }}" alt="agent1.svg"></a></div>--}}
                                        <h4>{{ $like['full_name'] }}</h4>
                                        <p>{{ \Illuminate\Support\Str::limit($like['text'], 50, '...') }}</p>
                                        @php
                                            $data = $like['data'];
                                        @endphp
                                        <ul class="prop_details mb0">
                                            <li class="list-inline-item"><a href="tel:{{ $like['phone'] }}"><span class="flaticon-phone pr5"></span> {{ $like['phone'] }}</a></li>
                                            <li class="list-inline-item"><a href="{{ route('site.companyDetails',['slug' => $like['slug']]) }}"><span class="flaticon-pin pr5"></span>{{ $data['address'] ?? null }}</a></li>
                                        </ul>
                                    </div>
                                    <div class="fp_footer">
                                        <ul class="fp_meta float-left mb0">
                                            @if(!empty($like['category']['image']))
                                                <li class="list-inline-item">
                                                    <a href="{{ route('site.companyDetails',['slug' => $like['slug']]) }}">
                                                        <img src="{{ asset("uploads/categories/".$like['category']['image']) }}" alt="{{$like['category']['title'][$currentLang]}}">
                                                    </a>
                                                </li>
                                            @endif
                                            <li class="list-inline-item"><a href="{{ route('site.companyDetails',['slug' => $like['slug']]) }}">{{ $like['category']['title'][$currentLang] }}</a></li>
                                        </ul>
                                        <ul class="fp_meta float-right mb0">
                                            <li class="list-inline-item"><a href="{{ route('site.companyDetails',['slug' => $like['slug']]) }}"><span class="flaticon-zoom"></span> Daha ətraflı</a></li>
                                            <li class="list-inline-item">
                                                <a href="javascript:void(0);" class="like-btn icon"
                                                   data-item-id="{{ $like['id'] }}"
                                                   data-item-type="company"
                                                   data-liked="{{ (!empty($like['user_id']) && $like['user_id'] == auth('user')->user()->id) ?? false }}">
                                                    <span class="flaticon-love {{ (!empty($like['user_id']) && $like['user_id'] == auth('user')->user()->id)? 'active' : '' }}"></span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
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
