@extends('site.layouts.app')
@section('site.title')
    @lang('site.home')
@endsection
@section('site.css')
    <style>
        .flaticon-love.active {
            color: red;
        }
    </style>
    <link rel="stylesheet" href="{{ asset("site/css/bootstrap.min.css") }}">
    <link rel="stylesheet" href="{{ asset("site/css/style.css") }}">
    <link rel="stylesheet" href="{{ asset("site/css/responsive.css") }}">
    {{--<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>--}}
@endsection
@section('site.content')
    <!-- Listing Grid View -->
    <section class="our-listing pb30-991">
        <div class="container">

            @include('site.filter.mobile.trends-company')
            <div class="row">
                @include('site.filter.trends-company')
                <div class="col-xl-8">
                    {{--<div class="row">
                        <div class="listing_filter_row dif db-767">
                            <div class="col-sm-12 col-md-4 col-lg-4 col-xl-5">
                                <div class="left_area tac-xsd mb30-767">
                                    <p class="mb0">Showing <span class="heading-color">1-8 of 10 results</span></p>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-8 col-lg-8 col-xl-7">
                                <div class="listing_list_style tac-767">
                                    <ul class="mb0">
                                        <li class="list-inline-item dropdown text-left"><span class="stts">Short by: </span>
                                            <select class="selectpicker">
                                                <option>Default</option>
                                                <option>Newest</option>
                                                <option>Featured</option>
                                                <option>Most Views</option>
                                            </select>
                                        </li>
                                        <li class="list-inline-item gird"><a href="#"><span class="fa fa-th-large"></span></a></li>
                                        <li class="list-inline-item list"><a class="text-thm" href="#"><span class="fa fa-th-list"></span></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>--}}
                    <div class="row" id="companiesList">
                        @include('site.ajax.trends-company')
                    </div>
                   {{-- <div class="col-lg-12">
                        <div class="mbp_pagination mt10">
                            {!! $allCompaniesByTrends->links('site.pagination.category') !!}
                        </div>
                    </div>--}}
                </div>
            </div>
        </div>
    </section>
