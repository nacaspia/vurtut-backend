@extends('site.company.layouts.app')
@section('company.css')
    <link type="text/css" rel="stylesheet" href="{{ asset('site/css/dashboard-style.css') }}">
    <style>
        input[type="checkbox"]:disabled + label {
            color: gray; /* Yazı rəngi boz */
            cursor: not-allowed; /* Mausun dəyişməsi */
        }
        .fl-wrap .filter-tags li {
            margin-bottom: 10px;
        }

        .fl-wrap .filter-tags li input[type="time"] {
            padding: 8px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
            width: 100%;
            background-color: #fff;
            box-sizing: border-box;
        }

        .fl-wrap .filter-tags li input[type="checkbox"] {
            margin-right: 10px;
        }

        .fl-wrap .filter-tags li label {
            font-size: 16px;
            color: #333;
            display: inline-block;
            vertical-align: middle;
        }

        .fl-wrap .filter-tags li input[type="time"]:focus,
        .fl-wrap .filter-tags li input[type="checkbox"]:focus {
            border-color: #007bff;
            outline: none;
        }

        .fl-wrap .filter-tags li input[type="time"]:focus + label,
        .fl-wrap .filter-tags li input[type="checkbox"]:focus + label {
            color: #007bff;
        }

    </style>
    <style>
        input[type="time"] {
            padding: 10px;
            font-size: 16px;
            border: 2px solid #ddd;
            border-radius: 8px;
            outline: none;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
            width: 200px;
        }

        input[type="time"]:focus {
            border-color: #4CAF50;
            box-shadow: 0 0 8px rgba(76, 175, 80, 0.5);
        }
        label[for="start_time"],
        label[for="end_time"] {
            font-size: 16px;
            color: #333;
            display: inline-block;
            vertical-align: middle;
        }
        .ds-tg li {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            border: 1px solid #ddd;
            padding: 10px;
            border-radius: 5px;
            width: 100%;
        }

        .ds-tg li div {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .ds-tg label {
            font-weight: bold;
        }

        .time-container {
            display: flex;
            gap: 10px;
        }

        /* Mobil üçün uyğunlaşdırma */
        @media (max-width: 768px) {
            .ds-tg li {
                flex-direction: column;
                align-items: flex-start;
            }

            .time-container {
                flex-direction: column;
                width: 100%;
            }

            .time-container div {
                width: 100%;
            }
        }

    </style>

@endsection
@section('company.content')
    <div class="col-md-9" style="top: 52px!important;">
        <div class="dashboard-title dt-inbox fl-wrap">
            @include('components.site.error')
            <h3>@lang('site.additions')</h3>
        </div>
        <div class="row">
            <div class="fl-wrap tabs-act block_box dashboard-tabs">
                <!-- profile-edit-container-->
                <div class="profile-edit-container fl-wrap block_box">
                    <div class="custom-form">
                        <form action="{{ route('site.company.settings-update',$company->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="form_type" value="additions">
                            <?php $data = json_decode($company->data,1);?>
                            <div class="dashboard-title  dt-inbox fl-wrap">
                                <h3>@lang('site.facilities')</h3>
                            </div>
                            <!-- profile-edit-container-->
                            <div class="profile-edit-container fl-wrap block_box">
                                <div class="custom-form">
                                    <!-- Checkboxes -->
                                    <ul class="fl-wrap filter-tags no-list-style ds-tg">
                                        <li>
                                            <label for="free_wifi">@lang('site.free_wifi')</label>
                                            <input id="free_wifi" type="checkbox" name="free_wifi" value="1" {{ !empty($data['free_wifi'])? 'checked': '' }}>
                                        </li>
                                        <li>
                                            <label for="parking">@lang('site.parking')</label>
                                            <input id="parking" type="checkbox" name="parking" value="1" {{ !empty($data['parking'])? 'checked': '' }}>
                                        </li>
                                        <li>
                                            <label for="non_smoking_rooms">@lang('site.non_smoking_rooms')</label>
                                            <input id="non_smoking_rooms" type="checkbox" name="non_smoking_rooms" value="1" {{ !empty($data['non_smoking_rooms'])? 'checked': '' }}>
                                        </li>
                                        <li>
                                            <label for="pets_friendly">@lang('site.pets_friendly')</label>
                                            <input id="pets_friendly" type="checkbox" name="pets_friendly" value="1" {{ !empty($data['pets_friendly'])? 'checked': '' }}>
                                        </li>
                                    </ul>
                                    <!-- Checkboxes end -->
                                </div>
                            </div>
                            <!-- profile-edit-container end-->

                            <div class="dashboard-title  dt-inbox fl-wrap">
                                <h3>@lang('site.work_date')</h3>
                            </div>

                            <!-- profile-edit-container-->
                            <div class="profile-edit-container fl-wrap block_box">
                                <div class="custom-form">
                                    <!-- Checkboxes -->
                                    <ul class="fl-wrap filter-tags no-list-style ds-tg">
                                        <li>
                                            <label for="is_24_7">@lang('site.is_24_7')</label>
                                            <input id="is_24_7" type="checkbox" name="is_24_7" value="1" {{ !empty($data['is_24_7'])? 'checked': '' }}>
                                        </li>
                                        <?php $selectedDays = $data['working_days'] ?? []; ?>
                                    </ul>
                                    <ul class="fl-wrap no-list-style ds-tg">
                                        @foreach(['monday' => 'Bazar ertəsi', 'tuesday' => 'Çərşənbə axşamı', 'wednesday' => 'Çərşənbə', 'thursday' => 'Cümə axşamı', 'friday' => 'Cümə', 'saturday' => 'Şənbə', 'sunday' => 'Bazar'] as $day => $dayLabel)
                                            <li>
                                                <div>
                                                    <label for="{{ $day }}">{{ $dayLabel }}</label>
                                                    <input id="{{ $day }}" type="checkbox" name="working_days[]" value="{{ $day }}" {{ in_array($day, $selectedDays) ? 'checked' : '' }}>
                                                </div>
                                                <div class="time-container">
                                                    <div>
                                                        <label for="start_time_{{ $day }}">@lang('site.start_time')</label>
                                                        <input id="start_time_{{ $day }}" type="text" class="timepicker" name="working_hours[{{ $day }}][start]" value="{{ !empty($workingHours[$day]['start']) ? date('H:i', strtotime($workingHours[$day]['start'])) : '' }}" step="1">
                                                    </div>
                                                    <div>
                                                        <label for="end_time_{{ $day }}">@lang('site.end_time')</label>
                                                        <input id="end_time_{{ $day }}" type="text" class="timepicker" name="working_hours[{{ $day }}][end]" value="{{ !empty($workingHours[$day]['end']) ? date('H:i', strtotime($workingHours[$day]['end'])) : '' }}" step="1">
                                                    </div>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>

                                </div>
                            </div>
                            <label> @lang('site.note')</label>
                            <textarea cols="40" rows="3" placeholder="..." name="text" style="margin-bottom:20px;">{{ $company->text }}</textarea>
                            <div class="clearfix"></div>
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
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const is24_7Checkbox = document.getElementById('is_24_7');
            const workingDaysCheckboxes = document.querySelectorAll('input[name="working_days[]"]');
            const timeInputs = document.querySelectorAll('input[type="time"]');

            function toggleWorkingDays(disabled) {
                workingDaysCheckboxes.forEach(checkbox => {
                    checkbox.checked = false;
                    checkbox.disabled = disabled;
                    checkbox.closest('li').style.display = disabled ? 'none' : 'flex';
                });
                timeInputs.forEach(input => {
                    input.value = '';
                    input.disabled = disabled;
                    input.closest('div').style.display = disabled ? 'none' : 'block';
                });
            }

            is24_7Checkbox.addEventListener('change', function () {
                if (this.checked) {
                    toggleWorkingDays(true);
                } else {
                    toggleWorkingDays(false);
                }
            });

            workingDaysCheckboxes.forEach(checkbox => {
                checkbox.addEventListener('change', function () {
                    const anyChecked = [...workingDaysCheckboxes].some(cb => cb.checked);

                    if (anyChecked) {
                        is24_7Checkbox.checked = false;
                        is24_7Checkbox.style.display = 'none';
                    } else {
                        is24_7Checkbox.style.display = 'block';
                    }
                });
            });
        });
    </script>

    {{--<script>
        // Ensure 24-hour format
        const startTime = document.getElementById('start_time');
        const endTime = document.getElementById('end_time');

        // Set default times in 24-hour format if needed
        startTime.value = startTime.value || "00:00"; // Default value
        endTime.value = endTime.value || "23:59";    // Default value

        // Prevent browser from showing 12-hour format
        startTime.addEventListener('change', (e) => {
            startTime.value = e.target.value; // Keep in 24-hour format
        });

        endTime.addEventListener('change', (e) => {
            endTime.value = e.target.value; // Keep in 24-hour format
        });
    </script>--}}
    <!-- Flatpickr CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <!-- Flatpickr JS -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll(".timepicker").forEach(function(el) {
                flatpickr(el, {
                    enableTime: true,
                    noCalendar: true,
                    dateFormat: "H:i",
                    time_24hr: true
                });
            });
        });
    </script>
   {{-- @foreach(['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'] as $day)
    <script>
        flatpickr("#start_time_{{$day}}", {
            enableTime: true,
            noCalendar: true,
            dateFormat: "H:i",
            time_24hr: true
        });
        flatpickr("#end_time_{{$day}}", {
            enableTime: true,
            noCalendar: true,
            dateFormat: "H:i",
            time_24hr: true
        });
    </script>
    @endforeach--}}
@endsection
