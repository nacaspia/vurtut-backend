@extends('site.company.layouts.app')
@section('company.css')
@endsection
@section('company.content')
    <!-- Our Dashbord -->
    <section class="our-dashbord dashbord bgc-f4">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 mb10">
                    <div class="breadcrumb_content style2">
                        <h2 class="breadcrumb_title float-left">Statistikalar</h2>
                    </div>
                </div>
                <div class="stat-row col-lg-2 col-md-4 col-sm-6 mb-4">
                    <div class="stat-card">
                        <div class="icon"><span class="flaticon-list"></span></div>
                        <div class="detais">
                            <div class="timer">{{ $company['reads'] }}</div>
                            <p>Ziyarət edənlər</p>
                        </div>
                    </div>
                </div>
                <div class="statt-row col-lg-2 col-md-4 col-sm-6 mb-4">
                    <div class="stat-card">
                        <div class="icon"><span class="flaticon-note"></span></div>
                        <div class="detais">
                            <div class="timer">{{ count($company['comments']) }}</div>
                            <p>Rəy və reytinq</p>
                        </div>
                    </div>
                </div>
                <div class="stat-row col-lg-2 col-md-4 col-sm-6 mb-4">
                    <div class="stat-card">
                        <div class="icon"><span class="flaticon-chat"></span></div>
                        <div class="detais">
                            <div class="timer">{{ count($company['companyReservation']) }}</div>
                            <p>Rezervasiyalar</p>
                        </div>
                    </div>
                </div>
                <div class="stat-row col-lg-2 col-md-4 col-sm-6 mb-4">
                    <div class="stat-card">
                        <div class="icon"><span class="flaticon-love"></span></div>
                        <div class="detais">
                            <div class="timer">{{ $company['like'] }}</div>
                            <p>Sevənlər</p>
                        </div>
                    </div>
                </div>
                <div class="stat-row col-lg-2 col-md-4 col-sm-6 mb-4">
                    <div class="stat-card">
                        <div class="icon"><span class="flaticon-chat"></span></div>
                        <div class="detais">
                            <div class="timer">{{ $company['share'] }}</div>
                            <p>Paylaşımlar</p>
                        </div>
                    </div>
                </div>
                <div class="stat-row col-lg-2 col-md-4 col-sm-6 mb-4">
                    <div class="stat-card">
                        <div class="icon"><span class="flaticon-chat"></span></div>
                        <div class="detais">
                            <div class="timer">{{ count($company['parent']) }}</div>
                            <p>Filiallar</p>
                        </div>
                    </div>
                </div>
                {{--<div class="col-lg-12 col-xl-12">
                    <div class="application_statics">
                        <h4>Total Views</h4>
                        <div class="c_container"></div>
                    </div>
                </div>--}}
            </div>
        </div>
    </section>
@endsection
@section('company.js')
  {{--  <script src="{{ asset('site/js/chart.min.js') }}"></script>
    <script src="{{ asset('site/js/chart-custome.js') }}"></script>--}}
@endsection
