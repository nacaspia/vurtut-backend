@extends('site.layouts.app')
@section('site.title')
    @lang('site.home')
@endsection
@section('site.css')
    <link rel="stylesheet" href="{{ asset("site/css/bootstrap.min.css") }}">
    <link rel="stylesheet" href="{{ asset("site/css/style.css") }}">
    <link rel="stylesheet" href="{{ asset('site/css/dashbord_navitaion.css') }}">
    <link rel="stylesheet" href="{{ asset("site/css/responsive.css") }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    {{--<script src="http://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="http://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>--}}
    @yield('user.css')
@endsection
@section('site.content')
    <?php $user = auth('user')->user(); ?>
    @if (!empty($user['country_id']) && !empty($user['city_id']))
 <style>
        .ed_menu_list ul li a {
            color: #ffffff;
            display: block;
            font-size: 16px;
            font-weight: 400;
            line-height: 23px;
            padding: 17px 21px 15px;
            border-radius: 50px;
            text-decoration: none;
        }
    </style>

    <!-- Hazirdi -->
    <section style="padding-top: 0px;!important;" class="extra-dashboard-menu dn-992">

        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ed_menu_list mt5">
                        <ul style="padding: 10px 0;">
                            <li><a class="{{ Route::currentRouteName() === 'site.user.index' ? 'active' : '' }}" href="{{ route('site.user.index') }}"><i class="fa-solid fa-user"  style="padding-right: 5px;"></i>Hesabım</a></li>
                            <li><a class="{{ Route::currentRouteName() === 'site.user.settings' ? 'active' : '' }}" href="{{ route('site.user.settings') }}"><i class="fa-solid fa-gear" style="padding-right: 5px;"></i>Parametrlər</a></li>
                            <li><a class="{{ Route::currentRouteName() === 'site.user.announcements' ? 'active' : '' }}" href="{{ route('site.user.announcements') }}"><i class="fa-solid fa-bell" style="padding-right: 5px;"></i>Bildirişlərim</a></li>
                            <li><a class="{{ Route::currentRouteName() === 'site.user.favorites' ? 'active' : '' }}" href="{{ route('site.user.favorites') }}"><i class="fa-solid fa-heart" style="padding-right: 5px;"></i>Sevimlilər</a></li>
{{--                            <li><a class="{{ Route::currentRouteName() === 'site.user.review' ? 'active' : '' }}" href="{{ route('site.user.review') }}"><i class="fa-solid fa-comment" style="padding-right: 5px;"></i>Rəylərim</a></li>--}}
                            <li><a class="{{ Route::currentRouteName() === 'site.user.reservation' ? 'active' : '' }}" href="{{ route('site.user.reservation') }}"><i class="fa-solid fa-calendar-check"  style="padding-right: 5px;"></i>Rezervasiyalarım</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif
    @yield('user.content')
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
    <script src="{{ asset("site/js/wow.min.js") }}"></script>
    <script src="{{ asset("site/js/dashboard-script.js") }}"></script>
    <script src="{{ asset("site/js/isotop.js") }}"></script>
    <!-- Custom script for all pages -->
    <script src="{{ asset("site/js/script.js") }}"></script>
    @yield('user.js')
@endsection
