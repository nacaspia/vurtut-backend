@extends('admin.layouts.app')
@section('admin.title')
    @lang('admin.edit')
@endsection
@section('admin.css')
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/css/select2.min.css') }}">
@endsection
@section('admin.content')
    <div class="main-content">
        <div class="dashboard-breadcrumb mb-25">
            <h2>@lang('admin.settings')</h2>
        </div>
        @include('components.admin.error')
        <div class="row">
            <div class="col-12">
                <form action="{{ !empty($settings)? route('admin.settingsUpdate',$settings['id']): route('admin.settingsSave') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @if(!empty($settings)) @method('PUT') @endif
                    <div class="panel">
                        <div class="panel-header">
                            <nav>
                                <div class="btn-box d-flex flex-wrap gap-1" id="nav-tab" role="tablist">
                                    <button class="btn btn-sm btn-outline-primary active" id="nav-edit-profile-tab"
                                            data-bs-toggle="tab" data-bs-target="#nav-edit-profile" type="button"
                                            role="tab" aria-controls="nav-edit-profile"
                                            aria-selected="true">@lang('admin.edit_profile')</button>
                                    <button class="btn btn-sm btn-outline-primary" id="nav-social-tab"
                                            data-bs-toggle="tab" data-bs-target="#nav-social" type="button"
                                            role="tab" aria-controls="nav-social"
                                            aria-selected="false">Sosial şəbəkələr</button>
                                    <button class="btn btn-sm btn-outline-primary" id="nav-logo-tab"
                                            data-bs-toggle="tab" data-bs-target="#nav-logo" type="button"
                                            role="tab" aria-controls="nav-logo"
                                            aria-selected="false">Logo və Favicon</button>
                                </div>
                            </nav>
                        </div>
                        <div class="panel-body">
                            <div class="tab-content profile-edit-tab" id="nav-tabContent">
                                <div class="tab-pane fade show active" id="nav-edit-profile" role="tabpanel" aria-labelledby="nav-edit-profile-tab" tabindex="0">
                                    <div class="public-information mb-25">
                                        <div class="row g-4">
                                            <div class="col-md-9">
                                                <div class="row g-3">
                                                    <div class="col-sm-6">
                                                        <div class="input-group">
                                                            <span class="input-group-text"><i
                                                                    class="fa-light fa-user"></i></span>
                                                            <input type="text" class="form-control" name="full_name"
                                                                   placeholder="@lang('admin.name')"
                                                                   value="{!! !empty($settings['full_name'])? $settings['full_name']: old('full_name') !!}">
                                                        </div>
                                                    </div>

                                                    <div class="col-12">
                                                        <textarea class="form-control h-150-p" name="text" placeholder="@lang('admin.text')">{!! !empty($settings['text'])? $settings['text']: old('text') !!}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="nav-social" role="tabpanel" aria-labelledby="nav-social-tab" tabindex="0">
                                    <div class="private-information mb-25">
                                        <div class="row g-3">
                                            <div class="col-sm-6">
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="fa-brands fa-facebook-f"></i></span>
                                                    <input type="text" class="form-control" name="facebook"  value="{!! (!empty($settings['social']) && !empty($settings['social']['facebook']))? $settings['social']['facebook']: old('facebook') !!}">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="input-group">
                                                    <span class="input-group-text">T</span>
                                                    <input type="text" class="form-control" name="tiktok"  value="{!! (!empty($settings['social']) &&  !empty($settings['social']['tiktok']))? $settings['social']['tiktok']: old('tiktok') !!}">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="fa-brands fa-instagram"></i></span>
                                                    <input type="text" class="form-control" name="instagram"  value="{!! (!empty($settings['social']) && !empty($settings['social']['instagram']))? $settings['social']['instagram']: old('instagram') !!}">
                                                </div>
                                            </div>

                                            <div class="col-sm-6">
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="fa-brands fa-linkedin"></i></span>
                                                    <input type="text" class="form-control" name="linkedin" value="{!! (!empty($settings['social']) && !empty($settings['social']['linkedin']))? $settings['social']['linkedin']: old('linkedin') !!}">
                                                </div>
                                            </div>

                                            <div class="col-sm-6">
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="fa-brands fa-youtube"></i></span>
                                                    <input type="text" class="form-control" name="youtube" value="{!! (!empty($settings['youtube']) && !empty($settings['social']['youtube']))? $settings['social']['youtube']: old('youtube') !!}">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="input-group">
                                                            <span class="input-group-text"><i
                                                                    class="fa-light fa-at"></i></span>
                                                    <input type="text" class="form-control" name="email"
                                                           placeholder="@lang('admin.email')"
                                                           value="{!! !empty($settings['social']['email'])? $settings['social']['email']: old('email') !!}">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="fa-light fa-phone"></i></span>
                                                    <input type="tel" class="form-control" name="phone" value="{!! !empty($settings['social']['phone'])?  $settings['social']['phone']: old('phone') !!}">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="fa-light fa-phone"></i></span>
                                                    <input type="tel" class="form-control" name="phone_two" value="{!! !empty($settings['social']['phone_two'])?  $settings['social']['phone_two']: old('phone_two') !!}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="nav-logo" role="tabpanel" aria-labelledby="nav-logo-tab" tabindex="0">
                                    <div class="public-information mb-25">
                                        <div class="row g-4">
                                            <div class="col-md-9">
                                                <div class="row g-3">

                                                    <div class="col-sm-6">
                                                        <label>Header logo</label>
                                                        <input type="file" name="header_logo" accept="image/png, image/jpeg, image/jpg, image/svg+xml">
                                                        <br><br>
                                                        <div class="admin-profile">
                                                            <div class="image-wrap">
                                                                <img src="{{ !empty($settings['logo']['header_logo'])? asset("uploads/header_logo/".$settings['logo']['header_logo']): asset('admin/avatar/avatar.png') }}" alt="admin">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label>Footer logo</label>
                                                        <input type="file" name="footer_logo" accept="image/png, image/jpeg, image/jpg, image/svg+xml">
                                                        <br><br>
                                                        <div class="admin-profile">
                                                            <div class="image-wrap">
                                                                <img src="{{ !empty($settings['logo']['footer_logo'])? asset("uploads/footer_logo/".$settings['logo']['footer_logo']): asset('admin/avatar/avatar.png') }}" alt="admin">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label>Favicon</label>
                                                        <input type="file" name="favicon" accept="image/png, image/jpeg, image/jpg, image/svg+xml">
                                                        <br><br>
                                                        <div class="admin-profile">
                                                            <div class="image-wrap">
                                                                <img src="{{ !empty($settings['logo']['favicon'])? asset("uploads/favicon/".$settings['logo']['favicon']): asset('admin/avatar/avatar.png') }}" alt="admin">
                                                            </div>
                                                        </div>
                                                    </div>
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