@endsection
@section('site.js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).on('change', '#city_id', function () {
            let cityId = $(this).val();
            $.ajax({
                url: '{{ route('site.parentCities') }}',
                type: 'GET',
                data: { city_id: cityId },
                success: function (response) {
                    let $subRegion = $('#sub_region_id');
                    $subRegion.empty();
                    $subRegion.append('<option value="">Daha yaxın ərazi</option>');
                    $.each(response.parentCities, function (key, region) {
                        $subRegion.append('<option value="' + region.id + '">' + region.name.{{$currentLang}} + '</option>');
                    });

                    $subRegion.selectpicker('refresh'); // Bootstrap-select üçün vacib
                }
            });
        });
        $(document).on('change', '#mobile_city_id', function () {
            let cityId = $(this).val();
            $.ajax({
                url: '{{ route('site.parentCities') }}',
                type: 'GET',
                data: { city_id: cityId },
                success: function (response) {
                    let $subRegion = $('#mobile_sub_region_id');
                    $subRegion.empty();
                    $subRegion.append('<option value="">Daha yaxın ərazi</option>');
                    $.each(response.parentCities, function (key, region) {
                        $subRegion.append('<option value="' + region.id + '">' + region.name.{{$currentLang}} + '</option>');
                    });

                    $subRegion.selectpicker('refresh'); // Bootstrap-select üçün vacib
                }
            });
        });
        document.addEventListener('DOMContentLoaded', function () {
            const allCheckbox = document.getElementById('service_type_all');
            const otherCheckboxes = document.querySelectorAll('.service_type_item');

            allCheckbox.addEventListener('change', function () {
                if (this.checked) {
                    // "Bütün xidmətlər" seçildikdə digər checkboxları deaktiv et və gizlət
                    otherCheckboxes.forEach(cb => {
                        cb.checked = false;
                        cb.disabled = true;
                        cb.closest('li').style.display = 'none';
                    });
                } else {
                    // Seçilməyibsə digər checkboxları aktiv et və göstər
                    otherCheckboxes.forEach(cb => {
                        cb.disabled = false;
                        cb.closest('li').style.display = 'list-item';
                    });
                }
            });

            // Əgər digər checkboxlardan biri seçilərsə, "Bütün xidmətlər" yoxlanmasını götür
            otherCheckboxes.forEach(cb => {
                cb.addEventListener('change', function () {
                    if (this.checked) {
                        allCheckbox.checked = false;
                        allCheckbox.dispatchEvent(new Event('change')); // trigger yenilənmə
                    }
                });
            });
        });
        document.addEventListener('DOMContentLoaded', function () {
            const allCheckbox = document.getElementById('service_type_all_mobile');
            const otherCheckboxes = document.querySelectorAll('.service_type_item');

            allCheckbox.addEventListener('change', function () {
                if (this.checked) {
                    // "Bütün xidmətlər" seçildikdə digər checkboxları deaktiv et və gizlət
                    otherCheckboxes.forEach(cb => {
                        cb.checked = false;
                        cb.disabled = true;
                        cb.closest('li').style.display = 'none';
                    });
                } else {
                    // Seçilməyibsə digər checkboxları aktiv et və göstər
                    otherCheckboxes.forEach(cb => {
                        cb.disabled = false;
                        cb.closest('li').style.display = 'list-item';
                    });
                }
            });

            // Əgər digər checkboxlardan biri seçilərsə, "Bütün xidmətlər" yoxlanmasını götür
            otherCheckboxes.forEach(cb => {
                cb.addEventListener('change', function () {
                    if (this.checked) {
                        allCheckbox.checked = false;
                        allCheckbox.dispatchEvent(new Event('change')); // trigger yenilənmə
                    }
                });
            });
        });
        $(document).ready(function() {
            function filterCompanies(formSelector, pageUrl = null, resetPage = false) {
                let data = $(formSelector).serializeArray();
                if (resetPage) {
                    // page parametrini sil / sıfırla
                    data = data.filter(item => item.name !== 'page');
                } else if (pageUrl) {
                    // Əgər pageUrl varsa (pagination klikindən), url-dən page parametrini çək və əlavə et
                    let urlParams = new URLSearchParams(pageUrl.split('?')[1]);
                    let page = urlParams.get('page');
                    if (page) {
                        // page parametrini data arrayinə əlavə et
                        data = data.filter(item => item.name !== 'page'); // əvvəlcə varsa sil
                        data.push({name: 'page', value: page});
                    }
                }

                $.ajax({
                    url: window.location.pathname, // əsas URL, query parametri data ilə göndəririk
                    method: "GET",
                    data: $.param(data),
                    beforeSend: function() {
                        $('#companiesList').html('<div>Yüklənir...</div>');
                        $('.mbp_pagination').html('');
                    },
                    success: function(response) {
                        $('#companiesList').html(response.html);
                        $('.mbp_pagination').html(response.pagination);
                    },
                    error: function() {
                        $('#companiesList').html('<div>Xəta baş verdi</div>');
                        $('.mbp_pagination').html('');
                    }
                });
            }

            function initFilter() {
                if ($(window).width() < 768) {
                    const form = '#mobileFilterForm';

                    $(form + ' input, ' + form + ' select').off().on('change input', function() {
                        filterCompanies(form, null, true); // resetPage = true
                    });

                    $(document).off('click.mobilePagination').on('click.mobilePagination', '.page_navigation a', function(e) {
                        e.preventDefault();
                        let url = $(this).attr('href');
                        filterCompanies(form, url);
                    });

                    $(form + ' .search_option_button a').off().on('click', function(e) {
                        e.preventDefault();
                        $(form)[0].reset();
                        filterCompanies(form, null, true); // resetPage = true
                    });

                } else {
                    const form = '#filterForm';

                    $(form + ' input, ' + form + ' select').off().on('change input', function() {
                        filterCompanies(form, null, true); // resetPage = true
                    });

                    $(document).off('click.desktopPagination').on('click.desktopPagination', '.page_navigation a', function(e) {
                        e.preventDefault();
                        let url = $(this).attr('href');
                        filterCompanies(form, url);
                    });

                    $(form + ' .search_option_button a').off().on('click', function(e) {
                        e.preventDefault();
                        $(form)[0].reset();
                        filterCompanies(form, null, true); // resetPage = true
                    });
                }
            }

            initFilter();
            $(window).resize(function() {
                initFilter();
            });
        });
    </script>
    <!-- Wrapper End -->
    <script src="{{ asset("site/js/jquery-3.6.0.js") }}"></script>
    <script src="{{ asset("site/js/jquery-migrate-3.0.0.min.js") }}"></script>
    <script src="{{ asset("site/js/popper.min.js") }}"></script>
    <script src="{{ asset("site/js/bootstrap.min.js") }}"></script>
    <script src="{{ asset("site/js/jquery.mmenu.all.js") }}"></script>
    <script src="{{ asset("site/js/ace-responsive-menu.js") }}"></script>
    <script src="{{ asset("site/js/bootstrap-select.min.js") }}"></script>
    <script src="{{ asset("site/js/snackbar.min.js") }}"></script>
    <script src="{{ asset("site/js/simplebar.js") }}"></script>
    <script src="{{ asset("site/js/parallax.js") }}"></script>
    <script src="{{ asset("site/js/scrollto.js") }}"></script>
    <script src="{{ asset("site/js/jquery-scrolltofixed-min.js") }}"></script>
    <script src="{{ asset("site/js/jquery.counterup.js") }}"></script>
    <script src="{{ asset("site/js/wow.min.js") }}"></script>
    <script src="{{ asset("site/js/progressbar.js") }}"></script>
    <script src="{{ asset("site/js/slider.js") }}"></script>
    <script src="{{ asset("site/js/timepicker.js") }}"></script>
    <!-- Custom script for all pages -->
    <script src="{{ asset('site/js/script.js') }}"></script>
    @if(!empty(auth('user')->user()->id))
        <script>
            $(document).on('click', '.like-btn', function (e) {
                e.preventDefault();

                const $btn = $(this);
                const itemId = $btn.data('item-id');
                const itemType = $btn.data('item-type');
                const isLiked = $btn.data('liked');

                const url = !isLiked ? '{{ route('site.user.like') }}' : '{{ route('site.user.unlike') }}';

                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {
                        item_id: itemId,
                        item_type: itemType,
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (response) {
                        if (response.success) {
                            // toggle class
                            $btn.find('span').toggleClass('active');
                            // update data-liked value
                            $btn.data('liked', !isLiked);
                        }
                    },
                    error: function (xhr) {
                        alert('Əməliyyatda xəta baş verdi.');
                    }
                });
            });

        </script>
    @endif
@endsection
