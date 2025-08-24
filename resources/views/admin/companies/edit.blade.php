@extends('admin.layouts.app')
@section('admin.title')
    @lang('admin.edit')
@endsection
@section('admin.css')
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/css/OverlayScrollbars.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/css/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/css/style.css') }}">
    <link rel="stylesheet" id="primaryColor" href="{{ asset('admin/assets/css/blue-color.css') }}">
@endsection
@section('admin.content')
    <div class="main-content">
        <div class="dashboard-breadcrumb mb-25">
            <h2>@lang('admin.company')</h2>
        </div>
        @include('components.admin.error')
        <div class="row">
            <div class="col-12">
{{--                <form action="{{ route('admin.companies.update',$company['id']) }}" method="POST" enctype="multipart/form-data">--}}
{{--                    @csrf--}}
{{--                    @method('PUT')--}}
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
                                    <button class="btn btn-sm btn-outline-primary" id="nav-social-tab"
                                            data-bs-toggle="tab" data-bs-target="#nav-social" type="button"
                                            role="tab" aria-controls="nav-social"
                                            aria-selected="false">Sosial şəbəkələr</button>
                                    <button class="btn btn-sm btn-outline-primary" id="nav-catalog-tab"
                                            data-bs-toggle="tab" data-bs-target="#nav-catalog" type="button"
                                            role="tab" aria-controls="nav-catalog"
                                            aria-selected="false">Kataloglar</button>
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
                                                            <img src="{{ !empty($company['image'])? asset("uploads/company/".$company['image']): asset('admin/avatar/avatar.png') }}" alt="admin">
                                                        </div>
                                                    </div>
                                                    <span class="admin-name">{!! $company['full_name'] !!}</span>
                                                    <span class="admin-role">@lang('admin.'.$company['type'])</span>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="admin-profile">
                                                    <div class="image-wrap">
                                                        <img src="{{ !empty($company['background_image'])? asset("uploads/company/background/".$company['background_image']): asset('admin/avatar/avatar.png') }}" style="max-width: 261%;" alt="admin">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="row g-3">
                                                    <div class="col-sm-4">
                                                        <div class="input-group">
                                                            <span class="input-group-text"><i
                                                                    class="fa-light fa-user"></i></span>
                                                            <input type="text" class="form-control" name="full_name"
                                                                   placeholder="@lang('admin.full_name')"
                                                                   value="{!! !empty($company['full_name'])? $company['full_name']: old('full_name') !!}">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <div class="input-group">
                                                            <span class="input-group-text"><i class="fa-light fa-at"></i></span>
                                                            <input type="text" class="form-control" name="email" placeholder="@lang('admin.email')" value="{!! !empty($company['email'])? $company['email']: old('email') !!}">
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-4">
                                                        <div class="input-group">
                                                            <span class="input-group-text"><i class="fa-light fa-phone"></i></span>
                                                            <input type="tel" class="form-control" disabled="disabled" value="{!! !empty($company['phone'])?  $company['phone']: old('phone') !!}">
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <textarea class="form-control h-150-p" name="text"
                                                                  placeholder="@lang('admin.text')">{!! !empty($company['text'])? $company['text']: old('text') !!}</textarea>
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
                                                <div class="input-group flex-nowrap">
                                                    <span class="input-group-text"><i class="fa-light fa-circle-check"></i></span>
                                                    <select class="form-control">
                                                        <option value="">{{ $company['category']['title']['az'] }}</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="input-group flex-nowrap">
                                                    <span class="input-group-text"><i class="fa-light fa-circle-check"></i></span>
                                                    <select class="form-control">
                                                        <option value="">{{ $company['country']['name']['az'] ?? null }}</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="input-group flex-nowrap">
                                                    <span class="input-group-text"><i class="fa-light fa-circle-check"></i></span>
                                                    <select class="form-control">
                                                        <option value="">{{ $company['mainCities']['name']['az'] ?? null }}</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="input-group flex-nowrap">
                                                    <span class="input-group-text"><i class="fa-light fa-circle-check"></i></span>
                                                    <select class="form-control">
                                                        <option value="">{{ $company['subRegion']['name']['az'] ?? null }}</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="input-group flex-nowrap">
                                                    <span class="input-group-text"><i class="fa-light fa-circle-check"></i></span>
                                                    <select class="form-control" data-placeholder="Status" name="status">
                                                        <option value="">-@lang('admin.choose')</option>
                                                        <option value="0" @if($company['status'] == 0) selected @endif>@lang('admin.nonactive')</option>
                                                        <option value="1" @if($company['status'] == 1) selected @endif>@lang('admin.active')</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="fa-light fa-address-book"></i></span>
                                                    <input type="text" class="form-control" disabled="disabled" value="{!! !empty($company['data'])?  $company['data']['address']: null !!}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="nav-change-password" role="tabpanel" aria-labelledby="nav-change-password-tab" tabindex="0">
                                    <div class="social-information mb-25">
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
                                <div class="tab-pane fade" id="nav-social" role="tabpanel" aria-labelledby="nav-social-tab" tabindex="0">
                                    <div class="private-information mb-25">
                                        <div class="row g-3">
                                            <div class="col-sm-6">
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="fa-brands fa-facebook-f"></i></span>
                                                    <input type="text" class="form-control" disabled="disabled" value="{!! !empty($company['social']['facebook'])? $company['social']['facebook']: old('facebook') !!}">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="fa-light fa-globe"></i></span>
                                                    <input type="text" class="form-control" disabled="disabled" value="{!! !empty($company['social']['website'])? $company['social']['website']: old('website') !!}">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="fa-brands fa-instagram"></i></span>
                                                    <input type="text" class="form-control" disabled="disabled" value="{!! !empty($company['social']['instagram'])? $company['social']['instagram']: old('instagram') !!}">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="fa-brands fa-phone"></i></span>
                                                    <input type="text" class="form-control" disabled="disabled" value="{!! !empty($company['social']['actual_phone'])? $company['social']['actual_phone']: old('actual_phone') !!}">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="fa-brands fa-linkedin"></i></span>
                                                    <input type="text" class="form-control" disabled="disabled" value="{!! !empty($company['social']['linkedin'])? $company['social']['linkedin']: old('linkedin') !!}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="nav-catalog" role="tabpanel" aria-labelledby="nav-catalog-tab" tabindex="0">

                                    <table class="table table-dashed table-hover digi-dataTable all-product-table table-striped" id="allProductTable">
                                        <thead>
                                        <tr>
                                            <th>Xitmət / Məhsul</th>
                                            <th>Qiymət</th>
                                            <th>Ətraflı</th>
                                            <th>Status</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @if(!empty($company['companyService'][0]))
                                                @foreach($company['companyService'] as $companyService)
                                                    <tr>
                                                        <td>
                                                            <div class="table-product-card">
                                                                <div class="part-img">
                                                                    <img src="{{ asset('uploads/company-services/'.$companyService['image']) }}" alt="Image">
                                                                </div>
                                                                <div class="part-txt">
                                                                    <span class="product-name">{{$companyService['title']}}</span>
                                                                    <span class="product-category">Kateqoriya: {{$companyService['category']['title']['az']}}/{{$companyService['subCategory']['title']['az']}}</span>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>{{$companyService['price']}} AZN</td>
                                                        <td>{{$companyService['description']}}</td>
                                                        <td><button class="btn btn-sm btn-primary" id="status{{$companyService['id']}}">@if($companyService['status']) Aktiv @else Deaktiv @endif</button></td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                    <div class="table-bottom-control"></div>
                                </div>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">@lang('admin.save')</button>
                            </div>
                        </div>
                    </div>
{{--                </form>--}}
            </div>
        </div>
    </div>
