@extends('site.user.layouts.app')
@section('user.css')
@endsection
@section('user.content')
    <!-- Our Dashbord -->
    <section class="our-dashbord dashbord bgc-f4">
        <div class="container">
            <div class="row">
                @include('site.user.layouts.mobile-menu')
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
                                        <li class="list-inline-item"><p><a href="{{ route('site.companyDetails',['slug' => $log['objCompany']['slug']]) }}" target="_blank"><span>{{ $log['objCompany']['full_name'] }}</span></a> adlı istifadəçi rəyinizə baxdı.</p></li>
                                    </ul>
                                </div>
                            @elseif($log['subj_table'] == 'reservations')
                                <div class="grid style3">
                                    <ul>
                                        <li class="list-inline-item"><div class="icon"><span class="flaticon-note"></span></div></li>
                                        <li class="list-inline-item"><p><a href="{{ route('site.user.reservation') }}" target="_blank"><span>{{ $log['objCompany']['full_name'] }}</span></a> adlı istifadəçi rezervasiyanıza baxdı.</p></li>
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
@section('user.js')
    <script>
        $(document).ready(function() {
            // Fetch cities based on selected country
            $('#country_id').on('change', function() {
                let countryId = $(this).val();

                if (countryId) {
                    $.ajax({
                        url: '{{ route("site.mainCities") }}',
                        type: 'GET',
                        data: { country_id: countryId },
                        success: function(response) {
                            let mainCitySelect = $('#city_id');
                            mainCitySelect.empty(); // Clear previous options
                            mainCitySelect.append('<option value="">@lang("site.all_cities")</option>');

                            // Populate cities
                            response.mainCities.forEach(function(mainCity) {
                                mainCitySelect.append(`<option value="${mainCity.id}">${mainCity.name.az}</option>`);
                            });

                            // Reinitialize nice-select
                            mainCitySelect.niceSelect('destroy');
                            mainCitySelect.niceSelect();
                        },
                        error: function(xhr) {
                            console.error("An error occurred: " + xhr.responseText);
                        }
                    });
                }
            });

            // Fetch sub-regions based on selected city
            $('#city_id').on('change', function() {
                let cityId = $(this).val();

                if (cityId) {
                    $.ajax({
                        url: '{{ route("site.parentCities") }}',
                        type: 'GET',
                        data: { city_id: cityId },
                        success: function(response) {
                            let parentCitiesSelect = $('#sub_region_id');
                            parentCitiesSelect.empty(); // Clear previous options
                            parentCitiesSelect.append('<option value="">@lang("site.all_parent_cities")</option>');

                            // Populate sub-regions
                            response.parentCities.forEach(function(parentCity) {
                                parentCitiesSelect.append(`<option value="${parentCity.id}">${parentCity.name.az}</option>`);
                            });

                            // Reinitialize nice-select
                            parentCitiesSelect.niceSelect('destroy');
                            parentCitiesSelect.niceSelect();
                        },
                        error: function(xhr) {
                            console.error("An error occurred: " + xhr.responseText);
                        }
                    });
                }
            });
        });
    </script>
@endsection
