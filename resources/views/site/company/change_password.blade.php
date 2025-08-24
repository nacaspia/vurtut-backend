@extends('site.company.layouts.app')
@section('company.css')
@endsection
@section('company.content')
    <div class="col-md-9">
        <div class="dashboard-title   fl-wrap">
            @include('components.site.error')
            <h3>@lang('site.change_password')</h3>
        </div>
        <!-- profile-edit-container-->
        <div class="profile-edit-container fl-wrap block_box">
            <form action="{{ route('site.company.change-password-update',$company->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="custom-form">
                    <div class="pass-input-wrap fl-wrap">
                        <label>@lang('site.current_password')</label>
                        <input type="password" class="pass-input" name="current_password" placeholder="" value=""/>
                        <span class="eye"><i class="far fa-eye" aria-hidden="true"></i> </span>
                    </div>
                    <div class="pass-input-wrap fl-wrap">
                        <label>@lang('site.new_password')</label>
                        <input type="password" class="pass-input" name="new_password" placeholder="" value=""/>
                        <span class="eye"><i class="far fa-eye" aria-hidden="true"></i> </span>
                    </div>
                    <div class="pass-input-wrap fl-wrap">
                        <label>@lang('site.confirm_new_password')</label>
                        <input type="password" class="pass-input" name="confirm_new_password" placeholder="" value=""/>
                        <span class="eye"><i class="far fa-eye" aria-hidden="true"></i> </span>
                    </div>
                    <button type="submit" class="btn    color2-bg  float-btn">@lang('site.save')<i class="fal fa-save"></i></button>
                </div>
            </form>
        </div>
        <!-- profile-edit-container end-->
    </div>
@endsection
@section('company.js')

@endsection
