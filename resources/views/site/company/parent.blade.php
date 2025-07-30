@extends('site.company.layouts.app')
@section('company.css')
    <link type="text/css" rel="stylesheet" href="{{ asset('site/css/modal.css') }}">
@endsection
@section('company.content')
    <div class="col-md-9" style="top: 52px!important;">
        <div class="dashboard-title dt-inbox fl-wrap">
            @include('components.site.error')
            <h3>@lang('site.parent')</h3>
        </div>
        <!-- dashboard-list-box-->
        <div class="dashboard-list-box  fl-wrap">
            <!-- dashboard-list -->
            @if(!empty($parentCompany[0]))
                @foreach($parentCompany as $parent)
                <div class="dashboard-list fl-wrap">
                    <div class="dashboard-message">
                        <div class="booking-list-contr">
                            <a class="red-bg tolt" data-microtip-position="left" data-tooltip="Status" style="@if ($parent['status'] == 0)background: #ff0000; @else background:#20be26 @endif">
                                @if ($parent['status'] == 1)
                                    <i class="far fa-check"></i>
                                @else
                                    <i class="far fa-times"></i>
                                @endif
                            </a>
                        </div>
                        <div class="dashboard-message-text">
                            <img src="{{ !empty($parent->image)? asset("uploads/company/".$parent->image): asset('site/images/avatar/avatar.png') }}" alt="{{ $parent->full_name }}">
                            <h4><a href="{{ route('site.companyDetails',$parent['id']) }}">{{ $parent['full_name'] }}</a></h4>
                            <div class="geodir-category-location clearfix">{{!empty($parent['data']->address)? $parent['data']->address.' / ': null }}<a href="tel:{{$parent['phone'] }}">{{$parent['phone'] }}</a></div>
                        </div>
                    </div>
                </div>
                @endforeach
            @endif
            <!-- dashboard-list end-->
        </div>
        <!-- dashboard-list-box end-->
    </div>
@endsection
@section('company.js')
@endsection
