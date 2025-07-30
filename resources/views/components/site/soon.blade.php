@extends('site.layouts.app')
@section('site.title')
    @lang('site.about_us')
@endsection
@section('site.css')
@endsection
@section('site.content')
    <!-- wrapper-->
    <div id="wrapper">
        <!-- content-->
        <div class="content">
            <!--  section  -->
            <section class="parallax-section small-par" data-scrollax-parent="true">
                <div class="bg"  data-bg="{{ asset('site/images/bg/hero/4.jpg') }}" data-scrollax="properties: { translateY: '30%' }"></div>
                <div class="overlay op7"></div>
                <div class="container">
                    <div class="error-wrap">
                        <div class="bubbles">
                            <h2>Tezliklə xidmətinizdəyik</h2>
                        </div>
                        <div class="clearfix"></div>
                        <a href="{{ route('site.index') }}" class="btn   color2-bg">Geri Qayıt<i class="far fa-home-alt"></i></a>
                    </div>
                </div>
            </section>
            <!--  section  end-->
        </div>
        <!--content end-->
    </div>
    <!-- wrapper end-->
@endsection
@section('site.js')
@endsection
