@extends('site.company.layouts.app')
@section('company.css')
@endsection
@section('company.content')
    <!-- Our Dashbord -->
    <section class="our-dashbord dashbord bgc-f4">
        <div class="container">
            <div class="row">
                @include('site.company.layouts.mobile-menu')
                <div class="col-lg-12 mb15">
                    <div class="breadcrumb_content style2">
                        <h2 class="breadcrumb_title float-left">Bildirişlərim</h2>
                    </div>
                </div>
            </div>
            <div class="col-lg-100 col-xl-auto">
                <div class="recent_job_activity">
                    <h4 class="title">Ən son hərəkətlər</h4>
                    @if(!empty($logs[0]))
                        @foreach($logs as $log)
                    {{--<div class="grid style1">
                        <ul>
                            <li class="list-inline-item"><div class="icon"><span class="fa fa-check"></span></div></li>
                            <li class="list-inline-item"><p>Your listing <span>Hotel Gulshan</span> has been approved!.</p></li>
                        </ul>
                    </div>--}}
                        @if($log['subj_table'] == 'company_commits')
                            <div class="grid style2">
                                <ul>
                                    <li class="list-inline-item"><div class="icon"><span class="flaticon-comment"></span></div></li>
                                    <li class="list-inline-item"><p><a href="{{ route('site.companyDetails',['slug' => $log['company']['slug']]) }}" target="_blank"><span>{{ $log['objUser']['full_name'] }}</span></a> adlı istifadəçi rəy bildirdi.</p></li>
                                </ul>
                            </div>
                        @elseif($log['subj_table'] == 'reservations')
                            <div class="grid style3">
                                <ul>
                                    <li class="list-inline-item"><div class="icon"><span class="flaticon-note"></span></div></li>
                                    <li class="list-inline-item"><p><a href="{{ route('site.company.reservation') }}" target="_blank"><span>{{ $log['objUser']['full_name'] }}</span></a> adlı istifadəçi rezarvasiya etdi.</p></li>
                                </ul>
                            </div>
                        @endif
                    {{--<div class="grid style4">
                        <ul>
                            <li class="list-inline-item"><div class="icon"><span class="flaticon-love"></span></div></li>
                            <li class="list-inline-item"><p>Someone bookmarked your <span>Burger House</span> listing!</p></li>
                        </ul>
                    </div>--}}
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection
@section('company.js')
@endsection
