@extends('site.layouts.app')
@section('site.title')
    @lang('site.privacy_policy')
@endsection
@section('site.css')
    <link rel="stylesheet" href="{{ asset("site/css/bootstrap.min.css") }}">
    <link rel="stylesheet" href="{{ asset("site/css/style.css") }}">
    <link rel="stylesheet" href="{{ asset("site/css/responsive.css") }}">
@endsection
@section('site.content')
    <!-- Our Contact -->
    <section class="our-contact">
        <div class="container">
            <div class="row">
                <div class="col-lg-5">
                    <div class="contact_info_widget mb30-smd">
                        <h3 class="m_title">Bizimlə əlaqə</h3>
                        <div class="ciw_box mb50">
                            <h4 class="title">Azərbaycan Bakı</h4>
                            <ul class="list-unstyled">
                                <li class="df"><span class="flaticon-pin mr15"></span><a>Azerbaycan, Bakı şəhəri</a></li>
                                <li><span class="flaticon-phone mr15"></span><a href="tel:+994552956727">+994552956727</a></li>
                                <li><span class="flaticon-phone mr15"></span><a href="tel:+994552952767">+994552952767</a></li>
                                <li><span class="flaticon-email mr15"></span><a href="mailto:info@nacaspia.com">info@nacaspia.com</a></li>
                            </ul>
                            <a class="tdu text-thm direction" href="#">Get Direction</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="h600" id="map-canvas"></div>
                   {{-- <div class="form_grid">
                        <h3 class="title mb5">Get in touch with us</h3>
                        <form class="contact_form" id="contact_form" name="contact_form" action="#" method="post" novalidate="novalidate">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input id="form_name" name="form_name" class="form-control" required="required" type="text" placeholder="Name">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input id="form_email" name="form_email" class="form-control required email" required="required" type="email" placeholder="Email">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input id="form_phone" name="form_phone" class="form-control required phone" required="required" type="text" placeholder="Phone">
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <textarea id="form_message" name="form_message" class="form-control required" rows="8" required="required" placeholder="Your Message"></textarea>
                                    </div>
                                    <div class="form-group mb0">
                                        <button type="button" class="btn btn-lg btn-thm">Send Message</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>--}}
                </div>
            </div>
        </div>
    </section>
   {{-- <section class="our-map p0">
        <div class="container-fluid p0">
            <div class="row">
                <div class="col-lg-12">
                    <div class="h600" id="map-canvas"></div>
                </div>
            </div>
        </div>
    </section>--}}

    <!-- Start Partners -->
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
            var myGent = new google.maps.LatLng(40.403216, 49.867081); // Nərimanov rayonu
            var Kine   = new google.maps.LatLng(40.403216, 49.867081); // Eyni koordinat
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
                title: 'Bakı şəhəri Nərmanov rayonu',
                icon: image
            });

            var customMapType = new google.maps.StyledMapType(featureOpts, styledMapOptions);
            map.mapTypes.set(MY_MAPTYPE_ID, customMapType);

        }
        google.maps.event.addDomListener(window, 'load', initialize);
    </script>
{{--    <script src="{{ asset('site/js/googlemaps1.js') }}"></script>--}}
@endsection
