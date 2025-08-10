@extends('site.user.layouts.app')
@section('user.css')
    <link rel="stylesheet" href="{{ asset("site/css/bootstrap.min.css") }}">
    <style>
        #imageLabel {
            transition: transform 0.3s ease;
            background-size: contain;
            background-position: center;
            background-repeat: no-repeat;
            width: 120px;
            height: 120px;
            border-radius: 50%;
            display: block;
        }
    </style>
@endsection
@section('user.content')
    <!-- Our Dashbord -->
    <section class="our-dashbord dashbord bgc-f4">
        <div class="container">
            <div class="row">
                @include('site.company.layouts.mobile-menu')
                <div class="col-lg-12 mb10">
                    <div class="breadcrumb_content style2">
                        <h2 class="breadcrumb_title float-left">Parametrlər</h2>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-xl-8">
                            <div class="my_dashboard_profile mb30-lg">
                                <h4 class="mb30">Hesab məlumatları</h4>
                                <form id="settingsFrom" enctype="multipart/form-data">
                                    @csrf

                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="wrap-custom-file mb50">
                                                <input type="file"  class="form-control"  name="image_settings" id="image_settings" accept=".gif, .jpg, .png, .svg, .jpge" hidden />
                                                <label for="image_settings" class="custom-file-label" id="imageLabel" @if(!empty($user['image'])) style="background-image: url('{{ asset('uploads/user/'.$user['image']) }}');" @endif>
                                                    <span>Profil şəkili yüklə</span>
                                                    <small class="file_title">Maksimum 15 MB</small>
                                                </label>
                                                <div id="previewContainer" style="margin-top: 10px; display: none;">
                                                    <img id="imagePreview" src="@if(empty($user['image']))#@else {{ asset('uploads/user/'.$user['image']) }}@endif" alt="Şəkil" style="max-width: 200px; display: block; margin-bottom: 10px;" />
                                                    <button type="button" id="removeImage" class="btn btn-danger btn-sm">Sil</button>
                                                </div>
                                            </div>
                                            <div class="invalid-feedback" id="imageSettingsError"></div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="my_profile_setting_input form-group mt100-500">
                                                <label for="country_id_settings">Ölkə</label>
                                                <select class="form-control" id="country_id_settings" name="country_id_settings" >
                                                    <option value="" @if($user['country_id']== '') selected @endif>-Ölkə seçin</option>
                                                    @if(!empty($countries[0]))
                                                        @foreach($countries as $country)
                                                            <option value="{{$country['id']}}" @if($user['country_id']== $country->id) selected @endif>{{$country['name'][$currentLang]}}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                            <div class="invalid-feedback" id="countrySettingsError"></div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="my_profile_setting_input form-group mt100-500">
                                                <label for="city_id_settings">Şəhər/Rayon</label>
                                                <select class="form-control" id="city_id_settings" name="city_id_settings" >
                                                    <option value="" @if($user['city_id']== '') selected @endif>-Şəhər/Rayon seçin</option>
                                                    @if(!empty($user['city_id']) && !empty($user['city']['id'])&& !empty($user['subRegion']['id']))
                                                        <option value="{{ $user['subRegion']['id'] }}" selected>{{ $user['city']['name'][$currentLang] }}/{{ $user['subRegion']['name'][$currentLang] }}</option>
                                                    @elseif(!empty($user['city_id']) && !empty($user['city']['id'])&& empty($user['subRegion']['id']))
                                                        <option value="{{ $user['city']['id'] }}" selected>{{ $user['city']['name'][$currentLang] }}</option>
                                                    @endif
                                                </select>
                                            </div>
                                            <div class="invalid-feedback" id="citySettingsError"></div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="my_profile_setting_input form-group mt100-500">
                                                <label for="full_name_settings">Ad, Soyad</label>
                                                <input type="text" class="form-control" id="full_name_settings" name="full_name_settings" value="{{$user['full_name']}}">
                                            </div>
                                            <div class="invalid-feedback" id="fullNameSettingsError"></div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="my_profile_setting_input form-group">
                                                <label for="phone_settings">Telefon nömrəsi</label>
                                                <input type="text" class="form-control" id="phone_settings" name="phone_settings" value="{{$user['phone']}}">
                                            </div>
                                            <div class="invalid-feedback" id="phoneSettingsError"></div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="my_profile_setting_input form-group">
                                                <label for="email_settings">E-mail</label>
                                                <input type="email" class="form-control" id="email_settings" name="email_settings" value="{{$user['email']}}">
                                            </div>
                                            <div class="invalid-feedback" id="emailSettingsError"></div>
                                        </div>
                                        <div class="col-xl-12">
                                            <div class="my_profile_setting_textarea">
                                                <label for="bio_settings">Bioqrafiya</label>
                                                <textarea class="form-control" id="bio_settings" name="bio_settings" rows="6">{!! $user['bio'] ?? '' !!}</textarea>
                                            </div>
                                            <div class="invalid-feedback" id="bioSettingsError"></div>
                                        </div>

                                        <div class="col-xl-12">
                                            <div class="my_profile_setting_input">
                                                <button type="submit" class="btn update_btn">Yadda saxla</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-xl-4">
                            <div class="my_dashboard_profile">
                                <h4 class="mb20">Şifrəni dəyiş</h4>
                                <form id="settingsPassword">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="my_profile_setting_input form-group">
                                                <label for="old_password">Mövcud Şifrə</label>
                                                <input type="password" class="form-control" id="old_password" name="old_password">
                                            </div>
                                            <div class="invalid-feedback" id="oldPasswordError"></div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="my_profile_setting_input form-group">
                                                <label for="new_password">Yeni Şifrə</label>
                                                <input type="password" class="form-control" id="new_password" name="new_password">
                                            </div>
                                            <div class="invalid-feedback" id="newPasswordError"></div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="my_profile_setting_input form-group">
                                                <label for="conf_new_password">Yeni Şifrəni təsdiqlə</label>
                                                <input type="password" class="form-control" id="conf_new_password" name="conf_new_password">
                                            </div>
                                            <div class="invalid-feedback" id="confNewPasswordError"></div>
                                        </div>
                                        <div class="col-xl-12">
                                            <div class="my_profile_setting_input">
                                                <button type="submit" class="btn update_btn style2">Şifrəni dəyiş</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="settings_modal modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md mt100" role="document">
            <div class="modal-content">
                <div class="modal-header" style="text-align: center;display: flex!important;">
                    <h4> -Qeydiyyat tamamlanması</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body container pb20 pl0 pr0 pt0">

                    <div class="tab-content container" id="myTabContent">
                        <div class="row mt40 tab-pane fade show active pl20 pr20" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <div class="col-lg-12">
                                <div class="login_form">
                                    <div class="text-danger text-center mt-2" id="generalSettingsError" style="font-weight: bold;!important;"></div>
                                    <div class="text-success text-center mt-2" id="generalSettingsSuccess" style="font-weight: bold;!important;"></div>
                                    <div class="text-success text-center mt-2" id="generalSettingsPasswordError" style="font-weight: bold;!important;"></div>
                                    <div class="text-danger text-center mt-2" id="generalSettingsPasswordSuccess" style="font-weight: bold;!important;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('user.js')
    <script>
        $(document).ready(function () {
            $('#country_id_settings').on('change', function () {
                const countryId = $(this).val();

                if (countryId) {
                    $.ajax({
                        url: '{{ route('site.user.cities') }}',
                        type: 'GET',
                        dataType: 'json',
                        data: { country_id: countryId },
                        success: function (response) {
                            if (response.success) {
                                let cityOptions = '<option value="">-Şəhər seçin</option>';

                                response.cities.forEach(city => {
                                    if (city.country_id == countryId) {
                                        if (city.sub_regions && city.sub_regions.length > 0) {
                                            city.sub_regions.forEach(subRegion => {
                                                cityOptions += `<option value="${subRegion.id}">${city.name["{{ $currentLang }}"]} / ${subRegion.name["{{ $currentLang }}"]}</option>`;
                                            });
                                        } else {
                                            cityOptions += `<option value="${city.id}">${city.name["{{ $currentLang }}"]}</option>`;
                                        }
                                    }
                                });
                                $('#city_id_settings').html(cityOptions);
                            } else {
                                $('#city_id_settings').html('<option value="">-Şəhər tapılmadı</option>');
                            }
                        },
                        error: function () {
                            alert("Xəta baş verdi.");
                        }
                    });
                } else {
                    $('#city_id_settings').html('<option value="">-Şəhər seçin</option>');
                }
            });
        });
        document.getElementById('image_settings').addEventListener('change', function (event) {
            const file = event.target.files[0];
            const preview = document.getElementById('imagePreview');
            const container = document.getElementById('previewContainer');
            const label = document.getElementById('imageLabel');

            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    preview.src = e.target.result;
                    container.style.display = 'block';
                    label.style.display = 'none';
                };
                reader.readAsDataURL(file);
            }
        });
        document.getElementById('removeImage').addEventListener('click', function () {
            const input = document.getElementById('image_settings');
            const preview = document.getElementById('imagePreview');
            const container = document.getElementById('previewContainer');
            const label = document.getElementById('imageLabel');
            input.value = '';
            preview.src = '#';
            container.style.display = 'none';
            label.style.display = 'block';
        });

        $('#settingsFrom').on('submit', function (e) {
            e.preventDefault();
            $('.form-control').removeClass('is-invalid');
            $('#imageSettingsError, #countrySettingsError, #citySettingsError, #fullNameSettingsError, #phoneSettingsError, #emailSettingsError, #bioSettingsError, #generalSettingsError, #generalSettingsSuccess').text('');
            let formData = new FormData();
            formData.append('_token', $('meta[name="csrf-token"]').attr('content'));
            formData.append('_method', 'PUT'); // Laravel PUT istəklər üçün
            formData.append('image', $('#image_settings')[0].files[0]);
            formData.append('country_id', $('#country_id_settings').val());
            formData.append('city_id', $('#city_id_settings').val());
            formData.append('full_name', $('#full_name_settings').val());
            formData.append('phone', $('#phone_settings').val());
            formData.append('email', $('#email_settings').val());
            formData.append('bio', $('#bio_settings').val());
            $.ajax({
                url: '{{ route('site.user.settings-update',$user->id) }}',
                method: 'POST', // PUT üçün method POST olacaq, çünki FormData PUT-u dəstəkləmir
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    if (response.success) {
                        $('#generalSettingsSuccess').text(response.message);
                        $('.settings_modal').modal('show'); // modalı göstər
                    }
                },
                error: function (xhr) {
                    if (xhr.status === 422) {
                        const res = xhr.responseJSON;
                        if (res.errors) {
                            if (res.errors.image) {
                                $('#image_settings').addClass('is-invalid');
                                $('#imageSettingsError').removeClass('d-none').addClass('d-block').text(res.errors.image[0]);
                            }

                            if (res.errors.country_id) {
                                $('#country_id_settings').addClass('is-invalid');
                                $('#countrySettingsError').removeClass('d-none').addClass('d-block').text(res.errors.country_id[0]);
                            }

                            if (res.errors.city_id) {
                                $('#city_id_settings').addClass('is-invalid');
                                $('#citySettingsError').text(res.errors.city_id[0]);
                            }

                            if (res.errors.full_name) {
                                $('#full_name_settings').addClass('is-invalid');
                                $('#fullNameSettingsError').removeClass('d-none').addClass('d-block').text(res.errors.full_name[0]);
                            }

                            if (res.errors.email) {
                                $('#email_settings').addClass('is-invalid');
                                $('#emailSettingsError').removeClass('d-none').addClass('d-block').text(res.errors.email[0]);
                            }

                            if (res.errors.phone) {
                                $('#phone_settings').addClass('is-invalid');
                                $('#phoneSettingsError').removeClass('d-none').addClass('d-block').text(res.errors.phone[0]);
                            }

                            if (res.errors.bio) {
                                $('#bio_settings').addClass('is-invalid');
                                $('#bioSettingsError').removeClass('d-none').addClass('d-block').text(res.errors.bio[0]);
                            }

                        } else if (res.message) {
                            $('#generalSettingsError').removeClass('d-none').addClass('d-block').text(res.message);
                        }
                    } else {
                        $('#generalSettingsError').removeClass('d-none').addClass('d-block').text('Naməlum xəta baş verdi.');
                    }
                }
            });
        });
        $('#settingsPassword').on('submit', function (e) {
            e.preventDefault();
            $('.form-control').removeClass('is-invalid');
            $('#oldPasswordError, #newPasswordError, #confNewPasswordError, #generalSettingsPasswordError, #generalSettingsPasswordSuccess').text('');
            let formData = new FormData();
            formData.append('_token', $('meta[name="csrf-token"]').attr('content'));
            formData.append('_method', 'PUT'); // Laravel PUT istəklər üçün
            formData.append('old_password', $('#old_password').val());
            formData.append('new_password', $('#new_password').val());
            formData.append('conf_new_password', $('#conf_new_password').val());
            $.ajax({
                url: '{{ route('site.user.settings-password-update',$user->id) }}',
                method: 'POST', // PUT üçün method POST olacaq, çünki FormData PUT-u dəstəkləmir
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    if (response.success) {
                        $('#generalSettingsError').text(response.message);
                        $('.settings_modal').modal('show'); // modalı göstər
                    }
                },
                error: function (xhr) {
                    if (xhr.status === 422) {
                        const res = xhr.responseJSON;
                        if (res.errors) {
                            if (res.errors.old_password) {
                                $('#old_password').addClass('is-invalid');
                                // $('.invalid-feedback').hide();
                                $('#oldPasswordError').removeClass('d-none').addClass('d-block').text(res.errors.old_password[0]);
                            }

                            if (res.errors.new_password) {
                                $('#new_password').addClass('is-invalid');
                                $('#newPasswordError').removeClass('d-none').addClass('d-block').text(res.errors.new_password[0]);
                            }

                            if (res.errors.conf_new_password) {
                                $('#conf_new_password').addClass('is-invalid');
                                $('#confNewPasswordError').removeClass('d-none').addClass('d-block').text(res.errors.conf_new_password[0]);
                            }

                        } else if (res.message) {
                            $('#generalSettingsPasswordError').text(res.message);
                        }
                    } else {
                        $('#generalSettingsPasswordError').text('Naməlum xəta baş verdi.');
                    }
                }
            });
        });
    </script>
@endsection
