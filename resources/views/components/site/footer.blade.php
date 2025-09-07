<!-- Premium Hesab Modal -->

<section class="footer_one home2">
    <div class="container pb70">
        <div class="row">
            <div class="col-sm-6 col-md-6 col-lg-3 col-xl-3">
                <div class="footer_contact_widget home2">
                    <h4>Bizimlə əlaqə</h4>
                    <ul class="list-unstyled">
                        <li class="df"><span class="flaticon-pin mr15"></span><a>Azerbaycan, Bakı şəhəri</a></li>
                        <li><span class="flaticon-phone mr15"></span><a href="tel:+994552956727">+994552956727</a></li>
                        <li><span class="flaticon-phone mr15"></span><a href="tel:+994552952767">+994552952767</a></li>
                        <li><span class="flaticon-email mr15"></span><a href="mailto:info@nacaspia.com">info@nacaspia.com</a></li>
                        <li><span></span><a href="{{ route('site.contact') }}"><b>Ətraflı</b></a></li>
                    </ul>
                </div>
            </div>
            <div class="col-sm-6 col-md-6 col-lg-3 col-xl-3">
                <div class="footer_qlink_widget home2">
                    <h4>Ətraflı</h4>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('site.faqs') }}">FAQ</a></li>
                        <li><a href="{{ route('site.about') }}">Haqqımızda</a></li>
{{--                        <li><a href="{{ route('site.career') }}">Karyera</a></li>--}}
                        <li><a href="{{ route('site.how-we-work') }}">Necə işləyirik</a></li>
                        <li><a href="{{ route('site.terms-of-use') }}">Şərtlər və qaydalar</a></li>
                        <li><a href="{{ route('site.privacy-policy') }}">Məxfilik siyasəti</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-sm-6 col-md-6 col-lg-3 col-xl-3">
                <div class="footer_qlink_widget pl0 home2">
                    <h4>Lokaldan qlobala</h4>
                    <ul class="list-unstyled">
                        <li><a>Azərbaycan aktivdir</a></li>
                        <li><a>Türkiyə tezliklə</a></li>
                        <li><a>Rusya tezliklə</a></li>
                        <li><a>Gürcüstan tezliklə</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-sm-6 col-md-6 col-lg-3 col-xl-3">
                <div class="footer_social_widget home2 ">
                    <h4>Tezliklə</h4>
                    <img src="{{ asset('site/images/Vurtut logo icon/store.svg') }}" style="max-height: 126px;!important; object-fit: cover; width: 38%;" alt="App Store">
{{--                    <form class="footer_mailchimp_form home2">--}}
{{--                        <div class="form-row align-items-center">--}}
{{--                            <div class="col-auto">--}}
{{--                                <input type="email" class="form-control" id="inlineFormInput" placeholder="E-mail adresiniz...">--}}
{{--                                <button type="submit" class="btn btn-primary">Təsdiqlə</button>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </form>--}}
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-lg-4 d-flex align-items-center ">
                <div class="copyright-widget mt10 mb15-767 home2">
                    <a href="https://nacaspia.com" target="_blank">
                    <p>© By NACaspia Informaion Technologies MMC</p>
                    </a>
                </div>
            </div>
            <div class="col-md-4 col-lg-4 d-flex align-items-center">
                <div class="footer_logo_widget text-center mb15-767 home2">
                    <div class="wrapper">
                        <div class="logo text-center">
                            <a href="https://nacaspia.com" target="_blank" style="display: flex;align-items: center; width: 90%; height: 26%;" id="logoDiv">
                                <img style="width: auto; max-width: 75%; heigt: 75%; border-radius: 50px!important;" src="{{ asset("site/images/Vurtut logo icon/na-logo.png") }}" alt=" NACaspia Informaion Technologies MMC">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-lg-4 d-flex align-items-center ">
                <div class="footer_social_widget text-right tac-smd mt10 home2 d-flex align-items-center ">
                    <ul class="mb0">
                        <li class="list-inline-item"><a target="_blank" href="{{(!empty($settings['social']) &&  !empty($settings['social']['facebook']))? $settings['social']['facebook']: 'https://www.facebook.com/share/p/17EtUAhM9y/'}}" style="font-size: 20px;"><i class="fa-brands fa-square-facebook" style="font-size: 20px;"></i></a></li>
                        <li class="list-inline-item"><a target="_blank" href="{{(!empty($settings['social']) &&  !empty($settings['social']['youtube']))? $settings['social']['youtube']: 'https://www.youtube.com/@nacaspia'}}" style="font-size: 20px;"><i class="fa-brands fa-youtube" style="font-size: 20px;"></i></a></li>
                        <li class="list-inline-item"><a target="_blank" href="{{(!empty($settings['social']) &&  !empty($settings['social']['tiktok']))? $settings['social']['tiktok']: 'https://www.tiktok.com/@nacaspia?is_from_webapp=1&sender_device=pc'}}" style="font-size: 20px;"><i class="fa-brands fa-tiktok" style="font-size: 20px;"></i></a></li>
                        <li class="list-inline-item"><a target="_blank" href="{{(!empty($settings['social']) &&  !empty($settings['social']['instagram']))? $settings['social']['instagram']: 'https://www.instagram.com/vurtut_com/'}}" style="font-size: 20px;"><i class="fa-brands fa-square-instagram" style="font-size: 20px;"></i></a></li>
                        <li class="list-inline-item"><a target="_blank" href="{{(!empty($settings['social']) &&  !empty($settings['social']['linkedin']))? $settings['social']['linkedin']: 'https://www.linkedin.com/showcase/vurtut-com/'}}" style="font-size: 20px;"><i class="fa-brands fa-linkedin" style="font-size: 20px;"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<a class="scrollToHome" href="#"><i class="fa fa-angle-up"></i></a>
