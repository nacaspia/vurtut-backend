@extends('site.company.layouts.app')
@section('company.css')
@endsection
@section('company.content')
    <!-- Our Dashbord -->
    <section class="our-dashbord dashbord bgc-f4">
        <div class="container">
            <div class="row">
                @include('site.company.layouts.mobile-menu')
                <div class="col-lg-12 mb10">
                    <div class="breadcrumb_content style2">
                        <h2 class="breadcrumb_title float-left">Statistikalar</h2>
                    </div>
                </div>
                @if($company['is_premium'] == 1)
                <div class="stat-row col-lg-2 col-md-4 col-sm-6 mb-4">
                    <div class="stat-card">
                        <div class="icon">
                            <i class="fa fa-street-view"></i>
                        </div>
                        <div class="detais">
                            <div class="timer">{{ $company['reads'] }}</div>
                            <p>Ziyarət edənlər</p>
                        </div>
                    </div>
                </div>
                <div class="statt-row col-lg-2 col-md-4 col-sm-6 mb-4">
                    <div class="stat-card">
                        <div class="icon">
                            <i class="fa fa-comment"></i>
                        </div>
                        <div class="detais">
                            <div class="timer">{{ count($company['comments']) }}</div>
                            <p>Rəy və reytinq</p>
                        </div>
                    </div>
                </div>
                <div class="stat-row col-lg-2 col-md-4 col-sm-6 mb-4">
                    <div class="stat-card">
                        <div class="icon">
                            <i class="fa fa-calendar-check-o"></i>
                        </div>
                        <div class="detais">
                            <div class="timer">{{ count($company['companyReservation']) }}</div>
                            <p>Rezervasiyalar</p>
                        </div>
                    </div>
                </div>
                <div class="stat-row col-lg-2 col-md-4 col-sm-6 mb-4">
                    <div class="stat-card">
                        <div class="icon">
                            <i class="fa fa-heart"></i>
                        </div>
                        <div class="detais">
                            <div class="timer">{{ $company['like'] ?? 0 }}</div>
                            <p>Sevənlər</p>
                        </div>
                    </div>
                </div>
                <div class="stat-row col-lg-2 col-md-4 col-sm-6 mb-4">
                    <div class="stat-card">
                        <div class="icon">
                            <i class="fa fa-share"></i>
                        </div>
                        <div class="detais">
                            <div class="timer">{{ $company['share'] }}</div>
                            <p>Paylaşımlar</p>
                        </div>
                    </div>
                </div>
                <div class="stat-row col-lg-2 col-md-4 col-sm-6 mb-4">
                    <div class="stat-card">
                        <div class="icon">
                            <i class="fa fa-building"></i>
                        </div>
                        <div class="detais">
                            <div class="timer">{{ count($company['parent']) }}</div>
                            <p>Filiallar</p>
                        </div>
                    </div>
                </div>
                @else
                    <div class="statt-row col-lg-2 col-md-4 col-sm-6 mb-4">
                        <div class="stat-card">
                            <div class="icon">
                                <i class="fa fa-comment"></i>
                            </div>
                            <div class="detais">
                                <div class="timer">{{ count($company['comments']) }}</div>
                                <p>Rəy və reytinq</p>
                            </div>
                        </div>
                    </div>
                    <div class="stat-row col-lg-2 col-md-4 col-sm-6 mb-4">
                        <div class="stat-card">
                            <div class="icon">
                                <i class="fa fa-heart"></i>
                            </div>
                            <div class="detais">
                                <div class="timer">{{ $company['like'] ?? 0 }}</div>
                                <p>Sevənlər</p>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>
@endsection
@section('company.js')
@endsection