@endsection
@section('admin.js')
    <script src="{{ asset('admin/assets/vendor/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('admin/assets/vendor/js/jquery.overlayScrollbars.min.js') }}"></script>
    <script src="{{ asset('admin/assets/vendor/js/select2.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/select2-init.js') }}"></script>
    <script src="{{ asset('admin/assets/vendor/js/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('admin/assets/vendor/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/main.js') }}"></script>
    @if(!empty($company['companyService'][0]))
        @foreach($company['companyService'] as $companyService)
            <script>
                document.getElementById("status{{$companyService['id']}}") && document.getElementById("status{{$companyService['id']}}").addEventListener("click", function() {
                    Swal.fire({
                        title: "Statusu dəyişmək istəyirsiniz?",
                        text: "Zəhmət olmasa seçiminizi təsdiqləyin.",
                        icon: "question",
                        showCancelButton: true,
                        confirmButtonText: "Yadda saxla",
                        cancelButtonText: "Bağla",
                        buttonsStyling: false,
                        customClass: {
                            confirmButton: "btn btn-sm btn-primary",
                            cancelButton: "btn btn-sm btn-secondary",
                            closeButton: "btn btn-sm btn-icon btn-danger",
                        },
                        showCloseButton: true,
                        closeButtonHtml: "<i class='fa-light fa-xmark'></i>",
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Burada yadda saxla əməliyyatı yerinə yetir
                            console.log("Status yadda saxlanıldı.");
                        } else if (result.dismiss === Swal.DismissReason.cancel) {
                            console.log("Əməliyyat ləğv edildi.");
                        }
                    });
                });
            </script>
        @endforeach
    @endif
{{--    <script src="{{ asset('admin/assets/js/sweet-alert-init.js') }}"></script>--}}
@endsection