</div>
@include('site.auth.forgot-password')
@yield('site.js')
<script>
    document.getElementById('logoDiv').addEventListener('click', function() {
        window.location.href = "{{ route('site.index') }}";
    });
</script>
<!-- jQuery -->
<script>

    $('#forgetForm').on('submit', function (e) {
        e.preventDefault();

        $('.form-control').removeClass('is-invalid');
        $('#emailPasswordError, #generalPasswordSuccess, #generalPasswordError').text('');

        $.ajax({
            url: '{{ route('site.forgotStatus') }}',
            method: 'POST',
            data: {
                email: $('#emailPassword').val(),
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                $('#generalPasswordSuccess').text(response.message);
                $('.sign_up_modal').modal('show');
                $('.sign_up_modal .close').on('click', function () {
                    location.reload();
                });
            },
            error: function (xhr) {
                if (xhr.status === 422) {
                    const res = xhr.responseJSON;

                    if (res.errors) {
                        if (res.errors.email) {
                            $('#emailPassword').addClass('is-invalid');
                            $('#emailPasswordError').text(res.errors.email[0]);
                        }
                    } else if (res.error) {
                        $('#generalPasswordError').text(res.error);
                    }
                } else {
                    $('#generalPasswordError').text('Naməlum xəta baş verdi.');
                }
            }
        });
    });
    $('#passwordForm').on('submit', function (e) {
        e.preventDefault();
        $('.form-control').removeClass('is-invalid');
        $('#newPasswordError, #confNewPasswordError, #generalPasswordError, #generalPasswordSuccess').text('');
        let formData = new FormData();
        formData.append('_token', $('meta[name="csrf-token"]').attr('content'));
        formData.append('id', $('#idPassword').val());
        formData.append('email', $('#emailPassword').val());
        formData.append('new_password', $('#new_password').val());
        formData.append('conf_new_password', $('#conf_new_password').val());
        $.ajax({
            url: '{{ route('site.forgotSetPassword') }}',
            method: 'POST', // PUT üçün method POST olacaq, çünki FormData PUT-u dəstəkləmir
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                if (response.success) {
                    $('#generalPasswordSuccess').text(response.message);
                    $('.settings_modal').modal('show'); // modalı göstər
                    $('.settings_modal .close').on('click', function () {
                        location.reload();
                    });
                }
            },
            error: function (xhr) {
                if (xhr.status === 422) {
                    const res = xhr.responseJSON;
                    if (res.errors) {
                        if (res.errors.new_password) {
                            $('#new_password').addClass('is-invalid');
                            $('#newPasswordError').removeClass('d-none').addClass('d-block').text(res.errors.new_password[0]);
                        }

                        if (res.errors.conf_new_password) {
                            $('#conf_new_password').addClass('is-invalid');
                            $('#confNewPasswordError').removeClass('d-none').addClass('d-block').text(res.errors.conf_new_password[0]);
                        }

                    } else if (res.message) {
                        $('#generalPasswordError').text(res.message);
                    }
                } else {
                    $('#generalPasswordError').text('Naməlum xəta baş verdi.');
                }
            }
        });
    });

    $('#loginForm').on('submit', function (e) {
        e.preventDefault();

        $('#loginBtn').prop('disabled', true).html('Gözləyin...');
        $('.form-control').removeClass('is-invalid');
        $('#emailError, #passwordError, #generalError').text('');

        $.ajax({
            url: '{{ route('site.loginAccept') }}',
            method: 'POST',
            data: {
                email: $('#email').val(),
                password: $('#password').val(),
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                if (response.success) {
                    // Əgər Flutter WebView içindədirsə, token + user məlumatını ötür
                    if (window.flutter_inappwebview) {
                        window.flutter_inappwebview.callHandler("onLoginSuccess", {
                            token: response.token, // backenddən gələn token
                            userId: response.user_id, // backenddən gələn user id
                            type: response.type // backenddən gələn user id
                        });
                    }
                    window.location.href = response.route;
                } else {
                    // ✅ Əgər cavab uğurlu deyilsə, button-u bərpa et
                    $('#loginBtn').prop('disabled', false).html('Daxil ol');
                }
            },
            error: function (xhr) {
                if (xhr.status === 422) {
                    const res = xhr.responseJSON;

                    if (res.errors) {
                        if (res.errors.email) {
                            $('#email').addClass('is-invalid');
                            $('#emailError').text(res.errors.email[0]);
                        }

                        if (res.errors.password) {
                            $('#password').addClass('is-invalid');
                            $('#passwordError').text(res.errors.password[0]);
                        }
                    } else if (res.message) {
                        $('#generalError').text(res.message);
                    }
                } else {
                    $('#generalError').text('Naməlum xəta baş verdi.');
                }

                // ✅ Əgər cavab uğurlu deyilsə, button-u bərpa et
                $('#loginBtn').prop('disabled', false).html('Daxil ol');
            }
        });
    });
    $('#userRegister').on('submit', function (e) {
        e.preventDefault();

        $('#userRegisterBtn').prop('disabled', true).html('Gözləyin...');
        $('.form-control').removeClass('is-invalid');
        $('#fullNameUserError, #emailUserError, #phoneUserError,  #passwordUserError, #generalUserRegisterSuccess, #generalUserRegisterError').text('');

        $.ajax({
            url: '{{ route('site.registerAccept') }}',
            method: 'POST',
            data: {
                type: $('#type_user').val(),
                full_name: $('#full_name_user').val(),
                email: $('#email_user').val(),
                phone: $('#phone_user').val(),
                password: $('#password_user').val(),
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                if (response.success) {
                    $('#generalUserRegisterSuccess').text(response.message);// Formun bütün inputlarını təmizlə
                    $('#userRegister')[0].reset(); // loginForm -> sənin formanın ID-si
                    $('#userRegisterBtn').prop('disabled', false).html('Qeydiyyat olun');
                }else {
                    $('#userRegisterBtn').prop('disabled', false).html('Qeydiyyat olun');
                }
            },
            error: function (xhr) {
                $('#userRegisterBtn').prop('disabled', false).html('Qeydiyyat olun');
                if (xhr.status === 422) {
                    const res = xhr.responseJSON;
                    if (res.errors) {
                        if (res.errors.full_name) {
                            $('#full_name_user').addClass('is-invalid');
                            $('#fullNameUserError').text(res.errors.full_name[0]);
                        }
                        if (res.errors.email) {
                            $('#email_user').addClass('is-invalid');
                            $('#emailUserError').text(res.errors.email[0]);
                        }

                        if (res.errors.phone) {
                            $('#phone_user').addClass('is-invalid');
                            $('#phoneUserError').text(res.errors.phone[0]);
                        }

                        if (res.errors.password) {
                            $('#password_user').addClass('is-invalid');
                            $('#passwordUserError').text(res.errors.password[0]);
                        }
                        if (typeof res.errors === 'string') {
                            $('#generalUserRegisterError').text(res.errors);
                        }
                    } else if (res.message) {
                        $('#generalUserRegisterError').text(res.message);
                    }
                } else {
                    $('#generalUserRegisterError').text('Xəta baş verdi.');
                }

            }
        });
    });
    $('#companyRegister').on('submit', function (e) {
        e.preventDefault();
        $('#companyRegisterBtn').prop('disabled', false).html('Gözləyin...');
        $('.form-control').removeClass('is-invalid');
        $('#fullNameCompanyError, #emailCompanyError, #phoneCompanyError,  #passwordCompanyError, #generalCompanyRegisterSuccess, #generalCompanyRegisterError').text('');

        $.ajax({
            url: '{{ route('site.registerAccept') }}',
            method: 'POST',
            data: {
                type: $('#type_company').val(),
                full_name: $('#full_name_company').val(),
                email: $('#email_company').val(),
                phone: $('#phone_company').val(),
                password: $('#password_company').val(),
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                if (response.success) {
                    $('#generalCompanyRegisterSuccess').text(response.message);// Formun bütün inputlarını təmizlə
                    $('#companyRegister')[0].reset(); // loginForm -> sənin formanın ID-si
                    $('#companyRegisterBtn').prop('disabled', false).html('Qeydiyyat olun');
                }else {
                    $('#companyRegisterBtn').prop('disabled', false).html('Qeydiyyat olun');
                }
            },
            error: function (xhr) {
                $('#companyRegisterBtn').prop('disabled', false).html('Qeydiyyat olun');
                if (xhr.status === 422) {
                    const res = xhr.responseJSON;
                    if (res.errors) {
                        if (res.errors.full_name) {
                            $('#full_name_company').addClass('is-invalid');
                            $('#fullNameCompanyError').text(res.errors.full_name[0]);
                        }
                        if (res.errors.email) {
                            $('#email_company').addClass('is-invalid');
                            $('#emailCompanyError').text(res.errors.email[0]);
                        }

                        if (res.errors.phone) {
                            $('#phone_company').addClass('is-invalid');
                            $('#phoneCompanyError').text(res.errors.phone[0]);
                        }

                        if (res.errors.password) {
                            $('#password_company').addClass('is-invalid');
                            $('#passwordCompanyError').text(res.errors.password[0]);
                        }
                        if (typeof res.errors === 'string') {
                            $('#generalCompanyRegisterError').text(res.errors);
                        }
                    } else if (res.message) {
                        $('#generalCompanyRegisterError').text(res.message);
                    }
                } else {
                    $('#generalCompanyRegisterError').text('Xəta baş verdi.');
                }
            },
            complete: function () {
                // Əməliyyat bitdikdən sonra düyməni əvvəlki vəziyyətə gətir
                $btn.prop('disabled', false);
                $btn.find('.btn-text').removeClass('d-none');
                $btn.find('.spinner-border').addClass('d-none');
            }
        });
    });
</script>
</body>
</html>
