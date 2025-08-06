<!DOCTYPE html>
<html dir="ltr" lang="az">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- css file -->
    <link rel="stylesheet" href="{{ asset('site/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('site/css/style.css') }}">
    <!-- Responsive stylesheet -->
    <link rel="stylesheet" href="{{ asset('site/css/responsive.css') }}">
    <!-- Title -->
    <title>vurtut.com</title>
    <!-- Favicon -->
    <link href="{{ asset('site/images/Vurtut logo icon/Vurtut.com.ico') }}" sizes="128x128" rel="shortcut icon" type="image/x-icon" />
    <link href="{{ asset('site/images/Vurtut logo icon/Vurtut.com.ico') }}" sizes="128x128" rel="shortcut icon" />

</head>
<body>
<div class="wrapper">
    <div class="preloader"></div>

    <!-- Our Error Page -->
    <section class="our-invoice bgc-f4 pb200">
        <div class="container">
            <div class="row mt20">
                <div class="col-lg-12">
                    <div class="invoice_table">
                        <div class="row mb25">
                            <div class="col-lg-7">
                                <div class="main_logo fz30 color-black22 fw500"><img class="img-fluid" src="{{ asset('site/images/Vurtut logo icon/vurtut.com.svg') }}" alt="header-logo2.svg"> vurtut.com</div>
                            </div>
                            <div class="col-lg-5">
                                <div class="invoice_deails">
                                    <h3 class="float-left"> {{ !empty($data['full_name'])? $data['full_name']: null }}</h3>
                                </div>
                            </div>
                        </div>
                        <div class="row mt40">
                            <div class="col-sm-6 col-lg-7">
                                <div class="invoice_date mb70">
                                    <div class="title">E-poçt</div>
                                    <h5 class="fw400 mb0">{{ !empty($data['email'])? $data['email']: null }}</h5>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-5">
                                <div class="invoice_date mb70">
                                    <div class="title">Əlaqə nömrəsi</div>
                                    <h5 class="fw400 mb0">{{ !empty($data['phone'])? $data['phone']: null }}</h5>
                                </div>
                            </div>
                        </div>
                        <div class="row mt50">
                            <div class="col-lg-12">
                                <div class="invoice_down_print float-right">
                                    <a class="invoice_print_btn" href="{{ !empty($data['url'])? $data['url']: null }}"> Daxil ol</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="invoice_footer bgc-thm">
                        <div class="row justify-content-center">
                            <div class="col-lg-8">
                                <div class="invoice_footer_content">
                                    <ul>
                                        <li class="list-inline-item"><a href="www.vurtut.com">www.vurtut.com</a></li>
                                        <li class="list-inline-item"><a href="mailto:info@vurtut.com">info@vurtut.com</a></li>
                                        <li class="list-inline-item"><a href="tel:+994552956727">+99455 295 67 27</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<!-- Wrapper End -->
<script src="{{ asset('site/js/jquery-3.6.0.js') }}"></script>
<script src="{{ asset('site/js/jquery-migrate-3.0.0.min.js') }}"></script>
<script src="{{ asset('site/js/popper.min.js') }}"></script>
<script src="{{ asset('site/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('site/js/jquery.mmenu.all.js') }}"></script>
<script src="{{ asset('site/js/ace-responsive-menu.js') }}"></script>
<script src="{{ asset('site/js/bootstrap-select.min.js') }}"></script>
<script src="{{ asset('site/js/snackbar.min.js') }}"></script>
<script src="{{ asset('site/js/simplebar.js') }}"></script>
<script src="{{ asset('site/js/parallax.js') }}"></script>
<script src="{{ asset('site/js/scrollto.js') }}"></script>
<script src="{{ asset('site/js/jquery-scrolltofixed-min.js') }}"></script>
<script src="{{ asset('site/js/jquery.counterup.js') }}"></script>
<script src="{{ asset('site/js/wow.min.js') }}"></script>
<script src="{{ asset('site/js/progressbar.js') }}"></script>
<script src="{{ asset('site/js/slider.js') }}"></script>
<script src="{{ asset('site/js/timepicker.js') }}"></script>
<!-- Custom script for all pages -->
<script src="{{ asset('site/js/script.js') }}"></script>
</body>
</html>
