@extends('site.layouts.app')
@section('site.title')
    @lang('site.home')
@endsection
@section('site.css')
    <style>
        .flaticon-love.active {
            color: red;
        }
        .infoBox, .infoBox * {
            pointer-events: auto !important;
        }
        .map-listing-item img {
            border-radius: 6px;
            margin-bottom: 5px;
        }
        .map-listing-item h3 {
            font-size: 16px;
            margin: 5px 0;
        }
        .map-listing-item a {
            display: inline-block;
            margin-top: 5px;
            color: #007bff;
            text-decoration: none;
        }
        .map-listing-item a:hover {
            text-decoration: underline;
        }
        @media (max-width: 768px) {
            .half_map_area_content {
                display: none;
            }
        }


    </style>
    <link rel="stylesheet" href="{{ asset("site/css/bootstrap.min.css") }}">
    <link rel="stylesheet" href="{{ asset("site/css/style.css") }}">
    <link rel="stylesheet" href="{{ asset("site/css/responsive.css") }}">
    {{--<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>--}}
@endsection
@section('site.content')
    <div class="body_content">
        <!-- Listing Grid View -->
        <section id="feature-property" class="our-listing-list pt0 pb0">
            <div class="container-fluid">
                <div class="row">
                    {{--<div class="col-xl-6">
                        <div class="half_map_area_content">
                            <div class="row" id="listing-area"></div>
                        </div>
                    </div>--}}
                    <div class="col-xl-12">
                        <div class="half_map_area_content">
                            <div class="row" id="listing-area"></div>
                        </div>
                        <div class="half_map_area">
                            <div class="home_two_map">
                                <div class="map-canvas half_style" id="map" data-map-zoom="9" data-map-scroll="true"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
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
    <script src="{{ asset("site/js/infobox.min.js") }}"></script>
    <script src="{{ asset("site/js/markerclusterer.js") }}"></script>
    <script src="{{ asset("site/js/script.js") }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <script>
        window.initMap = function() {
            const ib = new google.maps.InfoWindow();

            function locationData(locationImg, locationTitle, locationAddress, locationPhone, locationUrl) {
                return `
            <div class="map-listing-item" style="width:200px;">
                <img src="${locationImg}" alt="${locationTitle}" style="width: 37%; height: 79px;"/>
                <h3>${locationTitle}</h3>
                <p>${locationAddress}</p>
                <p>${locationPhone}</p>
                <a href="${locationUrl}" target="_blank">Keçid et</a>
            </div>
        `;
            }

            // PHP-dən JS massivinə data ötürürük
            const locations = [
                    @foreach($mainCategory as $category)
                    @if(!empty($category['mapCompany']))
                {
                    lat: {{ $category['mapCompany']['data']['lat'] ?? 0 }},
                    lng: {{ $category['mapCompany']['data']['lng'] ?? 0 }},
                    img: "{{ asset('uploads/categories/'.$category['image'] ?? '') }}",
                    title: "{{ $category['mapCompany']['full_name'] }}",
                    address: "{{ $category['mapCompany']['data']['address'] ?? '' }}",
                    phone: "{{ $category['mapCompany']['social']['one_phone'] ?? '' }}",
                    url: "{{ route('site.companyDetails',['slug' => $category['mapCompany']['slug']]) }}"
                },
                @endif
                @endforeach
            ];

            const map = new google.maps.Map(document.getElementById("map"), {
                center: { lat: 40.4093, lng: 49.8671 },
                zoom: 8
            });

            locations.forEach(loc => {
                const marker = new google.maps.Marker({
                    position: { lat: loc.lat, lng: loc.lng },
                    map: map,
                    title: loc.title
                });

                marker.addListener("click", function() {
                    ib.setContent(locationData(loc.img, loc.title, loc.address, loc.phone, loc.url));
                    ib.open(map, marker);
                    map.setCenter(marker.getPosition()); // marker üzərinə fokus
                });
            });
        };
    </script>

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD8M9rUVW_Og-Z8sTfQSA5HUgRbd4WyW0w&callback=initMap&libraries=places" async defer></script>
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
