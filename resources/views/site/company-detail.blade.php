@extends('site.layouts.app')
@section('site.title')
    @lang('site.home')
@endsection
@section('site.css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Solid icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="{{ asset("site/css/bootstrap.min.css") }}">
    <link rel="stylesheet" href="{{ asset("site/css/style.css") }}">
    <link rel="stylesheet" href="{{ asset("site/css/responsive.css") }}">
@endsection
@section('site.content')
    <!-- Listing Single Property -->
    <section class="listing-title-area pb50">
        <div class="container">
            <div class="row mb30">
                <div class="col-xl-7">
                    <div class="single_property_title mt30-767">
                        <div class="media">
                            <img class="mr-3"
                                 src="{{ !empty($company->image)? asset("uploads/company/".$company->image): asset('site/images/Vurtut logo icon/account.png') }}"
                                 alt="{{$company->full_name}} - vurtut.com"
                                 style="width:145px; height:145px; border-radius:50%; object-fit:cover; display:block; margin-bottom:10px;"
                                 oading="lazy">
                            <div class="media-body mt20">
                                <h2 class="mt-0">{{$company->full_name}}
                                    ({{ $company['type'] === 'main'? 'Əsas Filial': 'Filial' }})</h2>
                                <ul class="mb0 agency_profile_contact">
                                    @if(!empty($company['social']['one_phone']))
                                    <li class="list-inline-item"><a href="tel:{{$company['social']['one_phone']}}"><span
                                                class="flaticon-phone"></span> {{ !empty($company['social']['one_phone'])? $company['social']['one_phone']: null }}
                                        </a></li>
                                    @endif
                                    @if(!empty($company['social']['two_phone']))
                                    <li class="list-inline-item"><a href="tel:{{$company['social']['two_phone']}}"><span
                                                class="flaticon-phone"></span> {{ !empty($company['social']['two_phone'])? $company['social']['two_phone']: null }}
                                        </a></li>
                                    @endif
                                    <li class="list-inline-item"><a href="#"><span
                                                class="flaticon-pin"></span> {{ $company->mainCities['name'][$currentLang] }} @if(!empty($company->subRegion['name'][$currentLang]))
                                                / {{ $company->subRegion['name'][$currentLang] }}
                                            @endif</a></li>

                                    @if(!empty($company['comments']))
                                        <div class="list-inline-item sspd_review">
                                                <?php
                                                $comments = $company['comments'];

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
                                                $categoriesType = [
                                                    'Təmizlik' => $avgCleanliness,
                                                    'Heyət' => $avgStaff,
                                                    'Rahatlıq' => $avgComfort,
                                                    'İmkanlar' => $avgFacilities,
                                                ];

                                                // ümumi cəm
                                                $totalScore = array_sum($categoriesType);

                                                // neçə kateqoriya varsa
                                                $count = count($categoriesType);

                                                // orta qiymət
                                                $averageScore = $count > 0 ? $totalScore / $count : 0;
                                            @endphp

                                            <div class="rating-stars">
                                                @for ($i = 1; $i <= 5; $i++)
                                                    <i class="fa fa-star{{ $i <= round($averageScore) ? '' : '-o' }}"></i>
                                                @endfor
                                            </div>
                                        </div>
                                    @endif
                                    <div class="list-inline-item"><i class="fa fa-street-view"></i> {{ $company['reads'] }} </div>
                                    <div class="list-inline-item"><i class="fa fa-comment"></i> {{ count($company['comments']) }} </div>
                                    <div class="list-inline-item"><i class="fa fa-share"></i> {{  $company['share'] }} </div>
                                    @if($company['is_premium'] ==1)
                                        <li class="list-inline-item"><a class="price_range" href="#">PREMIUM</a></li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-5">
                    <div class="single_property_social_share">
                        <div class="spss style2 mt30 float-right fn-lg">
                            <ul class="mb0">
                                <li class="list-inline-item icon">
                                    <a href="#" class="shareBtn" data-id="{{ $company->id }}"><span
                                            class="flaticon-upload"></span></a>
                                </li>
                                @if(!empty(auth('user')->user()->id))
                                    <li class="list-inline-item icon">
                                        <a href="javascript:void(0);" class="like-btn icon"
                                           data-item-id="{{ $company['id'] }}"
                                           data-item-type="company"
                                           data-liked="{{ (!empty($company['userLikes']['user_id']) && $company['userLikes']['user_id'] == auth('user')->user()->id) ?? false }}">
                                            <span
                                                class="flaticon-love {{ (!empty($company['userLikes']['user_id']) && $company['userLikes']['user_id'] == auth('user')->user()->id)? 'active' : '' }}"></span>
                                        </a>
                                        {{--                                                                    <a class="icon" href="#"><span class="flaticon-love"></span></a>--}}
                                    </li>
                                @endif
                            </ul>
                        </div>
                        {{--<div class="price mt25 float-right fn-lg">
                            <a href="#" class="btn btn-thm spr_btn">Submit Reveiw</a>
                        </div>--}}
                    </div>
                </div>
            </div>
            @if(!empty($company['posts'][0]))
                <div class="row">
                    <div class="col-md-7 col-lg-8">
                        <div class="row">
                            <div class="col-lg-12 pl0 pr0 pl15-767 pr15-767">
                                <div class="spls_style_two mb30-767">
                                    <a class="popup-img"
                                       href="{{ asset('uploads/company-posts/'.$company['posts'][0]['image']) }}">
                                        <img class="img-fluid w100"
                                             src="{{ asset('uploads/company-posts/'.$company['posts'][0]['image']) }}"
                                             alt="1.jpg">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5 col-lg-4">
                        <div class="row">
                            @foreach($company['posts'] as $index => $image)
                                @if($index < 7)
                                    {{-- İlk 7 şəkli normal göstər --}}
                                    <div class="col-sm-4 col-md-6 col-lg-6 pr5 pr15-767">
                                        <div class="spls_style_two mb10">
                                            <a class="popup-img"
                                               href="{{ asset('uploads/company-posts/'.$image['image']) }}">
                                                <img class="img-fluid w100"
                                                     src="{{ asset('uploads/company-posts/'.$image['image']) }}"
                                                     alt="img{{ $index + 1 }}">
                                            </a>
                                        </div>
                                    </div>
                                @elseif($index == 7)
                                    {{-- 8-ci şəkil + overlay (əgər qalan varsa) --}}
                                    <div class="col-sm-4 col-md-6 col-lg-6 pr5 pr15-767">
                                        <div class="spls_style_two mb10 position-relative">
                                            <a class="popup-img"
                                               href="{{ asset('uploads/company-posts/'.$image['image']) }}">
                                                <img class="img-fluid w100"
                                                     src="{{ asset('uploads/company-posts/'.$image['image']) }}"
                                                     alt="img{{ $index + 1 }}">
                                                @php
                                                    $remaining = count($company['posts']) - 6;
                                                @endphp
                                                @if($remaining > 0)
                                                    <div class="overlay popup-img"
                                                         style="position:absolute; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.5); display:flex; justify-content:center; align-items:center; color:#fff;">
                                                        <h3 class="title">+{{ $remaining }}</h3>
                                                    </div>
                                                @endif
                                            </a>
                                        </div>
                                    </div>
                                @else
                                    {{-- 9-cu və sonrakılar göstərilməsin --}}
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>

    <!-- Agent Single Grid View -->
    <section class="our-agent-single pt0 pb30-991">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-lg-8">
                    <div class="row">
                        <div class="col-lg-12 pl0 pr0 pl15-767">
                            <div class="listing_single_description mb60">
                                <h4 class="mb30">Bioqrafiya</h4>
                                <p class="first-para mb25">{!! $company['text'] ?? '' !!}</p>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="additional_details mb30">
                                <div class="row">
                                    <div class="col-lg-12 pl0 pr0 pl15-767">
                                        <h4 class="mb30">Xüsusiyyətlər</h4>
                                    </div>
                                    @if(!empty($serviceTypes[0]) && !empty($company['service_type']))
                                        @foreach($serviceTypes as $serviceType)
                                            @if(in_array($serviceType->id, $company['service_type']))
                                                <div class="col-md-6 col-lg-6 col-xl-4 pl0 pr0 pl15-767">
                                                    <div class="listing_feature_iconbox mb30">
                                                        <div class="icon float-left mr10">
                                                            @if(!empty($serviceType['icon']))
                                                                {!! $serviceType['icon'] !!}
                                                            @else
                                                                <i class="fas fa-smoking"></i>
                                                            @endif
                                                        </div>
                                                        <div class="details">
                                                            <div
                                                                class="title">{{ $serviceType['name'][$currentLang] }}</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="popular_listing_sliders row">
                                <!-- Nav tabs -->
                                <div class="nav nav-tabs mb50 col-lg-12 justify-content-center" role="tablist">

                                    @if(!empty($categories[0]))
                                        @foreach($categories as $catKey=>$category)
                                            <a class="nav-link @if(++$catKey ==1) active @endif"
                                               id="nav-{{$category['slug'][$currentLang]}}-tab" data-toggle="tab"
                                               href="#nav-{{$category['slug'][$currentLang]}}" role="tab"
                                               aria-controls="nav-{{$category['slug'][$currentLang]}}"
                                               aria-selected=" @if(++$catKey==1) true @else false @endif">{{$category['title'][$currentLang]}}</a>
                                        @endforeach
                                    @endif
                                </div>

                                <!-- Tab panes -->
                                <div class="tab-content col-lg-12" id="nav-tabContent">
                                    @if(!empty($categories[0]))
                                        @foreach($categories as $catKey=>$category)
                                            <div class="tab-pane fade  @if(++$catKey==1) show active @endif"
                                                 id="nav-{{$category['slug'][$currentLang]}}" role="tabpanel"
                                                 aria-labelledby="nav-{{$category['slug'][$currentLang]}}-tab">
                                                <div class="popular_listing_slider1">
                                                    @if(!empty($category['companyServices'][0]))
                                                        @foreach($category['companyServices'] as $service)
                                                            <div class="col-lg-12">
                                                                <div class="shop_grid">
                                                                    <div class="thumb">
                                                                        <img class="img-fluid"
                                                                             src="{{ asset('uploads/company-services/'.$service['image']) }}"
                                                                             alt="1.png"
                                                                             style="min-height: 145px;max-height: 145px;!important;">
                                                                    </div>
                                                                    <div class="details">
                                                                        <div class="price_content">
                                                                            <h5 class="item-tile">{{$service['title']}}</h5>
                                                                            <p class="price">{{$service['price']}} AZN</p>
                                                                        </div>
                                                                        <button class="btn btn-block btn-thm viewProductDetail"
                                                                            data-toggle="modal"
                                                                            data-target="#productInfoModal"
                                                                            data-category="{{$service['subCategory']['title'][$currentLang]}}"
                                                                            @if(!empty($service['person']))
                                                                                data-person-image="{{ asset('uploads/company-persons/'.$service['person']['image']) }}"
                                                                                data-person="{{$service['person']['name'] ?? null}}"
                                                                                data-age="{{$service['person']['age'] ?? ''}}"
                                                                                data-experience="{{$service['person']['experience'] ?? null}}"
                                                                                data-person-description="{{$service['person']['text'] ?? null}}"
                                                                            @endif
                                                                            data-name="{{$service['title']}}" data-price="{{$service['price']}}"
                                                                            data-description="{{$service['description']}}"
                                                                            data-image="{{ asset('uploads/company-services/'.$service['image']) }}">
                                                                            <span class="flaticon-view"></span> Ətraflı
                                                                            Ətraflı
                                                                        </button>
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
                        @if(!empty($company['comments'][0]))
                                <?php
                                $comments = $company['comments'];

                                $avgCleanliness = round($comments->avg('cleanliness'), 1);
                                $avgComfort = round($comments->avg('comfort'), 1);
                                $avgStaff = round($comments->avg('staf'), 1);
                                $avgFacilities = round($comments->avg('facilities'), 1);
                                $overallAverage = round(collect([
                                    $avgCleanliness, $avgComfort, $avgStaff, $avgFacilities
                                ])->filter()->avg(), 2);

                                $reviewCount = $comments->count();
                                ?>
                            <div class="col-lg-12 pl0 pl15-767">
                                <div class="custom_reivews mt30 mb30 row">
                                    <div class="col-lg-12">
                                        <h4 class="mb25">{{ $overallAverage }} ({{ $reviewCount }} rəy)</h4>
                                    </div>
                                    @php
                                        $categoriesType = [
                                            'Təmizlik' => $avgCleanliness,
                                            'Heyət' => $avgStaff,
                                            'Rahatlıq' => $avgComfort,
                                            'İmkanlar' => $avgFacilities,
                                        ];
                                    @endphp

                                    @foreach($categoriesType as $title => $score)
                                        <div class="col-lg-3 col-md-6 mb-3 d-flex align-items-center">
                                            <div class="me-2" style="width: 90px;">{{ $title }}</div>
                                            <div class="rating-stars">
                                                @for ($i = 1; $i <= 5; $i++)
                                                    <i class="fa fa-star{{ $i <= round($score) ? '' : '-o' }}"></i>
                                                @endfor
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <div class="col-lg-12 pl0 pl15-767">
                                <div class="listing_single_reviews">
                                    <div class="product_single_content mb30">
                                        @foreach($company['comments'] as $comment)
                                            <div class="mbp_first media">
                                                <img style="max-width: 10%;!important;"
                                                     src="{{ !empty($comment['users']->image)? asset("uploads/user/".$comment['users']->image): asset('site/images/Vurtut logo icon/account.png') }}"
                                                     class="mr-3"
                                                     alt="reviewer2.png">
                                                <div class="media-body">
                                                    <h4 class="sub_title mt-0">{{ $comment['users']->full_name }}</h4>
                                                    <div
                                                        class="sspd_postdate fz14 mb20">{{ \Carbon\Carbon::parse($comment->created_at)->format('Y-m-d H:i') }}
                                                        <div class="sspd_review pull-right">
                                                            <ul class="mb0 pl15">
                                                                @php
                                                                    $rating = round(($comment->cleanliness + $comment->comfort + $comment->staff + $comment->facilities) / 4);
                                                                @endphp

                                                                @for ($i = 1; $i <= 5; $i++)
                                                                    <li class="list-inline-item">
                                                                        <a href="#">
                                                                            <i class="fa fa-star fa-star-m{{ $i <= $rating ? '' : '-o' }}"></i>
                                                                        </a>
                                                                    </li>
                                                                @endfor
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <p class="fz14 mt10">{!! $comment['comment'] !!}</p>
                                                    @if(!empty(auth('company')->user()->id) && auth('company')->user()->id == $company['id'] && $comment->committer->count() == 0)
                                                        <a class="text-thm tdu reply-btn" href="#"
                                                           data-id="{{ $comment['id'] }}">Cavablandır</a>
                                                        <!-- Cavab form konteyneri -->
                                                        <div class="reply-form mt-3 d-none"></div>
                                                    @endif
                                                    @if ($comment->committer->count())
                                                        @foreach ($comment->committer as $reply)
                                                            <br>
                                                            <div class="mbp_first media">
                                                                <img style="max-width: 10%;!important;"
                                                                     src="{{ !empty($comment['company']->image)? asset("uploads/company/".$comment['company']->image): asset('site/images/Vurtut logo icon/account.png') }}"
                                                                     class="mr-3"
                                                                     alt="{{ $reply->company->full_name }}">
                                                                <div class="media-body">
                                                                    <h4 class="sub_title mt-0">{{ $reply->company->full_name }}</h4>
                                                                    <div
                                                                        class="sspd_postdate fz14 mb20">{{ \Carbon\Carbon::parse($reply->created_at)->format('Y-m-d H:i') }}

                                                                    </div>
                                                                    <p class="fz14 mt10">{{ $reply->comment }}</p>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    @endif
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if(!empty(auth('user')->user()->id) && auth('user')->user()->id != $company['comments']->last()?->users->id)
                            <div class="col-lg-12 pl0 pl15-767">
                                <div class="single_page_review_form p30-lg mb30-991">
                                    <div class="wrapper">
                                        <h4>Rəy bildir</h4>
                                        <form class="review_form">
                                            <input type="hidden" id="company_id" name="company_id"
                                                   value="{{ $company['id'] }}">
                                            <input type="hidden" id="user_id" name="user_id"
                                                   value="{{ auth('user')->user()->id }}">
                                            <input type="hidden" name="cleanliness" id="cleanliness" value="0">
                                            <input type="hidden" name="comfort" id="comfort" value="0">
                                            <input type="hidden" name="staff" id="staff" value="0">
                                            <input type="hidden" name="facilities" id="facilities" value="0">
                                            <div class="custom_reivews row mt40 mb30">
                                                <div class="col-lg-2 pr0">
                                                    <div class="title">Təmizlik</div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="review_star text-right">
                                                        <ul>
                                                            <li class="list-inline-item"><a href="#"><i
                                                                        class="fa fa-star"></i></a></li>
                                                            <li class="list-inline-item"><a href="#"><i
                                                                        class="fa fa-star"></i></a></li>
                                                            <li class="list-inline-item"><a href="#"><i
                                                                        class="fa fa-star"></i></a></li>
                                                            <li class="list-inline-item"><a href="#"><i
                                                                        class="fa fa-star"></i></a></li>
                                                            <li class="list-inline-item"><a href="#"><i
                                                                        class="fa fa-star"></i></a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2 pr0">
                                                    <div class="title">Rahatlıq</div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="review_star text-right">
                                                        <ul>
                                                            <li class="list-inline-item"><a href="#"><i
                                                                        class="fa fa-star"></i></a></li>
                                                            <li class="list-inline-item"><a href="#"><i
                                                                        class="fa fa-star"></i></a></li>
                                                            <li class="list-inline-item"><a href="#"><i
                                                                        class="fa fa-star"></i></a></li>
                                                            <li class="list-inline-item"><a href="#"><i
                                                                        class="fa fa-star"></i></a></li>
                                                            <li class="list-inline-item"><a href="#"><i
                                                                        class="fa fa-star"></i></a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2 pr0">
                                                    <div class="title">Heyət</div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="review_star text-right">
                                                        <ul>
                                                            <li class="list-inline-item"><a href="#"><i
                                                                        class="fa fa-star"></i></a></li>
                                                            <li class="list-inline-item"><a href="#"><i
                                                                        class="fa fa-star"></i></a></li>
                                                            <li class="list-inline-item"><a href="#"><i
                                                                        class="fa fa-star"></i></a></li>
                                                            <li class="list-inline-item"><a href="#"><i
                                                                        class="fa fa-star"></i></a></li>
                                                            <li class="list-inline-item"><a href="#"><i
                                                                        class="fa fa-star"></i></a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2 pr0">
                                                    <div class="title">İmkanlar</div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="review_star text-right">
                                                        <ul>
                                                            <li class="list-inline-item"><a href="#"><i
                                                                        class="fa fa-star"></i></a></li>
                                                            <li class="list-inline-item"><a href="#"><i
                                                                        class="fa fa-star"></i></a></li>
                                                            <li class="list-inline-item"><a href="#"><i
                                                                        class="fa fa-star"></i></a></li>
                                                            <li class="list-inline-item"><a href="#"><i
                                                                        class="fa fa-star"></i></a></li>
                                                            <li class="list-inline-item"><a href="#"><i
                                                                        class="fa fa-star"></i></a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                            <textarea class="form-control" id="commit" name="commit" rows="7"
                                                      placeholder="Sənin rəyin"></textarea>
                                                <div class="invalid-feedback d-none" id="commitError"></div>
                                            </div>
                                            <button type="submit" class="btn btn-thm">Göndər</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-lg-4 col-xl-4">
                    <div class="listing_single_sidebar">
                        <div class="lss_contact_location ">
                            <h4 class="mb25">Ünvan / Əlaqə məlumatları</h4>
                            <div class="sidebar_map mb30">
                                <div class="lss_map h200" id="map-canvas"></div>
                            </div>
                            <ul class="contact_list list-unstyled mb15">
                                <li class="df"><span
                                        class="flaticon-pin mr15"></span>{!! $company['data']['address'] ?? '' !!}</li>
                                @if(!empty($company['social']['one_phone']))
                                    <li><span class="flaticon-phone mr15"></span><a
                                            href="tel:{{ $company['social']['one_phone'] }}">{{ $company['social']['one_phone'] }}</a>
                                    </li>
                                @endif
                                @if(!empty($company['social']['two_phone']))
                                    <li><span class="flaticon-phone mr15"></span><a
                                            href="tel:{{ $company['social']['two_phone'] }}">{{ $company['social']['two_phone'] }}</a>
                                    </li>
                                @endif
                                @if(!empty($company['social']['one_email']))
                                    <li><span class="flaticon-email mr15"></span><a
                                            href="mailto:{{ $company['social']['one_email'] }}">{{ $company['social']['one_email'] }}</a>
                                    </li>
                                @endif
                            </ul>
                            <ul class="sidebar_social_icon mb0">
                                @if(!empty($company['social']['facebook']))
                                    <li class="list-inline-item"><a href="{{$company['social']['facebook']}}"><i
                                                class="fa fa-facebook"></i></a></li>
                                @endif
                                @if(!empty($company['social']['linkedin']))
                                    <li class="list-inline-item"><a href="{{$company['social']['linkedin']}}"><i
                                                class="fa fa-linkedin"></i></a></li>
                                @endif
                                @if(!empty($company['social']['instagram']))
                                    <li class="list-inline-item"><a href="{{$company['social']['instagram']}}"><i
                                                class="fa fa-instagram"></i></a></li>
                                @endif
                                @if(!empty($company['social']['tiktok']))
                                    <li class="list-inline-item"><a href="{{$company['social']['tiktok']}}">T</a></li>
                                @endif
                            </ul>
                        </div>
                        <div class="sidebar_opening_hour_widget pb20">
                            <h4 class="title mb15">İşləmə<small class="float-right">@if(!empty($company['time']['is_247']))  7 / 24 @endif</small></h4>
                            @if(empty($company['time']['is_247']))
                            <ul class="list_details mb0">
                                @foreach(['Mon','Tue','Wed','Thu','Fri','Sat','Sun'] as $key => $day)
                                    @php
                                        $type = $company['time'][$day]['hours_type'] ?? 2;
                                        $start = $company['time'][$day]['start'] ?? '00:00';
                                        $end = $company['time'][$day]['end'] ?? '23:59';
                                        $date = 'Bağlı';
                                        if ($type == 1) {
                                            $date = $start .' - '. $end ;
                                        }
                                    @endphp
                                    <li><a href="#">@lang('site.'.$day) <span class="float-right">{{$date}}</span></a>
                                    </li>
                                @endforeach
                            </ul>
                            @endif
                        </div>
                        @if($company['category']['is_reservation']== true && $company['is_premium'] == 1 &&  empty(auth('company')->user()->id))
                            @if(!empty(auth('user')->user()->id))
                                <div class="sidebar_contact_business_widget">
                                    <h4 class="title mb25">Rezervasiya et</h4>
                                    <form id="reservationForm">
                                        <input type="hidden" name="company_id" id="company_id"
                                               value="{{$company['id']}}">
                                        <ul class="business_contact mb0">

                                            <li class="search_area">
                                                <div class="form-group">
                                                    <input type="datetime-local" class="form-control" id="date"
                                                           name="date"
                                                           placeholder="Tarix">
                                                    <div class="invalid-feedback" id="dateError"></div>
                                                </div>
                                            </li>
                                            <li class="search_area">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" id="full_name"
                                                           name="full_name"
                                                           placeholder="Ad Soyad">
                                                    <div class="invalid-feedback" id="fullNameError"></div>
                                                </div>
                                            </li>
                                            <li class="search_area">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" id="phone" name="phone"
                                                           placeholder="Əlaqə nömrəsi">
                                                    <div class="invalid-feedback" id="phoneError"></div>
                                                </div>
                                            </li>
                                            {{--<li class="search_area">
                                                <div class="form-group">
                                                    <input type="number" class="form-control" id="place_count"
                                                           name="place_count" placeholder="Yer/Masa sayı">
                                                    <div class="invalid-feedback" id="placeCountError"></div>
                                                </div>
                                            </li>--}}
                                            <li class="search_area">
                                                <div class="form-group">
                                                    <input type="number" class="form-control" id="person_count"
                                                           name="person_count" placeholder="Adam sayı">
                                                    <div class="invalid-feedback" id="personCountError"></div>
                                                </div>
                                            </li>
                                            <li class="search_area">
                                                <div class="form-group">
                                                    <textarea id="text" name="text" class="form-control" rows="5"
                                                              placeholder="Əlavə məlumat"></textarea>
                                                    <div class="invalid-feedback" id="textError"></div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="search_option_button">
                                                    <button type="submit" id="reservationButton"
                                                            class="btn btn-block btn-thm h55">Göndər
                                                    </button>
                                                </div>
                                            </li>
                                        </ul>
                                    </form>
                                </div>
                            @else
                                <div class="sidebar_contact_business_widget">
                                    <h4 class="title mb25">Rezervasiya etmək üçün hesabınızı aktiv edin</h4>
                                </div>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="modal fade" id="productInfoModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document" style="max-width: 500px;">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Bağla">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-4 col-xl-4">
                            <img id="infoImage" src="" alt="Şəkli" class="img-fluid rounded mt-2"
                                 style="max-height: 150px;!important;">
                            @if(!empty($company['category']) && $company['category']['is_persons'] ==true)
                            <img id="infoPersonImage" src="" alt="" class="img-fluid rounded mt-2"
                                 style="max-height: 150px;!important;">
                            @endif
                        </div>
                        <div class="col-lg-6 col-xl-6">
                            <p><strong>Kateqoriya:</strong> <span id="infoCategory"></span></p>
                            <p><strong>Xidmətin Adı:</strong> <span id="infoName"></span></p>
                            <p><strong>Qiymət:</strong> <span id="infoPrice"></span></p>
                            <p><strong>Xidmətin Təsvir:</strong> <br><span id="infoDescription"></span></p>
                            @if(!empty($company['category']) && $company['category']['is_persons'] ==true)
                                <p><strong>Ustanın Adı:</strong> <span id="infoPerson"></span></p>
                                <p><strong>Ustanın Yaşı:</strong> <span id="infoPersonAge"></span></p>
                                <p><strong>Ustanın Təcrübəsi:</strong> <span id="infoPersonExperience"></span></p>
                                <p><strong>Ətraflı məlumat:</strong> <span id="infoPersonDescription"></span></p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="settings_modal modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md mt100" role="document">
            <div class="modal-content">
                <div class="modal-header" style="text-align: center;display: flex!important;">
                    <h4> -Müraciətin tamamlanması</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body container pb20 pl0 pr0 pt0">

                    <div class="tab-content container" id="myTabContent">
                        <div class="row mt40 tab-pane fade show active pl20 pr20" id="home" role="tabpanel"
                             aria-labelledby="home-tab">
                            <div class="col-lg-12">
                                <div class="login_form">
                                    <div class="text-danger text-center mt-2" id="generalReservationError"
                                         style="font-weight: bold;!important;"></div>
                                    <div class="text-success text-center mt-2" id="generalReservationSuccess"
                                         style="font-weight: bold;!important;"></div>
                                    <div class="text-danger text-center mt-2" id="generalReviewError"
                                         style="font-weight: bold;!important;"></div>
                                    <div class="text-success text-center mt-2" id="generalReviewSuccess"
                                         style="font-weight: bold;!important;"></div>
                                    <div class="text-danger text-center mt-2" id="generalCompanyReviewError"
                                         style="font-weight: bold;!important;"></div>
                                    <div class="text-success text-center mt-2" id="generalCompanyReviewSuccess"
                                         style="font-weight: bold;!important;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD8M9rUVW_Og-Z8sTfQSA5HUgRbd4WyW0w&amp;callback=initMap"></script>
    <script>
        var MY_MAPTYPE_ID = 'style_KINESB';

        function initialize() {
            var featureOpts = [
                {
                    "featureType": "administrative",
                    "elementType": "labels.text.fill",
                    "stylers": [
                        {
                            "color": "#666666"
                        }
                    ]
                },
                {
                    "featureType": 'all',
                    "elementType": 'labels',
                    "stylers": [
                        {visibility: 'simplified'}
                    ]
                },
                {
                    "featureType": "landscape",
                    "elementType": "all",
                    "stylers": [
                        {
                            "color": "#e2e2e2"
                        }
                    ]
                },
                {
                    "featureType": "poi",
                    "elementType": "all",
                    "stylers": [
                        {
                            "visibility": "off"
                        }
                    ]
                },
                {
                    "featureType": "road",
                    "elementType": "all",
                    "stylers": [
                        {
                            "saturation": -100
                        },
                        {
                            "lightness": 45
                        },
                        {
                            "visibility": "off"
                        }
                    ]
                },
                {
                    "featureType": "road.highway",
                    "elementType": "all",
                    "stylers": [
                        {
                            "visibility": "off"
                        }
                    ]
                },
                {
                    "featureType": "road.arterial",
                    "elementType": "labels.icon",
                    "stylers": [
                        {
                            "visibility": "off"
                        }
                    ]
                },
                {
                    "featureType": "transit",
                    "elementType": "all",
                    "stylers": [
                        {
                            "visibility": "off"
                        }
                    ]
                },
                {
                    "featureType": "water",
                    "elementType": "all",
                    "stylers": [
                        {
                            "color": "#aadaff"
                        },
                        {
                            "visibility": "on"
                        }
                    ]
                }
            ];
            var myGent = new google.maps.LatLng({{$company['data']['lat'] ?? ''}}, {{$company['data']['lng'] ?? ''}});
            var Kine = new google.maps.LatLng({{$company['data']['lat'] ?? ''}}, {{$company['data']['lng'] ?? ''}});
            var mapOptions = {
                zoom: 11,
                mapTypeControl: true,
                zoomControl: true,
                zoomControlOptions: {
                    style: google.maps.ZoomControlStyle.SMALL,
                    position: google.maps.ControlPosition.LEFT_TOP,
                    mapTypeIds: [google.maps.MapTypeId.ROADMAP, MY_MAPTYPE_ID]
                },
                mapTypeId: MY_MAPTYPE_ID,
                scaleControl: false,
                streetViewControl: false,
                center: myGent
            }
            var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
            var styledMapOptions = {
                name: 'style_KINESB'
            };

            var image = {
                url: '{{ asset('site/images/gps.png') }}',  // İkon şəkilin URL-i
                size: new google.maps.Size(32, 32),               // Orijinal ölçü
                origin: new google.maps.Point(0, 0),              // İkonun başlanğıc nöqtəsi
                anchor: new google.maps.Point(16, 32),            // İkonun "göyərçin quyruğu" nöqtəsi (aşağı ortası)
                scaledSize: new google.maps.Size(32, 32)          // Xəritədə görünəcək ölçü (ölçüləndir)
            };
            var marker = new google.maps.Marker({
                position: Kine,
                map: map,
                animation: google.maps.Animation.DROP,
                title: 'B4318, Gumfreston SA70 8RA, United Kingdom',
                icon: image
            });

            var customMapType = new google.maps.StyledMapType(featureOpts, styledMapOptions);
            map.mapTypes.set(MY_MAPTYPE_ID, customMapType);

        }

        google.maps.event.addDomListener(window, 'load', initialize);

        document.addEventListener('DOMContentLoaded', function () {
            const detailButtons = document.querySelectorAll('.viewProductDetail');

            detailButtons.forEach(function (btn) {
                btn.addEventListener('click', function () {
                    document.getElementById('infoCategory').innerText = btn.getAttribute('data-category');
                    @if(!empty($company['category']) && $company['category']['is_persons'] ==true)
                    document.getElementById('infoPersonImage').src = btn.getAttribute('data-person-image');
                    document.getElementById('infoPerson').innerText = btn.getAttribute('data-person');
                    document.getElementById('infoPersonAge').innerText = btn.getAttribute('data-age');
                    document.getElementById('infoPersonExperience').innerText = btn.getAttribute('data-experience');
                    document.getElementById('infoPersonDescription').innerText = btn.getAttribute('data-person-description');
                    @endif
                    document.getElementById('infoName').innerText = btn.getAttribute('data-name');
                    document.getElementById('infoPrice').innerText = btn.getAttribute('data-price');
                    document.getElementById('infoDescription').innerText = btn.getAttribute('data-description');
                    document.getElementById('infoImage').src = btn.getAttribute('data-image');
                });
            });
        });
    </script>
    @if(!empty(auth('user')->user()->id))
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
        <input type="text" id="date" class="form-control" placeholder="Tarix">
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
        <script>
            flatpickr("#date", {
                enableTime: true,
                dateFormat: "Y-m-d H:i",
                time_24hr: true,
                minDate: "today" // bu tarixdən gerisini seçmək olmur
            });
        </script>
        <script>
            $('#reservationForm').on('submit', function (e) {
                e.preventDefault();
                $('.form-control').removeClass('is-invalid');
                $('#dateError, #fullNameError, #phoneError, #placeCountError, #personCountError, #textError, #generalReservationError, #generalReservationSuccess').text('');
                let formData = new FormData();
                $('#reservationButton').prop('disabled', false).html('Gözləyin...');
                formData.append('_token', $('meta[name="csrf-token"]').attr('content'));
                formData.append('date', $('#date').val());
                formData.append('company_id', $('#company_id').val());
                formData.append('full_name', $('#full_name').val());
                formData.append('phone', $('#phone').val());
                // formData.append('place_count', $('#place_count').val());
                formData.append('person_count', $('#person_count').val());
                formData.append('text', $('#text').val());
                $.ajax({
                    url: '{{ route('site.user.reservationSend') }}',
                    method: 'POST', // PUT üçün method POST olacaq, çünki FormData PUT-u dəstəkləmir
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        if (response.success) {
                            $('#generalReservationSuccess').text(response.message);
                            $('.settings_modal').modal('show'); // modalı göstər
                            // window.location.reload();
                            $('.settings_modal .close').on('click', function () {
                                location.reload();
                            });
                        }
                    },
                    error: function (xhr) {
                        $('#reservationButton').prop('disabled', false).html('Yenidən qeyd et');
                        if (xhr.status === 422) {
                            const res = xhr.responseJSON;
                            if (res.errors) {
                                if (res.errors.date) {
                                    $('#date').addClass('is-invalid');
                                    $('#dateError').removeClass('d-none').addClass('d-block').text(res.errors.date[0]);
                                }
                                if (res.errors.full_name) {
                                    $('#full_name').addClass('is-invalid');
                                    $('#fullNameError').removeClass('d-none').addClass('d-block').text(res.errors.full_name[0]);
                                }
                                if (res.errors.phone) {
                                    $('#phone').addClass('is-invalid');
                                    $('#phoneError').removeClass('d-none').addClass('d-block').text(res.errors.phone[0]);
                                }
                                if (res.errors.place_count) {
                                    $('#place_count').addClass('is-invalid');
                                    $('#placeCountError').removeClass('d-none').addClass('d-block').text(res.errors.place_count[0]);
                                }
                                if (res.errors.person_count) {
                                    $('#person_count').addClass('is-invalid');
                                    $('#personCountError').removeClass('d-none').addClass('d-block').text(res.errors.person_count[0]);
                                }
                                if (res.errors.text) {
                                    $('#text').addClass('is-invalid');
                                    $('#textError').removeClass('d-none').addClass('d-block').text(res.errors.text[0]);
                                }

                            } else if (res.message) {
                                $('#generalReservationError').text(res.message);
                            }
                        } else {
                            $('#generalReservationError').text('Naməlum xəta baş verdi.');
                        }
                    }
                });
            });
        </script>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                // Ulduzlara kliklə reytinq seçimi
                document.querySelectorAll('.review_star').forEach(function (starBlock) {
                    const label = starBlock.closest('.col-lg-4').previousElementSibling?.innerText?.trim();
                    let inputId = "";

                    switch (label) {
                        case "Təmizlik":
                            inputId = "cleanliness";
                            break;
                        case "Rahatlıq":
                            inputId = "comfort";
                            break;
                        case "Heyət":
                            inputId = "staff";
                            break;
                        case "İmkanlar":
                            inputId = "facilities";
                            break;
                    }

                    const stars = starBlock.querySelectorAll('li');
                    stars.forEach(function (star, index) {
                        star.addEventListener('click', function (e) {
                            e.preventDefault();

                            stars.forEach((s, i) => {
                                s.querySelector('i').classList.toggle('text-warning', i <= index);
                            });

                            document.getElementById(inputId).value = index + 1;
                        });
                    });
                });

                // Formun AJAX ilə göndərilməsi
                $('.review_form').on('submit', function (e) {
                    e.preventDefault();

                    // Error mesajlarını sıfırla
                    $('.form-control').removeClass('is-invalid');
                    $('#commitError, #generalReviewSuccess, #generalReviewError').text('');

                    let formData = new FormData();
                    formData.append('_token', $('meta[name="csrf-token"]').attr('content'));
                    formData.append('company_id', $('#company_id').val());
                    formData.append('user_id', $('#user_id').val());
                    formData.append('cleanliness', $('#cleanliness').val());
                    formData.append('comfort', $('#comfort').val());
                    formData.append('staff', $('#staff').val());
                    formData.append('facilities', $('#facilities').val());
                    formData.append('commit', $('#commit').val());

                    $.ajax({
                        url: '{{ route("site.user.reviewSend") }}', // öz route-un adını yaz
                        method: 'POST',
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function (response) {
                            if (response.success) {
                                $('#generalReviewSuccess').text(response.message);
                                $('.review_form')[0].reset();
                                $('.review_star i').removeClass('text-warning');
                                $('.settings_modal').modal('show'); // modalı göstər
                            }
                        },
                        error: function (xhr) {
                            if (xhr.status === 422) {
                                const res = xhr.responseJSON;
                                if (res.errors) {
                                    if (res.errors.commit) {
                                        $('#commit').addClass('is-invalid');
                                        $('#commitError').removeClass('d-none').addClass('d-block').text(res.errors.commit[0]);
                                    }
                                } else if (res.message) {
                                    $('#generalReviewError').text(res.message);
                                    $('.settings_modal').modal('show'); // modalı göstər
                                }
                            } else {
                                $('#generalReviewError').text('Naməlum xəta baş verdi.');
                                $('.settings_modal').modal('show'); // modalı göstər
                            }
                        }
                    });
                });
            });
        </script>
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
    @elseif(!empty(auth('company')->user()->id))
        <script>
            $(document).ready(function () {
                $(document).on('click', '.reply-btn', function (e) {
                    e.preventDefault();

                    // Bütün reply formaları gizlət
                    $('.reply-form').addClass('d-none').html('');

                    // Bu düyməyə aid olan konteyneri tap
                    var replyContainer = $(this).siblings('.reply-form');

                    // Atributdan comment_id-ni götür
                    var commentId = $(this).data('id');

                    // Formun HTML-i içində id-ni saxla (hidden input ilə)
                    var formHtml = `
        <form class="inner-reply-form" data-id="${commentId}">
                <div class="form-group">
                    <textarea class="form-control" id="reply" name="reply" rows="3" placeholder="Cavabınızı yazın..."></textarea>
                    <div class="invalid-feedback" id="replyError"></div>
                </div>
                <button type="submit" class="btn btn-sm btn-primary">Göndər</button>
            </form>
        `;

                    // Formu göstər
                    replyContainer.html(formHtml).removeClass('d-none');
                });

                // Submit zamanı test məqsədli cavab mesajı
                $(document).on('submit', '.inner-reply-form', function (e) {
                    e.preventDefault();

                    // Error mesajlarını sıfırla
                    $('.form-control').removeClass('is-invalid');
                    $('#replyError, #generalCompanyReviewSuccess, #generalCompanyReviewError').text('');

                    let formData = new FormData();
                    formData.append('_token', $('meta[name="csrf-token"]').attr('content'));
                    formData.append('reply', $('#reply').val());
                    // Burada formun içindən comment_id-ni al
                    let commentId = $(this).data('id');
                    formData.append('comment_id', commentId);

                    $.ajax({
                        url: '{{ route("site.company.reviewSend") }}', // öz route-un adını yaz
                        method: 'POST',
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function (response) {
                            if (response.success) {
                                $('#generalCompanyReviewSuccess').text(response.message);
                                $('.inner-reply-form')[0].reset();
                                $('.settings_modal').modal('show'); // modalı göstər
                            }
                        },
                        error: function (xhr) {
                            if (xhr.status === 422) {
                                const res = xhr.responseJSON;
                                if (res.errors) {
                                    if (res.errors.reply) {
                                        $('#reply').addClass('is-invalid');
                                        $('#replyError').removeClass('d-none').addClass('d-block').text(res.errors.reply[0]);
                                    }
                                } else if (res.message) {
                                    $('#generalCompanyReviewError').text(res.message);
                                    $('.settings_modal').modal('show'); // modalı göstər
                                }
                            } else {
                                $('#generalCompanyReviewError').text('Naməlum xəta baş verdi.');
                                $('.settings_modal').modal('show'); // modalı göstər
                            }
                        }
                    });
                });
            });
        </script>
    @endif
    <script>
        $(document).on('click', '.shareBtn', function (e) {
            e.preventDefault();

            const companyId = $(this).data('id');
            const shareUrl = window.location.href;

            // Əgər clipboard API dəstəklənirsə
            if (navigator.clipboard && navigator.clipboard.writeText) {
                navigator.clipboard.writeText(shareUrl).then(function () {
                    alert("Link panoya kopyalandı!");
                    sendShareRequest(companyId);
                }).catch(function (err) {
                    console.error("Kopyalanmadı:", err);
                });
            } else {
                // Alternativ: Köhnə brauzerlər üçün
                const tempInput = document.createElement("input");
                tempInput.value = shareUrl;
                document.body.appendChild(tempInput);
                tempInput.select();
                try {
                    document.execCommand("copy");
                    alert("Link panoya kopyalandı!");
                    sendShareRequest(companyId);
                } catch (err) {
                    alert("Kopyalama mümkün olmadı.");
                }
                document.body.removeChild(tempInput);
            }

            function sendShareRequest(id) {
                $.ajax({
                    url: '{{ route("site.companyShare") }}',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        company_id: id
                    },
                    success: function (res) {
                        console.log('Paylaşım qeyd olundu');
                    },
                    error: function () {
                        console.error('Xəta baş verdi');
                    }
                });
            }
        });

    </script>

@endsection
