@extends('admin.layouts.app')
@section('admin.title')
    @lang('admin.edit')
@endsection
@section('admin.css')
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/css/select2.min.css') }}">
    <link rel="stylesheet" id="rtlStyle" href="#">
@endsection
@section('admin.content')
    <div class="main-content">
        <div class="dashboard-breadcrumb mb-25">
            <h2>@lang('admin.user')</h2>
        </div>
        @include('components.admin.error')
        <div class="row">
            <div class="col-12">
                <form action="{{ route('admin.users.update',$user['id']) }}" method="POST"
                      enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="panel">
                        <div class="panel-header">
                            <nav>
                                <div class="btn-box d-flex flex-wrap gap-1" id="nav-tab" role="tablist">
                                    <button class="btn btn-sm btn-outline-primary active" id="nav-edit-profile-tab"
                                            data-bs-toggle="tab" data-bs-target="#nav-edit-profile" type="button"
                                            role="tab" aria-controls="nav-edit-profile"
                                            aria-selected="true">@lang('admin.edit_profile')</button>
                                    <button class="btn btn-sm btn-outline-primary" id="nav-change-password-tab"
                                            data-bs-toggle="tab" data-bs-target="#nav-change-password" type="button"
                                            role="tab" aria-controls="nav-change-password"
                                            aria-selected="false">@lang('admin.change_password')</button>
                                    {{--                                <button class="btn btn-sm btn-outline-primary" id="nav-other-settings-tab" data-bs-toggle="tab" data-bs-target="#nav-other-settings" type="button" role="tab" aria-controls="nav-other-settings" aria-selected="false">@lang('admin.other')</button>--}}
                                </div>
                            </nav>
                        </div>
                        <div class="panel-body">
                            <div class="tab-content profile-edit-tab" id="nav-tabContent">
                                <div class="tab-pane fade show active" id="nav-edit-profile" role="tabpanel" aria-labelledby="nav-edit-profile-tab" tabindex="0">
                                    <div class="public-information mb-25">
                                        <div class="row g-4">
                                            <div class="col-md-3">
                                                <div class="admin-profile">
                                                    <div class="image-wrap">
                                                        <div class="part-img rounded-circle overflow-hidden">
                                                            <img
                                                                src="{{ !empty($user['image'])? asset("uploads/user/".$user['image']): asset('admin/avatar/avatar.png') }}"
                                                                alt="admin">
                                                        </div>
                                                    </div>
                                                    <span class="admin-name">{!! $user['full_name'] !!}</span>
                                                </div>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="row g-3">
                                                    <div class="col-sm-6">
                                                        <div class="input-group">
                                                            <span class="input-group-text"><i
                                                                    class="fa-light fa-user"></i></span>
                                                            <input type="text" class="form-control" name="full_name"
                                                                   placeholder="@lang('admin.full_name')"
                                                                   value="{!! !empty($user['full_name'])? $user['full_name']: old('full_name') !!}">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="input-group">
                                                            <span class="input-group-text"><i
                                                                    class="fa-light fa-at"></i></span>
                                                            <input type="text" class="form-control" name="email"
                                                                   placeholder="@lang('admin.email')"
                                                                   value="{!! !empty($user['email'])? $user['email']: old('email') !!}">
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <textarea class="form-control h-150-p" name="text"
                                                                  placeholder="@lang('admin.text')">{!! !empty($user['text'])? $user['text']: old('text') !!}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="profile-edit-tab-title">
                                        <h6>@lang('admin.private_information')</h6>
                                    </div>
                                    <div class="private-information mb-25">
                                        <div class="row g-3">
                                            <div class="col-sm-6">
                                                <div class="input-group">
                                                    <span class="input-group-text"><i
                                                            class="fa-light fa-user"></i></span>
                                                    <input type="text" class="form-control" disabled="disabled"
                                                           value="VT {{$user['id']}}">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="input-group flex-nowrap">
                                                    <span class="input-group-text"><i
                                                            class="fa-light fa-circle-check"></i></span>
                                                    <select class="form-control" data-placeholder="Status"
                                                            name="status">
                                                        <option value="">-@lang('admin.choose')</option>
                                                        <option value="0"
                                                                @if($user['status'] == 0) selected @endif>@lang('admin.nonactive')</option>
                                                        <option value="1"
                                                                @if($user['status'] == 1) selected @endif>@lang('admin.active')</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="input-group">
                                                    <span class="input-group-text"><i
                                                            class="fa-light fa-phone"></i></span>
                                                    <input type="tel" class="form-control" name="phone"
                                                           placeholder="phone"
                                                           value="{!! !empty($user['phone'])?  $user['phone']: old('phone') !!}">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="input-group">
                                                    <span class="input-group-text"><i
                                                            class="fa-brands fa-facebook-f"></i></span>
                                                    <input type="text" class="form-control" name="gender"
                                                           placeholder="Gender"
                                                           value="{!! !empty($user['data']['gender'])?  $user['data']['gender']: old('gender') !!}">
                                                </div>
                                            </div>

                                            <div class="col-sm-6">
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="fa-light fa-location"></i></span>
                                                    <input type="text" class="form-control" name="address"
                                                           placeholder="address"
                                                           value="{!! !empty($user['data']['address'])? $user['data']['address']: old('address') !!}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="nav-change-password" role="tabpanel"
                                     aria-labelledby="nav-change-password-tab" tabindex="0">
                                    <div class="social-information">
                                        <div class="row g-3">
                                            <div class="col-12">
                                                <div class="input-group">
                                                    <span class="input-group-text"><i
                                                            class="fa-light fa-lock"></i></span>
                                                    <input type="password" class="form-control" name="current_password"
                                                           placeholder="@lang('admin.current_password')">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="input-group">
                                                    <span class="input-group-text"><i
                                                            class="fa-light fa-lock"></i></span>
                                                    <input type="password" class="form-control" name="new_password"
                                                           placeholder="@lang('admin.new_password')">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="input-group">
                                                    <span class="input-group-text"><i
                                                            class="fa-light fa-lock"></i></span>
                                                    <input type="password" class="form-control" name="confirm_password"
                                                           placeholder="@lang('admin.confirm_password')">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">@lang('admin.save')</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('admin.js')
    <script src="{{ asset('admin/assets/vendor/js/select2.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/select2-init.js') }}"></script>
@endsection

