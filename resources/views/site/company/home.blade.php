@php use Carbon\Carbon; @endphp
@extends('site.company.layouts.app')
@section('company.css')
    <style>
        .flaticon-love.active {
            color: red;
        }
        .fa-star-m {
            color: #ffc401;
            transition: color 0.3s;
        }
        .fa-star.text-warning,
        .fa-star.checked {
            color: #ffc401 !important;
        }
        .review_star i.text-warning {
            color: #ffc107 !important;
        }
        .rating-stars {
            display: flex;
            gap: 3px;
        }

        .rating-stars i {
            color: #ffc107; /* qızılı ulduz */
            font-size: 16px;
        }
    </style>
@endsection
@section('company.content')
    <section class="listing-title-area pb50">
        <div class="container">
            <div class="row">
                @include('site.company.layouts.mobile-menu')
            </div>
            <div class="row mb30">
                <div class="col-xl-7">
                    <div class="single_property_title mt30-767">
                        <div class="media">
                            <img class="mr-3" src="{{ !empty($company->image)? asset("uploads/company/".$company->image): asset('site/images/Vurtut logo icon/account.png') }}" style="width:145px; height:145px; border-radius:50%; object-fit:cover; display:block; margin-bottom:10px;" oading="lazy">
                            <div class="media-body mt20">
                                <h2 class="mt-0">{{$company->full_name}} ({{ $company['type'] === 'main'? 'Əsas Filial': 'Filial' }})</h2>
                                <ul class="mb0 agency_profile_contact">
                                    <li class="list-inline-item"><a href="#"><span class="flaticon-phone"></span> {{ !empty($company['social']['one_phone'])? $company['social']['one_phone']: null }}</a></li>
                                    <li class="list-inline-item"><a href="#"><span class="flaticon-pin"></span> {{ $company->mainCities['name'][$currentLang] }} @if(!empty($company->subRegion['name'][$currentLang])) / {{ $company->subRegion['name'][$currentLang] }}@endif</a></li>
                                    <li class="list-inline-item sspd_review">
                                        <ul class="mb0">
                                            <li class="list-inline-item"><a href="#"><i class="fa fa-star"></i></a></li>
                                            <li class="list-inline-item"><a href="#"><i class="fa fa-star"></i></a></li>
                                            <li class="list-inline-item"><a href="#"><i class="fa fa-star"></i></a></li>
                                            <li class="list-inline-item"><a href="#"><i class="fa fa-star"></i></a></li>
                                            <li class="list-inline-item"><a href="#"><i class="fa fa-star"></i></a></li>
                                            <li class="list-inline-item">({{ count($company['comments']) }} rəy)</li>
                                        </ul>
                                    </li>
                                    @if($company['is_premium'] ==1)
                                    <li class="list-inline-item"><a class="price_range" href="#">PREMIUM</a></li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @if(!empty($company['posts'][0]))
            <div class="row">
                <div class="col-md-7 col-lg-8">
                    <div class="row">
                        <div class="col-lg-12 pl0 pr0 pl15-767 pr15-767">
                            <div class="spls_style_two mb30-767">
                                <a class="popup-img" href="{{ asset('uploads/company-posts/'.$company['posts'][0]['image']) }}">
                                    <img class="img-fluid w100" src="{{ asset('uploads/company-posts/'.$company['posts'][0]['image']) }}" alt="1.jpg">
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
                                        <a class="popup-img" href="{{ asset('uploads/company-posts/'.$image['image']) }}">
                                            <img class="img-fluid w100" src="{{ asset('uploads/company-posts/'.$image['image']) }}" alt="img{{ $index + 1 }}">
                                        </a>
                                    </div>
                                </div>
                            @elseif($index == 7)
                                {{-- 8-ci şəkil + overlay (əgər qalan varsa) --}}
                                <div class="col-sm-4 col-md-6 col-lg-6 pr5 pr15-767">
                                    <div class="spls_style_two mb10 position-relative">
                                        <a class="popup-img" href="{{ asset('uploads/company-posts/'.$image['image']) }}">
                                            <img class="img-fluid w100" src="{{ asset('uploads/company-posts/'.$image['image']) }}" alt="img{{ $index + 1 }}">
                                            @php
                                                $remaining = count($company['posts']) - 6;
                                            @endphp
                                            @if($remaining > 0)
                                                <div class="overlay popup-img" style="position:absolute; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.5); display:flex; justify-content:center; align-items:center; color:#fff;">
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
                                    @if(!empty($serviceTypes[0]))
                                        @foreach($serviceTypes as $serviceType)
                                            @if(in_array($serviceType->id, $company['service_type']))
                                            <div class="col-md-6 col-lg-6 col-xl-4 pl0 pr0 pl15-767">
                                                <div class="listing_feature_iconbox mb30">
                                                    <div class="icon float-left mr10"><span class="flaticon-credit-card"></span></div>
                                                    <div class="details">
                                                        <div class="title">{{ $serviceType['name'][$currentLang] }}</div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endif
                                        @endforeach
                                    @endif
                                    {{--<div class="col-md-6 col-lg-6 col-xl-4 pl0 pr0 pl15-767">
                                        <div class="listing_feature_iconbox mb30">
                                            <div class="icon float-left mr10"><span class="flaticon-bike"></span></div>
                                            <div class="details">
                                                <div class="title">Velosiped Parkı</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-6 col-xl-4 pl0 pr0 pl15-767">
                                        <div class="listing_feature_iconbox mb30">
                                            <div class="icon float-left mr10"><span class="flaticon-car"></span></div>
                                            <div class="details">
                                                <div class="title">Parkinq</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-6 col-xl-4 pl0 pr0 pl15-767">
                                        <div class="listing_feature_iconbox mb30">
                                            <div class="icon float-left mr10"><span class="flaticon-wifi"></span></div>
                                            <div class="details">
                                                <div class="title">Pulsuz Wi-Fi</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-6 col-xl-4 pl0 pr0 pl15-767">
                                        <div class="listing_feature_iconbox mb30">
                                            <div class="icon float-left mr10"><span class="flaticon-disabled"></span></div>
                                            <div class="details">
                                                <div class="title">Təkərli oturacaq imkanı</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-6 col-xl-4 pl0 pr0 pl15-767">
                                        <div class="listing_feature_iconbox mb30">
                                            <div class="icon float-left mr10"><span class="flaticon-pawprint"></span></div>
                                            <div class="details">
                                                <div class="title">Heyvanla giriş</div>
                                            </div>
                                        </div>
                                    </div>--}}
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
                                    $categories = [
                                        'Təmizlik' => $avgCleanliness,
                                        'Heyət' => $avgStaff,
                                        'Rahatlıq' => $avgComfort,
                                        'İmkanlar' => $avgFacilities,
                                    ];
                                @endphp

                                @foreach($categories as $title => $score)
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
                                            <img style="max-width: 10%;!important;" src="{{ !empty($comment['users']->image)? asset("uploads/user/".$comment['users']->image): asset('site/images/Vurtut logo icon/account.png') }}" class="mr-3"
                                                 alt="reviewer2.png">
                                            <div class="media-body">
                                                <h4 class="sub_title mt-0">{{ $comment['users']->full_name }}</h4>
                                                <div class="sspd_postdate fz14 mb20">{{ \Carbon\Carbon::parse($comment->created_at)->format('Y-m-d H:i') }}
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
                                                {{--@if($comment->committer->count()==0)
                                                    <a class="text-thm tdu reply-btn" href="#" data-id="{{ $comment['id'] }}">Cavablandır</a>
                                                @else--}}@if ($comment->committer->count() != 0)
                                                    @foreach ($comment->committer as $reply)
                                                        <br>
                                                        <div class="mbp_first media">
                                                            <img style="max-width: 10%;!important;" src="{{ !empty($comment['company']->image)? asset("uploads/company/".$comment['company']->image): asset('site/images/Vurtut logo icon/account.png') }}" class="mr-3"
                                                                 alt="{{ $reply->company->full_name }}">
                                                            <div class="media-body">
                                                                <h4 class="sub_title mt-0">{{ $reply->company->full_name }}</h4>
                                                                <div class="sspd_postdate fz14 mb20">{{ \Carbon\Carbon::parse($reply->created_at)->format('Y-m-d H:i') }}

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
                                <li class="df"><span class="flaticon-pin mr15"></span>{!! $company['data']['address'] ?? '' !!}</li>
                                @if(!empty($company['social']['one_phone']))
                                <li><span class="flaticon-phone mr15"></span><a href="tel:{{ $company['social']['one_phone'] }}">{{ $company['social']['one_phone'] }}</a></li>
                                @endif
                                @if(!empty($company['social']['two_phone']))
                                <li><span class="flaticon-phone mr15"></span><a href="tel:{{ $company['social']['two_phone'] }}">{{ $company['social']['two_phone'] }}</a></li>
                                @endif
                                @if(!empty($company['social']['one_email']))
                                <li><span class="flaticon-email mr15"></span><a href="mailto:{{ $company['social']['one_email'] }}">{{ $company['social']['one_email'] }}</a></li>
                                @endif
                            </ul>
                            <ul class="sidebar_social_icon mb0">
                                @if(!empty($company['social']['facebook']))
                                <li class="list-inline-item"><a href="{{$company['social']['facebook']}}"><i class="fa fa-facebook"></i></a></li>
                                @endif
                                @if(!empty($company['social']['linkedin']))
                                <li class="list-inline-item"><a href="{{$company['social']['linkedin']}}"><i class="fa fa-linkedin"></i></a></li>
                                @endif
                                @if(!empty($company['social']['instagram']))
                                <li class="list-inline-item"><a href="{{$company['social']['instagram']}}"><i class="fa fa-instagram"></i></a></li>
                                @endif
                                @if(!empty($company['social']['tiktok']))
                                <li class="list-inline-item"><a href="{{$company['social']['tiktok']}}">T</a></li>
                                @endif
                            </ul>
                        </div>
                        <div class="sidebar_opening_hour_widget pb20">
                            <h4 class="title mb15">İşləmə saatları {{--<small class="text-thm2 float-right">Now Open</small>--}}</h4>
                            <ul class="list_details mb0">
                                @foreach(['Mon','Tue','Wed','Thu','Fri','Sat','Sun'] as $key => $day)
                                    @php
                                        $type = $company['time'][$day]['hours_type'] ?? 0;
                                        $start = $company['time'][$day]['start'] ?? '00:00';
                                        $end = $company['time'][$day]['end'] ?? '23:59';
                                        $date = 'Bağlı';
                                        if ($type == 1) {
                                            $date = $start .' - '. $end ;
                                        }
                                    @endphp
                                    <li><a href="#">@lang('site.'.$day) <span class="float-right">{{$date}}</span></a></li>
                                @endforeach

                                {{--<li><a href="#">Tuesday <span class="float-right">6:30 am – 4:00 pm</span></a></li>
                                <li><a href="#">Wednesday <span class="float-right">6:30 am – 4:00 pm</span></a></li>
                                <li><a href="#">Thursday <span class="float-right">6:30 am – 4:00 pm</span></a></li>
                                <li><a href="#">Friday <span class="float-right">6:30 am – 4:00 pm</span></a></li>
                                <li><a href="#">Saturday <span class="float-right">6:30 am – 4:00 pm</span></a></li>
                                <li><a href="#">Sunday <span class="float-right">6:30 am – 4:00 pm</span></a></li>--}}
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
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
@section('company.js')
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
                        { visibility: 'simplified' }
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
            var myGent = new google.maps.LatLng({{$company['data']['lat'] ?? ''}},{{$company['data']['lng'] ?? ''}});
            var Kine =  new google.maps.LatLng({{$company['data']['lat'] ?? ''}},{{$company['data']['lng'] ?? ''}});
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
    </script>
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
    <!-- Custom script for all pages -->
@endsection
