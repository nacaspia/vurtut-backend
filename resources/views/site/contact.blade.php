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
                                <li><span class="flaticon-email mr15"></span><a href="mailto:nacaspia.main@gmail.com">nacaspia.main@gmail.com</a></li>
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
    <script src="{{ asset('site/js/googlemaps1.js') }}"></script>
@endsection
