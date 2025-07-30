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
            <h2>@lang('admin.cms_user')</h2>
        </div>
        @include('components.admin.error')
        <div class="row">
            <div class="col-12">
                <form action="{{ route('admin.cms-users.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="panel">
                        <div class="panel-body">
                            <div class="tab-content profile-edit-tab" id="nav-tabContent">
                                <div class="tab-pane fade show active" id="nav-edit-profile" role="tabpanel"
                                     aria-labelledby="nav-edit-profile-tab" tabindex="0">

                                    <div class="private-information mb-25">
                                        <div class="row g-3">
                                            <div class="col-sm-6">
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="fa-light fa-user"></i></span>
                                                    <input type="text" class="form-control" value="{{ old('name') }}" name="name">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="fa-light fa-user"></i></span>
                                                    <input type="text" class="form-control" value="{{ old('surname') }}" name="surname">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="fa-light fa-user"></i></span>
                                                    <input type="text" class="form-control" value="{{ old('father_name') }}" name="father_name">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="fa-light fa-phone"></i></span>
                                                    <input type="text" class="form-control" value="{{ old('phone') }}" name="phone">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="fa-light fa-at"></i></span>
                                                    <input type="email" class="form-control" value="{{ old('email') }}" name="email">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="fa-light fa-user-secret"></i></span>
                                                    <input type="password" class="form-control" value="" name="password">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="fa-light fa-sellcast"></i></span>
                                                    <select class="form-control" name="role">
                                                        <option value="">@lang('admin.choose')</option>
                                                        @foreach($roles as $role)
                                                        <option value="{{$role['name']}}">{{$role['name']}}</option>
                                                        @endforeach
                                                    </select>
{{--                                                    <input type="email" class="form-control" value="{{ old('email') }}" name="email">--}}
                                                </div>
                                            </div>

                                            <div class="col-sm-6">
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="fa-light fa-circle-check"></i></span>
                                                    <select class="form-control" data-placeholder="Status"
                                                            name="status">
                                                        <option value="">-@lang('admin.choose')</option>
                                                        <option value="0" >@lang('admin.nonactive')</option>
                                                        <option value="1" >@lang('admin.active')</option>
                                                    </select>
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

