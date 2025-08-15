@extends('site.company.layouts.app')
@section('company.css')
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
    <!-- Bootstrap & jQuery (əgər daxil edilməyibsə) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

@endsection
@section('company.content')
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
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="wrap-custom-file mb50">
                                                <input type="file"  class="form-control"  name="image_settings" id="image_settings" accept=".gif, .jpg, .png, .svg, .jpge"  hidden />
                                                <label for="image_settings" class="custom-file-label" id="imageLabel" @if(!empty($company['image'])) style="background-image: url('{{ asset('uploads/company/'.$company['image']) }}');!important;" @endif>
                                                    <span>Profil şəkili yüklə</span>
                                                    <small class="file_title">Maksimum 15 MB</small>
                                                </label>
                                                <div id="previewContainer" style="margin-top: 10px; display: none;">
                                                    <img id="imagePreview" src="@if(empty($company['image']))#@else {{ asset('uploads/company/'.$company['image']) }}@endif" alt="Şəkil" style="max-width: 145px;display: block; margin-bottom: 10px; border-radius: 117px;!important;" />
                                                    <button type="button" id="removeImage" class="btn btn-danger btn-sm">Sil</button>
                                                </div>
                                                <div class="invalid-feedback" id="imageSettingsError"></div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="my_profile_setting_input form-group mt100-500">
                                                <label for="full_name">Müəssisə adı</label>
                                                <input type="text" class="form-control" id="full_name" name="full_name"  value="{{ $company['full_name'] }}" >
                                                <div class="invalid-feedback" id="fullNameSettingsError"></div>
                                            </div>
                                        </div>
                                        <div class="col-xl-12">
                                            <div class="my_profile_setting_textarea">
                                                <label for="bio">Bioqrafiya</label>
                                                <textarea class="form-control" id="bio" name="bio" rows="6" >{{ !empty($company['text'])? $company['text']: null }}</textarea>
                                                <div class="invalid-feedback" id="bioSettingsError"></div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="my_profile_setting_input ui_kit_select_search form-group">
                                                <label for="parent_id">Tabeçilik</label>
                                                <select class="form-control" id="parent_id" name="parent_id">
                                                    <option value="">Seçin</option>
                                                    <option value="01" @if($company['type'] === 'main') selected @endif>Əsas müəssisə</option>
                                                    @if(!empty($mainCompanies[0]))
                                                        @foreach($mainCompanies as $mainCompany)
                                                            <option value="{{ $mainCompany['id'] }}" @if($company['parent_id'] === $mainCompany['id']) selected @endif>{{ $mainCompany['full_name'] }}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                                <div class="invalid-feedback" id="parentSettingsError"></div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="my_profile_setting_input ui_kit_select_search form-group">
                                                <label for="category_id">Kateqoriya</label>
                                                <select class="form-control"  id="category_id" name="category_id" @if(!empty($company['category_id'])) disabled="disabled" @endif>
                                                    <option value="" >Müəssisə kateqoriyanızı seçin</option>
                                                    @if(!empty($categories[0]))
                                                        @foreach($categories as $category)
                                                            <option value="{{ $category['id'] }}" @if($company['category_id'] === $category['id']) selected @endif>{{ $category['title'][$currentLang] }}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                                <div class="invalid-feedback" id="categorySettingsError"></div>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="my_profile_setting_input form-group">
                                                <label for="country_id_settings">Ölkə</label>
                                                <select class="form-control" id="country_id_settings" name="country_id_settings" >
                                                    <option value="" @if($company['country_id']== '') selected @endif>Ölkə seçin</option>
                                                    @if(!empty($countries[0]))
                                                        @foreach($countries as $country)
                                                            <option value="{{$country['id']}}" @if($company['country_id']== $country->id) selected @endif>{{$country['name'][$currentLang]}}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                                <div class="invalid-feedback" id="countrySettingsError"></div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="my_profile_setting_input form-group">
                                                <label for="city_id_settings">Şəhər/Rayon</label>
                                                <select class="form-control" id="city_id_settings" name="city_id_settings" >
                                                    <option value="" @if($company['city_id']== '') selected @endif>Şəhər/Rayon seçin</option>
                                                    @if(!empty($company['city_id']) && !empty($company['city']['id'])&& !empty($company['subRegion']['id']))
                                                        <option value="{{ $company['subRegion']['id'] }}" selected>{{ $company['city']['name'][$currentLang] }}/{{ $company['subRegion']['name'][$currentLang] }}</option>
                                                    @elseif(!empty($company['city_id']) && !empty($company['city']['id'])&& empty($company['subRegion']['id']))
                                                        <option value="{{ $company['city']['id'] }}" selected>{{ $company['city']['name'][$currentLang] }}</option>
                                                    @endif
                                                </select>
                                                <div class="invalid-feedback" id="citySettingsError"></div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="my_profile_setting_input form-group">
                                                <label for="one_phone">Telefon nömrəsi</label>
                                                <input type="text" class="form-control" id="one_phone" name="one_phone" value="{{ !empty($company['social']['one_phone'])? $company['social']['one_phone']: null }}">
                                                <div class="invalid-feedback" id="onePhoneSettingsError"></div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="my_profile_setting_input form-group">
                                                <label for="two_phone">Telefon nömrəsi</label>
                                                <input type="text" class="form-control" id="two_phone" name="two_phone" value="{{ !empty($company['social']['two_phone'])? $company['social']['two_phone']: null }}">
                                                <div class="invalid-feedback" id="twoPhoneSettingsError"></div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="my_profile_setting_input form-group">
                                                <label for="one_email">E-mail</label>
                                                <input type="email" class="form-control" id="one_email" name="one_email" value="{{ !empty($company['social']['one_email'])? $company['social']['one_email']: null }}">
                                                <div class="invalid-feedback" id="oneEmailSettingsError"></div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-xl-6">
                                            <div class="my_profile_setting_input form-group">
                                                <label for="facebook">Facebook</label>
                                                <input type="text" class="form-control" id="facebook" name="facebook" value="{{ !empty($company['social']['facebook'])? $company['social']['facebook']: null }}">
                                                <div class="invalid-feedback" id="facebookSettingsError"></div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-xl-6">
                                            <div class="my_profile_setting_input form-group">
                                                <label for="instagram">Instagram</label>
                                                <input type="text" class="form-control" id="instagram" name="instagram" value="{{ !empty($company['social']['instagram'])? $company['social']['instagram']: null }}">
                                                <div class="invalid-feedback" id="instagramSettingsError"></div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-xl-6">
                                            <div class="my_profile_setting_input form-group">
                                                <label for="tiktok">Tiktok</label>
                                                <input type="text" class="form-control" id="tiktok" name="tiktok" value="{{ !empty($company['social']['tiktok'])? $company['social']['tiktok']: null }}">
                                                <div class="invalid-feedback" id="tiktokSettingsError"></div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-xl-6">
                                            <div class="my_profile_setting_input form-group">
                                                <label for="linkedin">Linkedin</label>
                                                <input type="text" class="form-control" id="linkedin" name="linkedin" value="{{ !empty($company['social']['linkedin'])? $company['social']['linkedin']: null }}">
                                                <div class="invalid-feedback" id="linkedinSettingsError"></div>
                                            </div>
                                        </div>

                                        <div class="col-lg-15">
                                            <h4 class="float-left fn-414 mb30">İş vaxtı</h4>
                                            <div class="opening_hour_day_list float-right">
                                                <ul class="mb0 nav nav-tabs" id="dayTabs" role="tablist">
                                                    @foreach(['Mon','Tue','Wed','Thu','Fri','Sat','Sun'] as $key => $day)
                                                        <li class="list-inline-item" style="margin-right: 0.0rem;!important;">
                                                            <a class="nav-link @if($key == 0) active @endif" id="tab-{{ $day }}" data-toggle="tab" href="#content-{{ $day }}" role="tab">
                                                                @lang('site.'.$day)
                                                            </a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                            <div class="tab-content" id="dayTabContent">
                                                @foreach(['Mon','Tue','Wed','Thu','Fri','Sat','Sun'] as $key => $day)
                                                    <div class="tab-pane fade @if($key == 0) show active @endif" id="content-{{ $day }}" role="tabpanel">
                                                        <div class="my_profile_setting_input form-group">
                                                            <label>İş vaxtı (@lang('site.'.$day))</label>

                                                            <div class="form-inline" style="gap: 10px;">
                                                                <div class="form-inline" style="gap: 10px;">
                                                                    @php
                                                                        $type = $company['time'][$day]['hours_type'] ?? 0;
                                                                        $start = $company['time'][$day]['start'] ?? '00:00';
                                                                        $end = $company['time'][$day]['end'] ?? '23:59';
                                                                    @endphp

                                                                    <select class="form-control hours_type" name="hours_type[{{ $day }}]">
                                                                        <option value="">Seçin</option>
                                                                        <option value="1" @if($type == 1) selected @endif>Açıq</option>
                                                                        <option value="0" @if($type == 0) selected @endif>Bağlı</option>
                                                                    </select>

                                                                    <input type="time" class="form-control start_date" name="hours[{{ $day }}][start]" value="{{ $start }}">
                                                                    <span> </span>
                                                                    <input type="time" class="form-control end_date" name="hours[{{ $day }}][end]" value="{{ $end }}">
                                                                </div>

                                                                {{--<select class="form-control hours_type" id="hours_type{{ $day }}" name="hours_type[{{ $day }}]">
                                                                    <option value="">Seçin</option>
                                                                    <option value="1" @if(isset($company['time'][$day]) && $company['time'][$day] == 0) selected @endif>Açıq</option>
                                                                    <option value="0" @if(isset($company['time'][$day]) && $company['time'][$day] == 0) selected @endif>Bağlı</option>
                                                                </select>
                                                                <input  type="time" class="form-control start_date" id="start_time{{ $day }}"
                                                                       name="hours[{{ $day }}][start]" value="00:00">
                                                                <span>-</span>
                                                                <input  type="time"  class="form-control end_date" id="end_time{{ $day }}"
                                                                       name="hours[{{ $day }}][end]" value="23:59">--}}
                                                            </div>
                                                        </div>
                                                        <div class="invalid-feedback" id="hoursSettingsError"></div>
                                                    </div>

                                                @endforeach
                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                            <h4 class="mb30">Xüsusiyyətlər</h4>
                                            <div class="my_profile_setting_input ui_kit_select_search form-group list_hightlights df">
                                                <ul class="add_listing selectable-list" style="margin-top: -12px;!important;">
                                                    <div class="invalid-feedback" id="servicesSettingsError"></div>
                                                    @foreach($serviceTypes->slice(0, ceil($serviceTypes->count() / 2)) as $service)
                                                        <li>
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" @if(isset($company['service_type']) && in_array($service->id, $company['service_type'])) checked @endif class="custom-control-input" id="services{{ $service->id }}" name="services[]" value="{{ $service->id }}">
                                                                <label class="custom-control-label" for="services{{ $service->id }}">
                                                                    {{ $service['name'][$currentLang] }}
                                                                </label>
                                                            </div>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                                <ul class="add_listing selectable-list"  style="margin-top: -12px;!important;">
                                                    <div class="invalid-feedback" id="servicesSettingsError"></div>
                                                    @foreach($serviceTypes->slice(ceil($serviceTypes->count() / 2)) as $service)
                                                        <li>
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" @if(isset($company['service_type']) && in_array($service->id, $company['service_type'])) checked @endif class="custom-control-input" id="services{{ $service->id }}" name="services[]" value="{{ $service->id }}">
                                                                <label class="custom-control-label" for="services{{ $service->id }}">
                                                                    {{ $service['name'][$currentLang] }}
                                                                </label>
                                                            </div>
                                                         </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col-xl-12">
                                            <div class="my_profile_setting_input">
                                                <button type="submit" id="settingsCountry" class="btn update_btn">Yadda saxla</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="col-xl-4">
                            <div class="my_dashboard_profile">
                                <h4 class="mb20">Qeydiyyat məlumatları</h4>
                                <form id="registerSettings">
                                    <input type="hidden" id="latitude" name="latitude">
                                    <input type="hidden" id="longitude" name="longitude">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="my_profile_setting_input ui_kit_select_search form-group">
                                                <label for="emailRegister">E-mail</label>
                                                <input type="email" class="form-control" id="emailRegister" name="emailRegister" value="{{ $company['email'] }}">
                                                <div class="invalid-feedback" id="emailRegisterSettingsError"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="my_profile_setting_input form-group">
                                                <label for="phoneRegister">Nömrə</label>
                                                <input type="text" class="form-control" id="phoneRegister" name="phoneRegister" value="{{ $company['phone'] }}">
                                                <div class="invalid-feedback" id="phoneRegisterSettingsError"></div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="my_profile_setting_input form-group">
                                                <label for="addressRegister">Ünvanı qeyd et*</label>
                                                <input type="text" class="form-control" id="addressRegister" name="addressRegister" value="{{ $company['data']['address'] ?? '' }}">
                                                <div class="invalid-feedback" id="addressRegisterSettingsError"></div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="my_profile_setting_input form-group">
                                                <label for="addressRegister">Ünvanı seç</label>
                                                <div class="sidebar_map mb30">
                                                    <div class="lss_map h200" id="map-canvas"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-12">
                                            <div class="my_profile_setting_input">
                                                <button type="submit" id="settingsButton" class="btn update_btn style2">Məlumatları yenilə</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div class="my_dashboard_profile">
                                <h4 class="mb20">Şifrəni dəyiş</h4>
                                <form id="settingsPassword">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="my_profile_setting_input form-group">
                                                <label for="old_password">Mövcud Şifrə</label>
                                                <input type="password" class="form-control" id="old_password" name="old_password">
                                                <div class="invalid-feedback" id="oldPasswordError"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="my_profile_setting_input form-group">
                                                <label for="new_password">Yeni Şifrə</label>
                                                <input type="password" class="form-control" id="new_password" name="new_password">
                                                <div class="invalid-feedback" id="newPasswordError"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="my_profile_setting_input form-group">
                                                <label for="conf_new_password">Yeni Şifrəni təsdiqlə</label>
                                                <input type="password" class="form-control" id="conf_new_password" name="conf_new_password">
                                                <div class="invalid-feedback" id="confNewPasswordError"></div>
                                            </div>
                                         </div>
                                        <div class="col-xl-12">
                                            <div class="my_profile_setting_input">
                                                <button type="submit" id="settingsPassButton" class="btn update_btn style2">Şifrəni dəyiş</button>
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
                                    <div class="text-success text-center mt-2" id="generalRegisterSettingsError" style="font-weight: bold;!important;"></div>
                                    <div class="text-danger text-center mt-2" id="generalRegisterSettingsSuccess" style="font-weight: bold;!important;"></div>
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
@section('company.js')
    <script src="{{ asset('site/js/googlemaps1.js') }}"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD8M9rUVW_Og-Z8sTfQSA5HUgRbd4WyW0w&callback=initMap&libraries=places" async defer></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <input type="text" id="date" class="form-control start_date" placeholder="Tarix">
    <input type="text" id="date" class="form-control end_date" placeholder="Tarix">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        flatpickr(".start_date", {
            enableTime: true,
            noCalendar: true,
            dateFormat: "H:i",
            time_24hr: true
        });

        flatpickr(".end_date", {
            enableTime: true,
            noCalendar: true,
            dateFormat: "H:i",
            time_24hr: true
        });
    </script>
    <script>
        document.querySelectorAll('.hours_type').forEach(select => {
            const container = select.closest('.form-inline');
            const inputs = container.querySelectorAll('.start_date, .end_date');

            function toggleInputs() {
                if (select.value === "1") {
                    inputs.forEach(i => i.style.display = "inline-block");
                } else {
                    inputs.forEach(i => i.style.display = "none");
                }
            }

            // səhifə yüklənəndə vəziyyəti yoxla
            toggleInputs();

            // seçim dəyişdikdə
            select.addEventListener('change', toggleInputs);
        });
    </script>
    <script>

        let map;
        let marker;
        let geocoder;

        function initMap() {
            var lat = {{  $company['data']['lat'] ?? 40.4093 }};
            var lng = {{  $company['data']['lng'] ?? 49.8671 }};
            const defaultLocation = { lat: lat, lng: lng }; // Bakı üçün
            map = new google.maps.Map(document.getElementById("map-canvas"), {
                zoom: 13,
                center: defaultLocation,
            });

            geocoder = new google.maps.Geocoder();

            marker = new google.maps.Marker({
                position: defaultLocation,
                map: map,
                draggable: true,
            });

            getAddressFromLatLng(defaultLocation); // İlkdə yazılsın

            marker.addListener("dragend", function () {
                getAddressFromLatLng(marker.getPosition());
            });

            map.addListener("click", function (e) {
                marker.setPosition(e.latLng);
                getAddressFromLatLng(e.latLng);
            });
        }

        function getAddressFromLatLng(latlng) {
            geocoder.geocode({ location: latlng }, function (results, status) {
                if (status === "OK") {
                    if (results[0]) {
                        document.getElementById("addressRegister").value = results[0].formatted_address;

                        // Dəyişiklik burada:
                        const lat = typeof latlng.lat === 'function' ? latlng.lat() : latlng.lat;
                        const lng = typeof latlng.lng === 'function' ? latlng.lng() : latlng.lng;

                        document.getElementById("latitude").value = lat;
                        document.getElementById("longitude").value = lng;
                    }
                } else {
                    alert("Ünvan tapılmadı: " + status);
                }
            });
        }

        window.initMap = initMap;
    </script>
    @include('site.company.js')
@endsection
