@extends('site.company.layouts.app')
@section('company.css')
    <link type="text/css" rel="stylesheet" href="{{ asset('site/css/modal.css') }}">
@endsection
@section('company.content')
    <div class="col-md-9" style="top: 52px!important;">
        <div class="dashboard-title dt-inbox fl-wrap">
            @include('components.site.error')
            <h3>@lang('site.company_contact')</h3>
        </div>
        <div class="row">
            <div class="fl-wrap tabs-act block_box dashboard-tabs">
                <!-- profile-edit-container-->
                <div class="profile-edit-container fl-wrap block_box">
                    <div class="custom-form">
                        <form action="{{ route('site.company.settings-update',$company->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="form_type" value="social">
                            <div class="row">
                                <?php $data = json_decode($company->data,1);?>
                                <style>
                                    #map-modal {
                                        display: none;
                                        position: fixed;
                                        top: 26%;
                                        left: 61%;
                                        width: 29%;
                                        height: 67%;
                                        background: white;
                                        z-index: 1000;
                                        border: 1px solid #ccc;
                                        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.5);
                                    }

                                    #map-modal button {
                                        background: #007bff;
                                        color: white;
                                        border: none;
                                        cursor: pointer;
                                        text-align: center;
                                    }
                                </style>

                                <div class="col-sm-6">
                                    <label>@lang('site.address') <i class="fas fa-map-marker"></i></label>
                                    <input
                                        type="text"
                                        id="actual_address-input"
                                        name="actual_address"
                                        placeholder="Azerbaijan/Baku"
                                        value="{{ !empty($data['actual_address']) ? $data['actual_address'] : '' }}"
                                        readonly
                                        onclick="openMapModal()"
                                    />
                                </div>

                                <!-- Modal for Map -->
                                <div id="map-modal">
                                    <div id="map" style="width:100%; height:90%;"></div>
                                    <button onclick="closeMapModal()" style="width:100%; height:10%;">Close</button>
                                </div>
                                <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY"></script>
                                <script>
                                    let map, marker, modal;

                                    function initMap() {
                                        modal = document.getElementById('map-modal');
                                        const defaultLocation = { lat: 40.4093, lng: 49.8671 }; // Default Baku

                                        map = new google.maps.Map(document.getElementById("map"), {
                                            center: defaultLocation,
                                            zoom: 12,
                                        });

                                        marker = new google.maps.Marker({
                                            position: defaultLocation,
                                            map,
                                            draggable: true,
                                        });

                                        // Add event listener to fetch address when marker is dragged
                                        google.maps.event.addListener(marker, 'dragend', function (event) {
                                            const lat = event.latLng.lat();
                                            const lng = event.latLng.lng();
                                            fetchAddress(lat, lng);
                                        });
                                    }

                                    function fetchAddress(lat, lng) {
                                        const geocoder = new google.maps.Geocoder();
                                        const latlng = { lat: parseFloat(lat), lng: parseFloat(lng) };

                                        geocoder.geocode({ location: latlng }, (results, status) => {
                                            if (status === "OK" && results[0]) {
                                                document.getElementById('actual_address-input').value = results[0].formatted_address;
                                            }
                                        });
                                    }

                                    function openMapModal() {
                                        modal.style.display = 'block';
                                        google.maps.event.trigger(map, "resize");
                                    }

                                    function closeMapModal() {
                                        modal.style.display = 'none';
                                    }

                                    document.addEventListener('DOMContentLoaded', initMap);
                                </script>
                                <div class="col-sm-6">
                                    <label> @lang('site.phone') <i class="far fa-phone"></i>  </label>
                                    <input type="text" name="actual_phone" placeholder="+994** *** ** **" value="{{ !empty($data['actual_phone'])? $data['actual_phone']: '' }}"/>
                                </div>
                                <div class="col-sm-6">
                                    <label>@lang('site.whatsapp') <i class="fab fa-whatsapp"></i></label>
                                    <input type="text" name="whatsapp" placeholder="https://wa.me/+994*********" value="{{ !empty($data['whatsapp'])? $data['whatsapp']: '' }}"/>
                                </div>
                                <div class="col-sm-6">
                                    <label>@lang('site.telegram') <i class="fab fa-telegram"></i></label>
                                    <input type="text" name="telegram" placeholder="https://t.me/+994*********" value="{{ !empty($data['telegram'])? $data['telegram']: '' }}"/>
                                </div>
                                <div class="col-sm-6">
                                    <label> @lang('site.website') <i class="far fa-globe"></i>  </label>
                                    <input type="text" name="website" placeholder="vurtut.com" value="{{ !empty($data['website'])? $data['website']: '' }}"/>
                                </div>
                                <div class="col-sm-6">
                                    <label>@lang('site.instagram') <i class="fab fa-instagram"></i></label>
                                    <input type="text" name="instagram" placeholder="https://www.instagram.com/" value="{{ !empty($data['instagram'])? $data['instagram']: '' }}"/>
                                </div>
                                <div class="col-sm-6">
                                    <label>@lang('site.linkedin') <i class="fab fa-linkedin"></i></label>
                                    <input type="text" name="linkedin" placeholder="https://www.linkedin.com/" value="{{ !empty($data['linkedin'])? $data['linkedin']: '' }}"/>
                                </div>
                                <div class="col-sm-6">
                                    <label>@lang('site.facebook') <i class="fab fa-facebook"></i></label>
                                    <input type="text" name="facebook" placeholder="https://www.facebook.com/" value="{{ !empty($data['facebook'])? $data['facebook']: '' }}"/>
                                </div>
                            </div>
                            <button type="submit" class="btn    color2-bg  float-btn">@lang('site.save')<i class="fal fa-save"></i></button>
                        </form>
                    </div>
                </div>
                <!-- profile-edit-container end-->
            </div>
        </div>
    </div>
@endsection
@section('company.js')
@endsection
