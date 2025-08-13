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

{{--    <script>--}}
{{--        window.initMap = function() {--}}
{{--            const ib = new google.maps.InfoWindow();--}}

{{--            function locationData(locationImg, locationTitle, locationAddress, locationPhone, locationUrl) {--}}
{{--                return `--}}
{{--            <div class="map-listing-item" style="width:200px;">--}}
{{--                <img src="${locationImg}" alt="${locationTitle}" style="width: 37%; height: 79px;"/>--}}
{{--                <h3>${locationTitle}</h3>--}}
{{--                <p>${locationAddress}</p>--}}
{{--                <p>${locationPhone}</p>--}}
{{--                <a href="${locationUrl}" target="_blank">Keçid et</a>--}}
{{--            </div>--}}
{{--        `;--}}
{{--            }--}}

{{--            // Xəritəni bir dəfə yarat--}}
{{--            const map = new google.maps.Map(document.getElementById("map"), {--}}
{{--                center: { lat: 40.4093, lng: 49.8671 }, // ilkin mərkəz (Bakı)--}}
{{--                zoom: 12--}}
{{--            });--}}

{{--            @foreach($mainCategory as $cateKey => $category)--}}
{{--            @if(!empty($category['mapCompany']))--}}
{{--            var marker = new google.maps.Marker({--}}
{{--                position: {--}}
{{--                    lat: {{$category['mapCompany']['data']['lat'] ?? 0}},--}}
{{--                    lng: {{$category['mapCompany']['data']['lng'] ?? 0}}--}}
{{--                },--}}
{{--                map: map,--}}
{{--                title: "{{$category['mapCompany']['full_name']}}"--}}
{{--            });--}}

{{--            marker.addListener("click", function() {--}}
{{--                map.setCenter(marker.getPosition()); // Kliklənən markerin üzərinə xəritəni gətirir--}}
{{--                ib.setContent(locationData(--}}
{{--                    "{{ asset("uploads/categories/".$category['image'] ?? '') }}",--}}
{{--                    "{{$category['mapCompany']['full_name']}}",--}}
{{--                    "{{$category['mapCompany']['data']['address'] ?? ''}}",--}}
{{--                    "{{$category['mapCompany']['social']['one_phone'] ?? ''}}",--}}
{{--                    "{{ route('site.companyDetails',['slug' => $category['mapCompany']['slug']]) }}"--}}
{{--                ));--}}
{{--                ib.open(map, marker);--}}
{{--            });--}}
{{--            @endif--}}
{{--            @endforeach--}}
{{--        };--}}
{{--    </script>--}}

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD8M9rUVW_Og-Z8sTfQSA5HUgRbd4WyW0w&callback=initMap&libraries=places" async defer></script>

    {{-- <script>
         var infoBox_ratingType = 'star-rating';

         (function ($) {
             "use strict";

             function mainMap() {
                 var ib = new InfoBox();

                 // InfoBox içində görünən HTML
                 function locationData(locationImg, locationRating, locationRatingCounter, locationURL, locationTitle, locationAddress, locationPhone, locationColor, locationIcon, locationName, locationStatus) {
                     return (
                         '<div class="map-listing-item">' +
                         '<div class="inner-box">' +
                         '<div class="infoBox-close"><i class="fa fa-times"></i></div>' +
                         '<div class="image-box">' +
                         '<a href="' + locationURL + '" target="_blank"><figure class="image"><img src="' + locationImg + '" alt=""></figure></a>' +
                         '<div class="content">' +
                         '<div class="' + infoBox_ratingType + '" data-rating="' + locationRating + '">' +
                         '<div class="rating-counter">(' + locationRatingCounter + ' reviews)</div>' +
                         '</div>' +
                         '<h3><a href="' + locationURL + '">' + locationTitle + '<span class="icon icon-verified"></span></a></h3>' +
                         '<ul class="info">' +
                         '<li><span class="flaticon-phone"></span>' + locationPhone + '</li>' +
                         '<li><span class="flaticon-pin"></span>' + locationAddress + '</li>' +
                         '</ul>' +
                         '</div>' +
                         '</div>' +
                         '<div class="bottom-box">' +
                         '<div class="places"><div class="place ' + locationColor + '"><span class="icon ' + locationIcon + '"></span><a href="' + locationURL + '" target="_blank"> ' + locationName + ' </a></div></div>' +
                         '<div class="status">' + locationStatus + '</div>' +
                         '</div>' +
                         '</div>' +
                         '</div>'
                     );
                 }

                 // PHP-dən gələn marker məlumatları
                 var locations = [
                         @php $i = 0; @endphp
                         @foreach($mainCategory as $category)
                         @if(!empty($category['mapCompany']))
                         @php $i++; @endphp
                     [locationData(
                         '{{ asset("uploads/categories/".$category['image']) }}',
                         '5',
                         '{{ $i }}',
                         '{{ route('site.companyDetails',['slug' => $category['mapCompany']['slug']]) }}',
                         "{{ $category['mapCompany']['full_name'] }}",
                         '{{ $category['mapCompany']['mainCities']['name'][$currentLang] }}',
                         '{{ $category['mapCompany']['social']['one_phone'] }}',
                         'sky',
                         'flaticon-tent',
                         '{{ $category['title'][$currentLang] }}',
                         'Now Closed'
                     ), {{ $category['mapCompany']['data']['lat'] }}, {{ $category['mapCompany']['data']['lng'] }}, {{ $i }}, '<i class="icon flaticon-find-location"></i>'],
                     @endif
                     @endforeach
                 ];

                 // Reytinq nömrə və ulduz funksiyaları
                 function numericalRating(ratingElem) {
                     $(ratingElem).each(function () {
                         var dataRating = $(this).attr('data-rating');
                         if (dataRating >= 4.0) $(this).addClass('high');
                         else if (dataRating >= 3.0) $(this).addClass('mid');
                         else $(this).addClass('low');
                     });
                 }
                 function starRating(ratingElem) {
                     $(ratingElem).each(function () {
                         var dataRating = $(this).attr('data-rating');
                         function starsOutput(f1, f2, f3, f4, f5) {
                             return '<span class="' + f1 + '"></span>' +
                                 '<span class="' + f2 + '"></span>' +
                                 '<span class="' + f3 + '"></span>' +
                                 '<span class="' + f4 + '"></span>' +
                                 '<span class="' + f5 + '"></span>';
                         }
                         var stars = [
                             starsOutput('star', 'star', 'star', 'star', 'star'),
                             starsOutput('star', 'star', 'star', 'star', 'star half'),
                             starsOutput('star', 'star', 'star', 'star', 'star empty'),
                             starsOutput('star', 'star', 'star', 'star half', 'star empty'),
                             starsOutput('star', 'star', 'star', 'star empty', 'star empty'),
                             starsOutput('star', 'star', 'star half', 'star empty', 'star empty'),
                             starsOutput('star', 'star', 'star empty', 'star empty', 'star empty'),
                             starsOutput('star', 'star half', 'star empty', 'star empty', 'star empty'),
                             starsOutput('star', 'star empty', 'star empty', 'star empty', 'star empty')
                         ];
                         if (dataRating >= 4.75) $(this).append(stars[0]);
                         else if (dataRating >= 4.25) $(this).append(stars[1]);
                         else if (dataRating >= 3.75) $(this).append(stars[2]);
                         else if (dataRating >= 3.25) $(this).append(stars[3]);
                         else if (dataRating >= 2.75) $(this).append(stars[4]);
                         else if (dataRating >= 2.25) $(this).append(stars[5]);
                         else if (dataRating >= 1.75) $(this).append(stars[6]);
                         else if (dataRating >= 1.25) $(this).append(stars[7]);
                         else $(this).append(stars[8]);
                     });
                 }

                 // InfoBox hazır olduqda reytinq əlavə et
                 google.maps.event.addListener(ib, 'domready', function () {
                     if (infoBox_ratingType === 'numerical-rating') numericalRating('.infoBox .' + infoBox_ratingType);
                     if (infoBox_ratingType === 'star-rating') starRating('.infoBox .' + infoBox_ratingType);
                 });

                 // Xəritə parametrləri
                 var zoomLevel = $('#map').attr('data-map-zoom') ? parseInt($('#map').attr('data-map-zoom')) : 5;
                 var scrollEnabled = $('#map').attr('data-map-scroll') ? parseInt($('#map').attr('data-map-scroll')) : false;
                 var map = new google.maps.Map(document.getElementById('map'), {
                     zoom: zoomLevel,
                     scrollwheel: scrollEnabled,
                     center: new google.maps.LatLng(40.4093, 49.8671),
                     mapTypeId: google.maps.MapTypeId.ROADMAP,
                     zoomControl: false,
                     mapTypeControl: false,
                     scaleControl: false,
                     panControl: false,
                     navigationControl: false,
                     streetViewControl: false,
                     gestureHandling: 'cooperative',
                     styles: [/* buraya xəritə stilini qoy */]
                 });

                 // InfoBox qutusu
                 var boxText = document.createElement("div");
                 boxText.className = 'map-box';
                 var boxOptions = {
                     content: boxText,
                     disableAutoPan: false,
                     alignBottom: true,
                     pixelOffset: new google.maps.Size(-134, -55),
                     boxStyle: { width: "320px" },
                     closeBoxURL: "",
                     enableEventPropagation: true
                 };

                 // Markerləri yüklə
                 var allMarkers = [];
                 for (var i = 0; i < locations.length; i++) {
                     var overlayPos = new google.maps.LatLng(locations[i][1], locations[i][2]);
                     var overlay = new CustomMarker(overlayPos, map, { marker_id: i }, locations[i][4]);
                     allMarkers.push(overlay);

                     google.maps.event.addDomListener(overlay, 'click', (function (overlay, i) {
                         return function () {
                             ib.setOptions(boxOptions);
                             boxText.innerHTML = locations[i][0];
                             ib.close();
                             ib.open(map, overlay);
                             $('.map-marker-container').removeClass('clicked infoBox-opened');
                             $(overlay.div).addClass('clicked infoBox-opened');

                             $('.infoBox-close').on('click', function (e) {
                                 e.preventDefault();
                                 ib.close();
                                 $('.map-marker-container').removeClass('clicked infoBox-opened');
                             });
                         };
                     })(overlay, i));
                 }
             }

             // Xəritəni yüklə
             var mapDiv = document.getElementById('map');
             if (mapDiv) google.maps.event.addDomListener(window, 'load', mainMap);

             // Custom Marker class
             function CustomMarker(latlng, map, args, markerIco) {
                 this.latlng = latlng;
                 this.args = args;
                 this.markerIco = markerIco;
                 this.setMap(map);
             }
             CustomMarker.prototype = new google.maps.OverlayView();
             CustomMarker.prototype.draw = function () {
                 var self = this;
                 var div = this.div;
                 if (!div) {
                     div = this.div = document.createElement('div');
                     div.className = 'map-marker-container';
                     div.innerHTML =
                         '<div class="marker-container">' +
                         '<div class="marker-card">' +
                         '<div class="front face">' + self.markerIco + '</div>' +
                         '<div class="back face">' + self.markerIco + '</div>' +
                         '<div class="marker-arrow"></div>' +
                         '</div>' +
                         '</div>';
                     var panes = this.getPanes();
                     panes.overlayImage.appendChild(div);
                 }
                 var point = this.getProjection().fromLatLngToDivPixel(this.latlng);
                 if (point) {
                     div.style.left = point.x + 'px';
                     div.style.top = point.y + 'px';
                 }
             };
             CustomMarker.prototype.remove = function () {
                 if (this.div) {
                     this.div.parentNode.removeChild(this.div);
                     this.div = null;
                 }
             };
             CustomMarker.prototype.getPosition = function () {
                 return this.latlng;
             };

         })(this.jQuery);
     </script>--}}
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
