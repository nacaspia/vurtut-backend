@extends('site.layouts.app')
@section('site.title')
    @lang('site.home')
@endsection
@section('site.css')
    <link rel="stylesheet" href="{{ asset("site/css/bootstrap.min.css") }}">
    <link rel="stylesheet" href="{{ asset("site/css/style.css") }}">
    <link rel="stylesheet" href="{{ asset('site/css/dashbord_navitaion.css') }}">
    <link rel="stylesheet" href="{{ asset("site/css/responsive.css") }}">
    @yield('company.css')
@endsection
@section('site.content')
    <?php $company = auth('company')->user(); ?>
    @if (!empty($company['country_id']) && !empty($company['city_id']))
    <section style="padding-top: 0px;!important;" class="extra-dashboard-menu dn-992">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ed_menu_list mt5">
                        <ul>
                            <li><a class="{{ Route::currentRouteName() === 'site.company.index' ? 'active' : '' }}" href="{{ route('site.company.index') }}"><span class="flaticon-web-page"></span>Müəssisəm</a></li>
                            <li><a class="{{ Route::currentRouteName() === 'site.company.settings' ? 'active' : '' }}" href="{{ route('site.company.settings') }}"><span class="flaticon-avatar"></span>Parametrlər</a></li>
                            <li><a class="{{ Route::currentRouteName() === 'site.company.announcements' ? 'active' : '' }}" href="{{ route('site.company.announcements') }}"><span class="flaticon-list"></span>Bildirişlərim</a></li>
                            <li><a class="{{ Route::currentRouteName() === 'site.company-post.index' ? 'active' : '' }}" href="{{ route('site.company-post.index') }}"><span class="flaticon-love"></span>Qalereya</a></li>
                            <li><a class="{{ Route::currentRouteName() === 'site.company-services.index' ? 'active' : '' }}" href="{{ route('site.company-services.index') }}"><span class="flaticon-love"></span>Xidmət və məhsullar</a></li>
                            @if($company['category']['is_reservation']== true)
                            <li><a class="{{ Route::currentRouteName() === 'site.company.reservation' ? 'active' : '' }}" href="{{ route('site.company.reservation') }}"><span class="flaticon-logout"></span>Rezervasiyalarım</a></li>
                            @endif
                            <li class="{{ Route::currentRouteName() === 'site.company.statistics' ? 'active' : '' }}"><a href="{{ route('site.company.statistics') }}"><span class="flaticon-logout"></span>Statistikalar</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif
    @yield('company.content')
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
    <!-- Custom script for all pages -->
    <script src="{{ asset("site/js/script.js") }}"></script>
    @yield('company.js')
@endsection
