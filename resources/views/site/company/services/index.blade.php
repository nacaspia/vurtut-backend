@extends('site.company.layouts.app')
@section('company.css')

@endsection
@section('company.content')
    <section class="modal fade search_dropdown" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="popup_modal_wrapper">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-lg-12">
                                    <a class="close closer" data-dismiss="modal" aria-label="Close" href="#"><span><img src="images/icons/close.svg" alt=""></span></a>
                                </div>
                            </div>
                        </div>
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-12 mb30">
                                    <h3>Filter by Category</h3>
                                </div>
                                <div class="col-sm-6 col-md-4 col-xl-2">
                                    <div class="icon-box text-center">
                                        <div class="icon"><span class="flaticon-cutlery"></span></div>
                                        <div class="content-details">
                                            <div class="title">Restaurant</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-4 col-xl-2">
                                    <div class="icon-box text-center">
                                        <div class="icon"><span class="flaticon-shopping-bag"></span></div>
                                        <div class="content-details">
                                            <div class="title">Shopping</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-4 col-xl-2">
                                    <div class="icon-box text-center">
                                        <div class="icon"><span class="flaticon-tent"></span></div>
                                        <div class="content-details">
                                            <div class="title">Outdoor Activities</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-4 col-xl-2">
                                    <div class="icon-box text-center">
                                        <div class="icon"><span class="flaticon-desk-bell"></span></div>
                                        <div class="content-details">
                                            <div class="title">Hotels</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-4 col-xl-2">
                                    <div class="icon-box text-center">
                                        <div class="icon"><span class="flaticon-mirror"></span></div>
                                        <div class="content-details">
                                            <div class="title">Beautu & Spa</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-4 col-xl-2">
                                    <div class="icon-box text-center">
                                        <div class="icon"><span class="flaticon-brake"></span></div>
                                        <div class="content-details">
                                            <div class="title">Automotive</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 mb15 mt20">
                                    <h3>Explore Hot Location</h3>
                                </div>
                                <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3">
                                    <div class="property_city_home6 tac-xsd">
                                        <div class="thumb"><img class="w100" src="images/property/pc18.jpg" alt="pc18.jpg"></div>
                                        <div class="details">
                                            <h4>Miami</h4>
                                            <p>62 Listings</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3">
                                    <div class="property_city_home6 tac-xsd">
                                        <div class="thumb"><img class="w100" src="images/property/pc19.jpg" alt="pc19.jpg"></div>
                                        <div class="details">
                                            <h4>Roma</h4>
                                            <p>92 Listings</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3">
                                    <div class="property_city_home6 tac-xsd">
                                        <div class="thumb"><img class="w100" src="images/property/pc20.jpg" alt="pc20.jpg"></div>
                                        <div class="details">
                                            <h4>New Delhi</h4>
                                            <p>12 Listings</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3">
                                    <div class="property_city_home6 tac-xsd">
                                        <div class="thumb"><img class="w100" src="images/property/pc21.jpg" alt="pc21.jpg"></div>
                                        <div class="details">
                                            <h4>London</h4>
                                            <p>74 Listings</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3">
                                    <div class="property_city_home6 tac-xsd">
                                        <div class="thumb"><img class="w100" src="images/property/pc22.jpg" alt="pc22.jpg"></div>
                                        <div class="details">
                                            <h4>Amsterdam</h4>
                                            <p>62 Listings</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3">
                                    <div class="property_city_home6 tac-xsd">
                                        <div class="thumb"><img class="w100" src="images/property/pc23.jpg" alt="pc23.jpg"></div>
                                        <div class="details">
                                            <h4>Berlin</h4>
                                            <p>92 Listings</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3">
                                    <div class="property_city_home6 tac-xsd">
                                        <div class="thumb"><img class="w100" src="images/property/pc24.jpg" alt="pc24.jpg"></div>
                                        <div class="details">
                                            <h4>Paris</h4>
                                            <p>12 Listings</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3">
                                    <div class="property_city_home6 tac-xsd">
                                        <div class="thumb"><img class="w100" src="images/property/pc25.jpg" alt="pc25.jpg"></div>
                                        <div class="details">
                                            <h4>New Zealand</h4>
                                            <p>74 Listings</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Hazirdi -->
    <section class="our-shop pb80">
        <div class="container">
            <div class="row justify-content-center">
                @include('site.company.layouts.mobile-menu')
                <div class="col-lg-6">
                    <div class="breadcrumb_content style2 mb20">
                        <h2 class="breadcrumb_title">Xidmətlər</h2>
                    </div>
                </div>
            </div>
            <div class="row align-items-center mb-3">
{{--                <form action="" method="GET">--}}
                <div class="col-lg-3">
                    <div class="my_profile_setting_input ui_kit_select_search form-group">
                        <label>Əsas Kateqoriya</label>
                        <select class="form-control"  id="filter_category_id" name="filter_category_id" data-width="100%">
                            <option value="">Əsas Kateqoriya seç</option>
                            @if(!empty($mainCompaniesCategory[0]))
                                @foreach($mainCompaniesCategory as $mainCategory)
                                    <option value="{{$mainCategory['id']}}">{{ $mainCategory['title'][$currentLang] }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="my_profile_setting_input ui_kit_select_search form-group">
                        <label>Alt Kateqoriya</label>
                        <select class="form-control" id="filter_sub_category_id" name="filter_sub_category_id" data-width="100%">
                            <option value="">Alt Kateqoriya seç</option>
                        </select>
                    </div>
                </div>
{{--                <div class="col-lg-2">--}}
{{--                    <button type="submit" class="btn btn-success">--}}
{{--                         Filtr et--}}
{{--                    </button>--}}
{{--                </div>--}}
{{--                </form>--}}
                <div class="col-lg-6 d-flex justify-content-end">
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#productAddModal" style="border-radius:12px;">
                        <span class="flaticon-shopping-bag pr-2 fz20"></span> Əlavə et
                    </button>
                </div>
            </div>
        </div>
        <div class="row mx-auto" id="services-wrapper" style="max-width: 1170px;">
            @include('site.company.services.ajax')

        </div>
        <div class="row">
            <div class="col-lg-12" id="pagination-wrapper">
                @include('site.company.services.pagination')
            </div>
        </div>
        <div class="modal fade sign_up_modal bd-example-modal-lg" id="productAddModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document" style="max-width: 450px; width: 100%;">
                <div class="modal-content">
                    <div class="modal-body">
                        <form id="productForm" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="category_id">Əsas kateqoriyalar</label>
                                <select class="form-control" id="category_id" name="category_id">
                                    <option value="">Əsas kateqoriyalar seçin</option>
                                    @if(!empty($mainCompaniesCategory[0]))
                                        @foreach($mainCompaniesCategory as $mainCategory)
                                            <option value="{{$mainCategory['id']}}">{{ $mainCategory['title'][$currentLang] }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                <div class="invalid-feedback" id="categoryError"></div>
                            </div>
                            <div class="form-group">
                                <label for="sub_category_id">Alt kateqoriya</label>
                                <select class="form-control" id="sub_category_id" name="sub_category_id">
                                    <option value="">Alt Kateqoriya seçin</option>
                                </select>
                                <div class="invalid-feedback" id="subCategoryError"></div>
                            </div>

                            <div class="form-group">
                                <label for="product_name">Adı</label>
                                <input type="text" class="form-control" id="product_name" name="product_name">
                                    <div class="invalid-feedback" id="productNameError"></div>
                            </div>

                            <div class="form-group">
                                <label for="price">Qiymət (AZN)</label>
                                <input type="number" class="form-control" id="price" name="price" min="0" step="0.01">
                                <div class="invalid-feedback" id="priceError"></div>
                            </div>

                            <div class="form-group">
                                <label for="image">Şəkil yüklə</label>
                                <input type="file" class="form-control" id="image" name="image" accept="image/*">
                                <div class="invalid-feedback" id="imageError"></div>
                            </div>

                            <div class="form-group">
                                <label for="description">Təsvir</label>
                                <textarea class="form-control" id="description" name="description" rows="3" placeholder="Məhsul haqqında məlumat..."></textarea>
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
                        <p><strong>Kateqoriya:</strong> <span id="infoCategory"></span></p>
                        <p><strong>Adı:</strong> <span id="infoName"></span></p>
                        <p><strong>Qiymət:</strong> <span id="infoPrice"></span></p>
                        <p><strong>Təsvir:</strong> <span id="infoDescription"></span></p>
                        <img id="infoImage" src="" alt="Məhsul şəkli" class="img-fluid rounded mt-2" style="max-height: 150px;!important;">
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
        $(document).ready(function () {
            $('#category_id').on('change', function () {
                const categoryId = $(this).val();

                if (categoryId) {
                    $.ajax({
                        url: '{{ route('site.company.subCategories') }}',
                        type: 'GET',
                        dataType: 'json',
                        data: { category_id: categoryId },
                        success: function (response) {
                            if (response.success) {
                                let subCatOptions = '<option value="">-Kateqoriya seçin</option>';

                                response.subCompaniesCategory.forEach(subCategory => {
                                    if (subCategory.sub_category_id == categoryId) {
                                        subCatOptions += `<option value="${subCategory.id}">${subCategory.title["{{ $currentLang }}"]}</option>`;
                                    }
                                });
                                $('#sub_category_id').html(subCatOptions);
                            } else {
                                $('#sub_category_id').html('<option value="">-Kateqoriya tapılmadı</option>');
                            }
                        },
                        error: function () {
                            alert("Xəta baş verdi.");
                        }
                    });
                } else {
                    $('#sub_category_id').html('<option value="">-Kateqoriya seçin</option>');
                }
            });
        });
        $(document).ready(function () {
            $('#filter_category_id').on('change', function () {
                const categoryId = $(this).val();

                if (categoryId) {
                    $.ajax({
                        url: '{{ route('site.company.subCategories') }}',
                        type: 'GET',
                        dataType: 'json',
                        data: { category_id: categoryId },
                        success: function (response) {
                            if (response.success) {
                                let subCatOptions = '<option value="">-Kateqoriya seçin</option>';

                                response.subCompaniesCategory.forEach(subCategory => {
                                    if (subCategory.sub_category_id == categoryId) {
                                        subCatOptions += `<option value="${subCategory.id}">${subCategory.title["{{ $currentLang }}"]}</option>`;
                                    }
                                });
                                $('#filter_sub_category_id').html(subCatOptions);
                            } else {
                                $('#filter_sub_category_id').html('<option value="">-Kateqoriya tapılmadı</option>');
                            }
                        },
                        error: function () {
                            alert("Xəta baş verdi.");
                        }
                    });
                } else {
                    $('#filter_sub_category_id').html('<option value="">-Kateqoriya seçin</option>');
                }
            });
        });


        function fetchFilteredServices(url = '{{ route("site.company-services.index") }}') {
            const categoryId = $('#filter_category_id').val();
            const subCategoryId = $('#filter_sub_category_id').val();

            // Filter parametrləri
            const params = $.param({
                filter_category_id: categoryId,
                filter_sub_category_id: subCategoryId
            });

            // URL-ə uyğun olaraq separator seç (? varsa & əlavə et)
            const separator = url.includes('?') ? '&' : '?';
            const fullUrl = url + separator + params;

            $.ajax({
                url: fullUrl,
                type: 'GET',
                success: function (response) {
                    $('#services-wrapper').html(response.html);
                    $('#pagination-wrapper').html(response.pagination);
                },
                error: function () {
                    alert('Məlumatlar gətirilərkən xəta baş verdi.');
                }
            });
        }

        // Filter dəyişəndə işləsin
        $('#filter_category_id, #filter_sub_category_id').on('change', function () {
            fetchFilteredServices(); // default route ilə sorğu
        });

        // Pagination kliklənəndə işləsin
        $(document).on('click', '.page-link', function (e) {
            e.preventDefault();

            const url = $(this).attr('href');
            if (url === '#' || $(this).parent().hasClass('disabled')) return;

            fetchFilteredServices(url); // kliklənmiş səhifənin linki ilə sorğu
        });


        document.addEventListener('DOMContentLoaded', function () {
            const detailButtons = document.querySelectorAll('.viewProductDetail');

            detailButtons.forEach(function (btn) {
                btn.addEventListener('click', function () {
                    document.getElementById('infoCategory').innerText = btn.getAttribute('data-category');
                    document.getElementById('infoName').innerText = btn.getAttribute('data-name');
                    document.getElementById('infoPrice').innerText = btn.getAttribute('data-price');
                    document.getElementById('infoDescription').innerText = btn.getAttribute('data-description');
                    document.getElementById('infoImage').src = btn.getAttribute('data-image');
                });
            });
        });


        $('#productForm').on('submit', function (e) {
            e.preventDefault();
            $('.form-control').removeClass('is-invalid');
            $('#categoryError, #subCategoryError, #productNameError, #priceError, #imageError, #descriptionError, #generalError, #generalSuccess').text('');
            let formData = new FormData();
            $('#serviceButton').prop('disabled', false).html('Gözləyin...');
            formData.append('category_id', $('#category_id').val());
            formData.append('sub_category_id', $('#sub_category_id').val());
            formData.append('product_name', $('#product_name').val());
            formData.append('price', $('#price').val());
            formData.append('image', $('#image')[0].files[0]);
            formData.append('description', $('#description').val());
            $.ajax({
                url: '{{ route('site.company-services.store') }}',
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
                            if (res.errors.category_id) {
                                $('#category_id').addClass('is-invalid');
                                $('#categoryError').removeClass('d-none').addClass('d-block').text(res.errors.category_id[0]);
                            }
                            if (res.errors.sub_category_id) {
                                $('#sub_category_id').addClass('is-invalid');
                                $('#subCategoryError').removeClass('d-none').addClass('d-block').text(res.errors.sub_category_id[0]);
                            }
                            if (res.errors.product_name) {
                                $('#product_name').addClass('is-invalid');
                                $('#productNameError').removeClass('d-none').addClass('d-block').text(res.errors.product_name[0]);
                            }
                            if (res.errors.price) {
                                $('#price').addClass('is-invalid');
                                $('#priceError').removeClass('d-none').addClass('d-block').text(res.errors.price[0]);
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
