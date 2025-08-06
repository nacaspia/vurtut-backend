@extends('site.layouts.app')
@section('site.title')
    @lang('site.home')
@endsection
@section('site.css')
    <link rel="stylesheet" href="{{ asset("site/css/bootstrap.min.css") }}">
    <link rel="stylesheet" href="{{ asset("site/css/style.css") }}">
    <link rel="stylesheet" href="{{ asset("site/css/responsive.css") }}">
    {{--<script src="http://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="http://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>--}}
@endsection
@section('site.content')
    <!-- Our Coming Soon Page -->
    <section class="our-coming-soon" style="padding: 0px 0;!important;">
        <div class="container">
            <div class="row" {{--style="text-align: center; display: flex;!important;"--}}>
                <div class="col-xl-6">
                    <div class="error_page footer_apps_widget">
                        <div class="erro_code"><h3>{{ $data['full_name'] }} - şifrənizi yeniləyin</h3></div>
                        <div class="col-lg-12">
                            <div class="login_form">
                                <form  id="passwordForm" action="#">
                                    <input type="hidden" id="idPassword" name="idPassword" value="{{$data['id'] }} ">
                                    <input type="hidden" id="emailPassword" name="emailPassword" value="{{$data['email'] }}">
                                    <div class="input-group form-group mb5">
                                        <input type="password" class="form-control" id="new_password" name="new_password"  placeholder="Yeni şifrə">
                                        <div class="invalid-feedback" id="newPasswordError"></div>
                                    </div>
                                    <div class="input-group form-group mb5">
                                        <input type="password" class="form-control" id="conf_new_password" name="conf_new_password"  placeholder="Yeni şifrə təkrar">
                                        <div class="invalid-feedback" id="confNewPasswordError"></div>
                                    </div>
                                    <button type="submit" class="btn btn-log btn-block btn-thm">Yenilə</button>
                                    <div class="text-success text-center mt-2" id="generalPasswordSuccess"></div>
                                    <div class="text-danger text-center mt-2" id="generalPasswordError"></div>
                                </form>
                            </div>
                        </div>
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
@endsection
