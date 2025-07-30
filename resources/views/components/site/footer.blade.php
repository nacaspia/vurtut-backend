<!-- Premium Hesab Modal -->
<div class="modal fade" id="premiumCompany" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document" style="max-width: 500px;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Premium Hesab Al</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Bağla">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="{{ route('site.company.premium.redirectToBank') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <p>Premium hesab alaraq hesabınızı önə çıxarın və daha çox istifadəçiyə çata bilərsiniz.</p>

                    <div class="form-group">
                        <label for="premiumDuration">Premium müddəti:</label>
                        <select name="limit" id="premiumDuration" class="form-control" required>
                            @foreach(config("premium.limits") as $limitKey => $limit)
                                <option value="{{$limitKey}}">{{$limit}}</option>
                            @endforeach

                        </select>
                    </div>

                    <div class="alert alert-info mt-3">
                        Ödəniş Kapital Bank və ya Paşa Bank vasitəsilə həyata keçiriləcək.
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Bağla</button>
                    <button type="submit" class="btn btn-primary">Ödənişə keç</button>
                </div>
            </form>
        </div>
    </div>
</div>




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
                        <li><span class="flaticon-email mr15"></span><a href="mailto:nacaspia.main@gmail.com">nacaspia.main@gmail.com</a></li>
                        <li><span></span><a href="{{ route('site.contact') }}"><b>Ətraflı</b></a></li>
                    </ul>
                </div>
            </div>
            <div class="col-sm-6 col-md-6 col-lg-2 col-xl-3">
                <div class="footer_qlink_widget home2">
                    <h4>Ətraflı</h4>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('site.faqs') }}">FAQ</a></li>
                        <li><a href="{{ route('site.about') }}">Haqqımızda</a></li>
                        <li><a href="{{ route('site.career') }}">Karyera</a></li>
                        <li><a href="{{ route('site.how-we-work') }}">Necə işləyirik</a></li>
                        <li><a href="{{ route('site.terms-of-use') }}">Şərtlər və qaydalar</a></li>
                        <li><a href="{{ route('site.privacy-policy') }}">Məxfilik siyasəti</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-sm-5 col-md-6 col-lg-2 col-xl-2">
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
            <div class="col-sm-7 col-md-6 col-lg-4 col-xl-4">
                <div class="footer_social_widget home2">
                    <h4>Abone ol</h4>
                    <p class="mb20">Önəmli bildirişlərdən e-mail vasitısilə xəbərdar olun!</p>
                    <form class="footer_mailchimp_form home2">
                        <div class="form-row align-items-center">
                            <div class="col-auto">
                                <input type="email" class="form-control" id="inlineFormInput" placeholder="E-mail adresiniz...">
                                <button type="submit" class="btn btn-primary">Təsdiqlə</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="container pt20 pb30">
        <div class="row">
            <div class="col-md-4 col-lg-4">
                <div class="copyright-widget mt10 mb15-767 home2">
                    <p>© By NACaspia Informaion Technologies MMC</p>
                </div>
            </div>
            <div class="col-md-4 col-lg-4">
                <div class="footer_logo_widget text-center mb15-767 home2">
                    <div class="wrapper">
                        <div class="logo text-center">
                            <img style="max-width: 26%; border-radius: 50px!important;" src="{{ asset("site/images/Vurtut logo icon/vurtut.com.svg") }}" alt="vurtut">
                            <span class="logo_title pl15">VURTUT</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-lg-4">
                <div class="footer_social_widget text-right tac-smd mt10 home2">
                    <ul class="mb0">
                        <li class="list-inline-item"><a href="{{(!empty($settings['social']) &&  !empty($settings['social']['facebook']))? $settings['social']['facebook']: null}}"><i class="fa fa-facebook"></i></a></li>
                        <li class="list-inline-item"><a href="{{(!empty($settings['social']) &&  !empty($settings['social']['youtube']))? $settings['social']['youtube']: null}}"><i class="fa fa-youtube"></i></a></li>
                        <li class="list-inline-item"><a href="{{(!empty($settings['social']) &&  !empty($settings['social']['tiktok']))? $settings['social']['tiktok']: null}}">T</a></li>
                        <li class="list-inline-item"><a href="{{(!empty($settings['social']) &&  !empty($settings['social']['instagram']))? $settings['social']['instagram']: null}}"><i class="fa fa-instagram"></i></a></li>
                        <li class="list-inline-item"><a href="{{(!empty($settings['social']) &&  !empty($settings['social']['linkedin']))? $settings['social']['linkedin']: null}}"><i class="fa fa-linkedin"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<a class="scrollToHome" href="#"><i class="fa fa-angle-up"></i></a>
</div>

@yield('site.js')

<script>
    $('#loginForm').on('submit', function (e) {
        e.preventDefault();

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
                    window.location.href = response.route;
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
            }
        });
    });
    $('#userRegister').on('submit', function (e) {
        e.preventDefault();

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
                }
            },
            error: function (xhr) {
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
                }
            },
            error: function (xhr) {
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
            }
        });
    });
</script>
</body>
</html>
