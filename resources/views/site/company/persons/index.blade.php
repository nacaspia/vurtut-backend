@extends('site.company.layouts.app')
@section('company.css')
@endsection
@section('company.content')
    <!-- Hazirdi -->
    <section class="our-shop pb80">
        <div class="container">
            <div class="row justify-content-center">
                @include('site.company.layouts.mobile-menu')
                <div class="col-lg-6">
                    <div class="breadcrumb_content style2 mb20">
                        <h2 class="breadcrumb_title">Ustalar</h2>
                    </div>
                </div>
            </div>
            <div class="row align-items-center mb-3">
{{--                <form action="" method="GET">--}}
                <div class="col-lg-3">
{{--                    <div class="my_profile_setting_input ui_kit_select_search form-group">--}}
{{--                        <label>Status</label>--}}
{{--                        <select class="form-control" id="filter_status" name="filter_status" data-width="100%">--}}
{{--                            <option value="">Status seç</option>--}}
{{--                            <option value="1">Aktiv edilib</option>--}}
{{--                            <option value="0">Aktiv edilməyib</option>--}}
{{--                        </select>--}}
{{--                    </div>--}}
                </div>
                <div class="col-lg-3">
                </div>

                <div class="col-lg-6 d-flex justify-content-end">
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#productAddModal" style="border-radius:12px;">
                        + Əlavə et
                    </button>
                </div>
            </div>
        </div>
        <div class="row mx-auto" id="persons-wrapper" style="max-width: 1170px;">
            @include('site.company.persons.ajax')

        </div>
        <div class="row">
            <div class="col-lg-12" id="pagination-wrapper">
                @include('site.company.persons.pagination')
            </div>
        </div>
        <div class="modal fade sign_up_modal bd-example-modal-lg" id="productAddModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document" style="max-width: 450px; width: 100%;">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Bağla">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="productForm" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="name">Ustanın Adı</label>
                                <input type="text" class="form-control" id="name" name="name">
                                    <div class="invalid-feedback" id="nameError"></div>
                            </div>
                            <div class="form-group">
                                <label for="image">Ustanın şəkili</label>
                                <input type="file" class="form-control" id="image" name="image" accept="image/*">
                                <div class="invalid-feedback" id="imageError"></div>
                            </div>
                            <div class="form-group">
                                <label for="age">Ustanın yaşı</label>
                                <input type="text" class="form-control" id="age" name="age">
                                <div class="invalid-feedback" id="ageError"></div>
                            </div>
                            <div class="form-group">
                                <label for="experience">Ustanın təcrübəsi</label>
                                <input type="text" class="form-control" id="experience" name="experience">
                                <div class="invalid-feedback" id="experienceError"></div>
                            </div>
                            <div class="form-group">
                                <label for="description">Ətraflı məlumat</label>
                                <textarea class="form-control" id="description" name="description" rows="3" placeholder="Ətraflı haqqında məlumat..."></textarea>
                                <div class="invalid-feedback" id="descriptionError"></div>
                            </div>
                            <button type="submit" id="serviceButton" class="btn btn-success">Yadda saxla</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
        <div class="modal fade" id="productInfoModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document" style="max-width: 500px;">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Məlumat</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Bağla">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="row">
                            <div class="col-lg-4 col-xl-4">
                                <img id="infoImage" src="" alt="Şəkli" class="img-fluid rounded mt-2" style="max-height: 150px;!important;">
                            </div>
                            <div class="col-lg-6 col-xl-6">
                                <p><strong>Ustanın Adı:</strong> <span id="infoName"></span></p>
                                <p><strong>Ustanın Yaşı:</strong> <span id="infoAge"></span></p>
                                <p><strong>Ustanın Təcrübəsi:</strong> <span id="infoExperience"></span></p>
                                <p><strong>Ətraflı məlumat:</strong> <span id="infoDescription"></span></p>
                            </div>
                        </div>
{{--                        <img id="infoImage" src="" alt="Şəkli" class="img-fluid rounded mt-2" style="max-height: 150px;!important;">--}}
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="settings_modal modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md mt100" role="document">
            <div class="modal-content">
                <div class="modal-header" style="text-align: center;display: flex!important;">
                    <h4> Məlumat tamamlanması</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body container pb20 pl0 pr0 pt0">

                    <div class="tab-content container" id="myTabContent">
                        <div class="row mt40 tab-pane fade show active pl20 pr20" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <div class="col-lg-12">
                                <div class="login_form">
                                    <div class="text-danger text-center mt-2" id="generalError" style="font-weight: bold;!important;"></div>
                                    <div class="text-success text-center mt-2" id="generalSuccess" style="font-weight: bold;!important;"></div>
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
    <script>
        function fetchFilteredPersons(url = '{{ route("site.company-persons.index") }}') {
            const status = $('#filter_status').val();

            // Filter parametrləri
            const params = $.param({
                filter_status: status
            });

            // URL-ə uyğun olaraq separator seç (? varsa & əlavə et)
            const separator = url.includes('?') ? '&' : '?';
            const fullUrl = url + separator + params;

            $.ajax({
                url: fullUrl,
                type: 'GET',
                success: function (response) {
                    $('#persons-wrapper').html(response.html);
                    $('#pagination-wrapper').html(response.pagination);
                },
                error: function () {
                    alert('Məlumatlar gətirilərkən xəta baş verdi.');
                }
            });
        }

        // Filter dəyişəndə işləsin
        $('#filter_status').on('change', function () {
            fetchFilteredPersons(); // default route ilə sorğu
        });

        // Pagination kliklənəndə işləsin
        $(document).on('click', '.page-link', function (e) {
            e.preventDefault();

            const url = $(this).attr('href');
            if (url === '#' || $(this).parent().hasClass('disabled')) return;

            fetchFilteredPersons(url); // kliklənmiş səhifənin linki ilə sorğu
        });


        document.addEventListener('DOMContentLoaded', function () {
            const detailButtons = document.querySelectorAll('.viewProductDetail');

            detailButtons.forEach(function (btn) {
                btn.addEventListener('click', function () {
                    document.getElementById('infoName').innerText = btn.getAttribute('data-name');
                    document.getElementById('infoAge').innerText = btn.getAttribute('data-age');
                    document.getElementById('infoExperience').innerText = btn.getAttribute('data-experience');
                    document.getElementById('infoDescription').innerText = btn.getAttribute('data-description');
                    document.getElementById('infoImage').src = btn.getAttribute('data-image');
                });
            });
        });


        $('#productForm').on('submit', function (e) {
            e.preventDefault();
            $('.form-control').removeClass('is-invalid');
            $('#nameError, #imageError, #ageError, #experienceError, #descriptionError, #generalError, #generalSuccess').text('');
            let formData = new FormData();
            $('#serviceButton').prop('disabled', false).html('Gözləyin...');
            formData.append('name', $('#name').val());
            formData.append('image', $('#image')[0].files[0]);
            formData.append('age', $('#age').val());
            formData.append('experience', $('#experience').val());
            formData.append('description', $('#description').val());
            $.ajax({
                url: '{{ route('site.company-persons.store') }}',
                method: 'POST', // PUT üçün method POST olacaq, çünki FormData PUT-u dəstəkləmir
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    if (response.success) {
                        $('#generalSuccess').text(response.message);
                        $('.settings_modal').modal('show'); // modalı göstər
                        // window.location.reload();
                        $('.settings_modal .close').on('click', function () {
                            location.reload();
                        });

                    }
                },
                error: function (xhr) {
                    $('#serviceButton').prop('disabled', false).html('Yadda saxla');
                    if (xhr.status === 422) {
                        const res = xhr.responseJSON;
                        if (res.errors) {
                            if (res.errors.name) {
                                $('#name').addClass('is-invalid');
                                $('#nameError').removeClass('d-none').addClass('d-block').text(res.errors.name[0]);
                            }
                            if (res.errors.age) {
                                $('#age').addClass('is-invalid');
                                $('#ageError').removeClass('d-none').addClass('d-block').text(res.errors.age[0]);
                            }
                            if (res.errors.experience) {
                                $('#experience').addClass('is-invalid');
                                $('#experienceError').removeClass('d-none').addClass('d-block').text(res.errors.experience[0]);
                            }

                            if (res.errors.description) {
                                $('#description').addClass('is-invalid');
                                $('#descriptionError').removeClass('d-none').addClass('d-block').text(res.errors.description[0]);
                            }
                            if (res.errors.image) {
                                $('#image').addClass('is-invalid');
                                $('#imageError').removeClass('d-none').addClass('d-block').text(res.errors.image[0]);
                            }

                        } else if (res.message) {
                            $('#generalError').removeClass('d-none').addClass('d-block').text(res.message);
                            $('.settings_modal').modal('show'); // modalı göstər
                        }
                    } else {
                        $('#generalError').removeClass('d-none').addClass('d-block').text('Naməlum xəta baş verdi.');
                        $('.settings_modal').modal('show'); // modalı göstər
                    }
                }
            });
        });
    </script>
@endsection
