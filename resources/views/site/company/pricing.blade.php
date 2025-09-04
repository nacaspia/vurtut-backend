@extends('site.layouts.app')
@section('site.title')
    @lang('site.home')
@endsection
@section('site.css')
    <link rel="stylesheet" href="{{ asset("site/css/bootstrap.min.css") }}">
    <link rel="stylesheet" href="{{ asset("site/css/style.css") }}">
    <link rel="stylesheet" href="{{ asset("site/css/responsive.css") }}">
@endsection
@section('site.content')
    <!-- Inner Page Breadcrumb -->
    <section class="inner_page_breadcrumb">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-6">
                    <div class="breadcrumb_content">
                        <h2 class="breadcrumb_title">ABONƏLİK PAKETLƏRİ</h2>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Əsas səhifə</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Abonəlik paketləri</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Service Section Area -->
    <section class="our-service pb30">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <div class="main-title text-center">
                        <h2>İlk ay bütün müəssisələr üçün premium paket ödənişsizdir!</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6 col-md-6 col-lg-4">
                    <div class="pricing_table">
                        <div class="pricing_header">
                            <div class="price">15.99 AZN/ay</div>
                            <h4>Premium paket</h4>
                        </div>
                        <div class="pricing_content">
                            <ul class="mb0">
                                <li>Limitsiz foto paylaşma imkanı</li>
                                <li>Rezervasiya xidməti</li>
                                <li>Statistikalar</li>
                                <li>Axtarışda önə çıxmalar</li>
                            </ul>
                        </div>
                        <div class="pricing_footer">
                            @if(auth('company')->user()->is_premium != 1)
                                <a class="btn pricing_btn btn-block" href="#" data-toggle="modal" data-target="#premiumCompany">Paketi aktivləşdir</a>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-6 col-lg-4">
                    <div class="pricing_table">
                        <div class="pricing_header">
                            <div class="price">59.99 AZN/6 ay</div>
                            <h4>Premium paket</h4>
                        </div>
                        <div class="pricing_content">
                            <ul class="mb0">
                                <li>Limitsiz foto paylaşma imkanı</li>
                                <li>Rezervasiya xidməti</li>
                                <li>Statistikalar</li>
                                <li>Axtarışda önə çıxmalar</li>
                            </ul>
                        </div>
                        <div class="pricing_footer">
                            @if(auth('company')->user()->is_premium != 1)
                                <a class="btn pricing_btn btn-block" href="#" data-toggle="modal" data-target="#premiumCompany">Paketi aktivləşdir</a>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-6 col-lg-4">
                    <div class="pricing_table">
                        <div class="pricing_header">
                            <div class="price">99.99 AZN/12 ay</div>
                            <h4>Premium paket</h4>
                        </div>
                        <div class="pricing_content">
                            <ul class="mb0">
                                <li>Limitsiz foto paylaşma imkanı</li>
                                <li>Rezervasiya xidməti</li>
                                <li>Statistikalar</li>
                                <li>Axtarışda önə çıxmalar</li>
                            </ul>
                        </div>
                        <div class="pricing_footer">
                            @if(auth('company')->user()->is_premium != 1)
                                <a class="btn pricing_btn btn-block" href="#" data-toggle="modal" data-target="#premiumCompany">Paketi aktivləşdir</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Start Partners -->
    <section class="start-partners home1 bgc-thm pt60 pb60">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="start_partner tac-smd">
                        <h2>Reklam üçün müraciət!</h2>
                        <p>İlk sıralarda yerini möhkəmlət!</p>
                    </div>
                </div>
                <div class="col-lg-4 pr10">
                    <div class="parner_reg_btn text-right tac-smd">
                        <a class="btn" href="{{ route('site.contact') }}">Müraciət et!</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="modal fade" id="premiumCompany" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document" style="max-width: 500px;">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Premium Hesab Al</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Bağla">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('site.company.premium.redirectToBank') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <p>Premium hesab alaraq hesabınızı önə çıxarın və daha çox istifadəçiyə çata bilərsiniz.</p>

                        <div class="form-group">
                            <label for="premiumDuration">Premium müddəti:</label>
                            <select name="plan" id="premiumDuration" class="form-control" required>
                                @foreach(config("premium.limits") as $planKey => $plan)
                                    <option value="{{ $planKey }}">{{ $plan['label'] }}: {{ $plan['amount'] }} AZN
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="alert alert-info mt-3">
                            Korporativ tərəfdaşlıqlar üçün strateji əməkdaşlıq imkanları mövcuddur. Ətraflı məlumat üçün bizimlə rəsmi əlaqə saxlayın.
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Bağla</button>
                        <button type="submit" class="btn btn-primary">Ödənişə keç</button>
                    </div>
                </form>
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
@endsection
