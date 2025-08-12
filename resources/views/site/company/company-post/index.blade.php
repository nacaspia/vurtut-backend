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
@endsection
@section('company.content')
    <!-- About Text Content -->
    <section class="about-section pb70">
        <div class="container">
            <div class="row">
                @include('site.company.layouts.mobile-menu')
                <div class="col-lg-12 mb15">
                    <div class="breadcrumb_content style2">
                        <h2 class="breadcrumb_title float-left">Qalereya</h2>
                    </div>
                </div>
                @if(count($companyPosts) <6)
                <div class="col-xl-12">
                    <div class="my_dashboard_review mt30">
                        <form id="companyPost" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="wrap-custom-file mb50">
                                        <input type="file"  class="form-control"  name="image" id="image" accept=".gif, .jpg, .png" hidden />
                                        <label for="image" class="custom-file-label" id="imageLabel" style="border-radius: 0%;  height: 150px; width: 150px;!important;">
                                            <span>Şəkil yüklə</span>
                                        </label>
                                        <div id="previewContainer" style="margin-top: 10px; display: none;">
                                            <img id="imagePreview" src="#" alt="Şəkil" style="max-width: 200px; display: block; margin-bottom: 10px;" />
                                            <div style="display: flex; gap: 10px;width: 123%;">
                                                <button type="button" id="removeImage" class="btn btn-danger btn-sm">Sil</button>
                                                <button type="submit" id="saveImage" class="btn btn-success btn-sm">Yadda saxla</button>
                                            </div>
                                        </div>
                                        <div class="invalid-feedback" id="imageError"></div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </section>

    <section class="about-section pb70">
        <div class="container">
            <div class="row">
                @if(!empty($companyPosts[0]))
                    @foreach($companyPosts as $post)
                        <div class="col-sm-6 col-md-6 col-lg-4 post-image-card" data-id="{{ $post->id }}">
                            <div class="gallery_item position-relative">
                                <img style="max-height: 257px;!important;" class="img-fluid img-circle-rounded w100" src="{{ asset('uploads/company-posts/'.$post['image']) }}" alt="Şəkil">
                                <div class="gallery_overlay">
                                    <a class="icon popup-img" href="{{ asset('uploads/company-posts/'.$post['image']) }}">
                                        <span class="flaticon-zoom"></span>
                                    </a>
                                </div>
                                <button type="button" class="btn btn-sm btn-danger delete-image-btn" style="position: absolute; top: 10px; right: 10px;" data-id="{{ $post->id }}">
                                    Sil
                                </button>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </section>
    <div class="settings_modal modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md mt100" role="document">
            <div class="modal-content">
                <div class="modal-header" style="text-align: center;display: flex!important;">
                    <h4> -Məlumat tamamlanması</h4>
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
    document.addEventListener('DOMContentLoaded', function () {
        const imageInput = document.getElementById('image');
        const preview = document.getElementById('imagePreview');
        const container = document.getElementById('previewContainer');
        const label = document.getElementById('imageLabel');
        const removeBtn = document.getElementById('removeImage');

        // Şəkil yüklənərkən önizləmə
        if (imageInput) {
            imageInput.addEventListener('change', function (event) {
                const file = event.target.files[0];
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
        }

        // Şəkli silmə düyməsi
        if (removeBtn) {
            removeBtn.addEventListener('click', function () {
                imageInput.value = '';
                preview.src = '#';
                container.style.display = 'none';
                label.style.display = 'block';
            });
        }

        // Formun AJAX ilə göndərilməsi
        $('#companyPost').on('submit', function (e) {
            e.preventDefault();
            $('.form-control').removeClass('is-invalid');
            $('#imageError, #generalError, #generalSuccess').text('');

            let formData = new FormData();
            formData.append('image', $('#image')[0].files[0]);

            $.ajax({
                url: '{{ route('site.company-post.store') }}',
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    if (response.success) {
                        $('#generalSuccess').text(response.message);
                        $('.settings_modal').modal('show');
                        $('.settings_modal .close').on('click', function () {
                            location.reload();
                        });
                    }
                },
                error: function (xhr) {
                    if (xhr.status === 422) {
                        const res = xhr.responseJSON;
                        if (res.errors && res.errors.image) {
                            $('#image').addClass('is-invalid');
                            $('#imageError').removeClass('d-none').addClass('d-block').text(res.errors.image[0]);
                        } else if (res.message) {
                            $('#generalError').removeClass('d-none').addClass('d-block').text(res.message);
                            $('.settings_modal').modal('show');
                        }
                    } else {
                        $('#generalError').removeClass('d-none').addClass('d-block').text('Naməlum xəta baş verdi.');
                        $('.settings_modal').modal('show');
                    }
                }
            });
        });

        // Şəkli silmək üçün AJAX
        $(document).on('click', '.delete-image-btn', function () {
            const postId = $(this).data('id');
            const card = $(this).closest('.post-image-card');

            if (confirm('Bu şəkli silmək istədiyinizə əminsiniz?')) {
                $.ajax({
                    url: '/company/company-post/' + postId,
                    method: 'POST',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        _method: 'DELETE'
                    },
                    success: function (response) {
                        if (response.success) {
                            card.remove();
                            location.reload();
                        } else {
                            alert('Silinmə zamanı xəta baş verdi.');
                        }
                    },
                    error: function () {
                        alert('Xəta baş verdi.');
                    }
                });
            }
        });
    });
</script>
@endsection
