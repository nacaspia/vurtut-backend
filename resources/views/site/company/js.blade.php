<script>
    $(document).ready(function () {
        $('#country_id_settings').on('change', function () {
            const countryId = $(this).val();

            if (countryId) {
                $.ajax({
                    url: '{{ route('site.company.cities') }}',
                    type: 'GET',
                    dataType: 'json',
                    data: { country_id: countryId },
                    success: function (response) {
                        if (response.success) {
                            let cityOptions = '<option value="">-Şəhər seçin</option>';

                            response.cities.forEach(city => {
                                if (city.country_id == countryId) {
                                    if (city.sub_regions && city.sub_regions.length > 0) {
                                        city.sub_regions.forEach(subRegion => {
                                            cityOptions += `<option value="${subRegion.id}">${city.name["{{ $currentLang }}"]} / ${subRegion.name["{{ $currentLang }}"]}</option>`;
                                        });
                                    } else {
                                        cityOptions += `<option value="${city.id}">${city.name["{{ $currentLang }}"]}</option>`;
                                    }
                                }
                            });
                            $('#city_id_settings').html(cityOptions);
                        } else {
                            $('#city_id_settings').html('<option value="">-Şəhər tapılmadı</option>');
                        }
                    },
                    error: function () {
                        alert("Xəta baş verdi.");
                    }
                });
            } else {
                $('#city_id_settings').html('<option value="">-Şəhər seçin</option>');
            }
        });
    });
    document.getElementById('image_settings').addEventListener('change', function (event) {
        const file = event.target.files[0];
        const preview = document.getElementById('imagePreview');
        const container = document.getElementById('previewContainer');
        const label = document.getElementById('imageLabel');

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
    document.getElementById('removeImage').addEventListener('click', function () {
        const input = document.getElementById('image_settings');
        const preview = document.getElementById('imagePreview');
        const container = document.getElementById('previewContainer');
        const label = document.getElementById('imageLabel');
        input.value = '';
        preview.src = '#';
        container.style.display = 'none';
        label.style.display = 'block';
    });
    $('#settingsFrom').on('submit', function (e) {
        e.preventDefault();
        $('.form-control').removeClass('is-invalid');
        $('#imageSettingsError, #parentSettingsError, #categorySettingsError, #countrySettingsError, #citySettingsError, #fullNameSettingsError, #onePhoneSettingsError, #twoPhoneSettingsError, #oneEmailSettingsError, #bioSettingsError, facebookSettingsError, linkedinSettingsError,tiktokSettingsError,instagramSettingsError, hoursSettingsError, #generalSettingsError, #generalSettingsSuccess').text('');
        let formData = new FormData();
        $('#settingsCountry').prop('disabled', true).html('Gözləyin...');
        formData.append('_token', $('meta[name="csrf-token"]').attr('content'));
        formData.append('_method', 'PUT'); // Laravel PUT istəklər üçün
        formData.append('image', $('#image_settings')[0].files[0]);
        formData.append('parent_id', $('#parent_id').val());
        formData.append('category_id', $('#category_id').val());
        formData.append('country_id', $('#country_id_settings').val());
        formData.append('city_id', $('#city_id_settings').val());
        formData.append('full_name', $('#full_name').val());
        formData.append('bio', $('#bio').val());
        formData.append('one_phone', $('#one_phone').val());
        formData.append('two_phone', $('#two_phone').val());
        formData.append('one_email', $('#one_email').val());
        formData.append('facebook', $('#facebook').val());
        formData.append('instagram', $('#instagram').val());
        formData.append('linkedin', $('#linkedin').val());
        formData.append('tiktok', $('#tiktok').val());
        // Tüm saatleri (her gün için) FormData'ya ekle
        $('select[name^="hours"]').each(function () {
            let day = $(this).attr('name').match(/\[(.*?)\]/)[1]; // Mon, Tue vs.
            formData.append(`hours[${day}]`, $(this).val());
        });

// Seçilen servis checkboxlarını FormData'ya ekle
        $('input[name="services[]"]:checked').each(function () {
            formData.append('services[]', $(this).val());
        });

        $.ajax({
            url: '{{ route('site.company.settings-update',$company->id) }}',
            method: 'POST', // PUT üçün method POST olacaq, çünki FormData PUT-u dəstəkləmir
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                if (response.success) {
                    $('#generalSettingsSuccess').text(response.message);
                    $('.settings_modal').modal('show'); // modalı göstər
                    $('.settings_modal .close').on('click', function () {
                        location.reload();
                    });
                }
            },
            error: function (xhr) {
                $('#settingsCountry').prop('disabled', true).html('Yadda saxla');
                if (xhr.status === 422) {
                    const res = xhr.responseJSON;
                    if (res.errors) {
                        if (res.errors.image) {
                            $('#image_settings').addClass('is-invalid');
                            $('#imageSettingsError').removeClass('d-none').addClass('d-block').text(res.errors.image[0]);
                        }

                        if (res.errors.parent_id) {
                            $('#parent_id').addClass('is-invalid');
                            $('#parentSettingsError').removeClass('d-none').addClass('d-block').text(res.errors.parent_id[0]);
                        }


                        if (res.errors.category_id) {
                            $('#category_id_settings').addClass('is-invalid');
                            $('#categorySettingsError').removeClass('d-none').addClass('d-block').text(res.errors.category_id[0]);
                        }

                        if (res.errors.country_id) {
                            $('#country_id_settings').addClass('is-invalid');
                            $('#countrySettingsError').removeClass('d-none').addClass('d-block').text(res.errors.country_id[0]);
                        }

                        if (res.errors.city_id) {
                            $('#city_id_settings').addClass('is-invalid');
                            $('#citySettingsError').text(res.errors.city_id[0]);
                        }

                        if (res.errors.full_name) {
                            $('#full_name_settings').addClass('is-invalid');
                            $('#fullNameSettingsError').removeClass('d-none').addClass('d-block').text(res.errors.full_name[0]);
                        }
                        if (res.errors.bio) {
                            $('#bio_settings').addClass('is-invalid');
                            $('#bioSettingsError').removeClass('d-none').addClass('d-block').text(res.errors.bio[0]);
                        }

                        if (res.errors.one_email) {
                            $('#one_email').addClass('is-invalid');
                            $('#oneEmailSettingsError').removeClass('d-none').addClass('d-block').text(res.errors.one_email[0]);
                        }
                        if (res.errors.one_phone) {
                            $('#one_phone').addClass('is-invalid');
                            $('#onePhoneSettingsError').removeClass('d-none').addClass('d-block').text(res.errors.one_phone[0]);
                        }
                        if (res.errors.two_phone) {
                            $('#two_phone').addClass('is-invalid');
                            $('#twoPhoneSettingsError').removeClass('d-none').addClass('d-block').text(res.errors.two_phone[0]);
                        }
                        if (res.errors.facebook) {
                            $('#facebook').addClass('is-invalid');
                            $('#facebookSettingsError').removeClass('d-none').addClass('d-block').text(res.errors.facebook[0]);
                        }
                        if (res.errors.instagram) {
                            $('#instagram').addClass('is-invalid');
                            $('#instagramSettingsError').removeClass('d-none').addClass('d-block').text(res.errors.instagram[0]);
                        }
                        if (res.errors.linkedin) {
                            $('#linkedin').addClass('is-invalid');
                            $('#linkedinSettingsError').removeClass('d-none').addClass('d-block').text(res.errors.linkedin[0]);
                        }
                        if (res.errors.tiktok) {
                            $('#tiktok').addClass('is-invalid');
                            $('#tiktokSettingsError').removeClass('d-none').addClass('d-block').text(res.errors.tiktok[0]);
                        }
                        if (res.errors.services) {
                            $('#servicesSettingsError').removeClass('d-none').addClass('d-block').text(res.errors.services[0]);
                        }
                        // let day = ['Mon','Tue','Wed','Thu','Fri','Sat','Sun']
                        // console.log(res.errors.hours)
                        /*if (res.errors.hours) {
                            console.log(res.errors.hours.Mon)
                            $('#hoursSettingsError').removeClass('d-none').addClass('d-block').text(res.errors.hours);
                        }
*/
                    } else if (res.message) {
                        $('#generalSettingsError').removeClass('d-none').addClass('d-block').text(res.message);
                        $('.settings_modal').modal('show'); // modalı göstər
                    }
                } else {
                    console.log('2')
                    $('#generalSettingsError').removeClass('d-none').addClass('d-block').text('Naməlum xəta baş verdi.');
                }
            }
        });
    });

    $('#registerSettings').on('submit', function (e) {
        e.preventDefault();
        $('.form-control').removeClass('is-invalid');
        $('#emailRegisterSettingsError, #phoneRegisterSettingsError, #addressRegisterSettingsError, #generalRegisterSettingsError, #generalRegisterSettingsSuccess').text('');
        let formData = new FormData();
        $('#settingsButton').prop('disabled', true).html('Gözləyin...');
        formData.append('_token', $('meta[name="csrf-token"]').attr('content'));
        formData.append('_method', 'PUT'); // Laravel PUT istəklər üçün
        formData.append('email', $('#emailRegister').val());

        formData.append('phone', $('#phoneRegister').val());
        formData.append('latitude', $('#latitude').val());
        formData.append('longitude', $('#longitude').val());
        formData.append('address', $('#addressRegister').val());
        $.ajax({
            url: '{{ route('site.company.settings-register',$company->id) }}',
            method: 'POST', // PUT üçün method POST olacaq, çünki FormData PUT-u dəstəkləmir
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                if (response.success) {
                    $('#generalSettingsSuccess').text(response.message);
                    $('.settings_modal').modal('show'); // modalı göstər
                    $('.settings_modal .close').on('click', function () {
                        location.reload();
                    });
                }
            },
            error: function (xhr) {
                $('#settingsButton').prop('disabled', true).html('Məlumatları yenilə');
                if (xhr.status === 422) {
                    const res = xhr.responseJSON;
                    if (res.errors) {
                        if (res.errors.phone) {
                            $('#phoneRegister').addClass('is-invalid');
                            $('#phoneRegisterSettingsError').removeClass('d-none').addClass('d-block').text(res.errors.phone[0]);
                        }

                        if (res.errors.email) {
                            $('#emailRegister').addClass('is-invalid');
                            $('#emailRegisterSettingsError').removeClass('d-none').addClass('d-block').text(res.errors.email[0]);
                        }

                        if (res.errors.address) {
                            $('#addressRegister').addClass('is-invalid');
                            $('#addressRegisterSettingsError').removeClass('d-none').addClass('d-block').text(res.errors.address[0]);
                        }

                    } else if (res.message) {
                        $('#generalRegisterSettingsError').text(res.message);
                    }
                } else {
                    $('#generalRegisterSettingsError').text('Naməlum xəta baş verdi.');
                }
            }
        });
    });

    $('#settingsPassword').on('submit', function (e) {
        e.preventDefault();
        $('.form-control').removeClass('is-invalid');
        $('#oldPasswordError, #newPasswordError, #confNewPasswordError, #generalSettingsPasswordError, #generalSettingsPasswordSuccess').text('');
        let formData = new FormData();
        $('#settingsPassButton').prop('disabled', true).html('Gözləyin...')
        formData.append('_token', $('meta[name="csrf-token"]').attr('content'));
        formData.append('_method', 'PUT'); // Laravel PUT istəklər üçün
        formData.append('old_password', $('#old_password').val());
        formData.append('new_password', $('#new_password').val());
        formData.append('conf_new_password', $('#conf_new_password').val());
        $.ajax({
            url: '{{ route('site.company.settings-password-update',$company->id) }}',
            method: 'POST', // PUT üçün method POST olacaq, çünki FormData PUT-u dəstəkləmir
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                if (response.success) {
                    $('#generalSettingsError').text(response.message);
                    $('.settings_modal').modal('show'); // modalı göstər
                    $('.settings_modal .close').on('click', function () {
                        location.reload();
                    });
                }
            },
            error: function (xhr) {
                $('#settingsPassButton').prop('disabled', true).html('Şifrəni dəyiş')
                if (xhr.status === 422) {
                    const res = xhr.responseJSON;
                    if (res.errors) {
                        if (res.errors.old_password) {
                            $('#old_password').addClass('is-invalid');
                            // $('.invalid-feedback').hide();
                            $('#oldPasswordError').removeClass('d-none').addClass('d-block').text(res.errors.old_password[0]);
                        }

                        if (res.errors.new_password) {
                            $('#new_password').addClass('is-invalid');
                            $('#newPasswordError').removeClass('d-none').addClass('d-block').text(res.errors.new_password[0]);
                        }

                        if (res.errors.conf_new_password) {
                            $('#conf_new_password').addClass('is-invalid');
                            $('#confNewPasswordError').removeClass('d-none').addClass('d-block').text(res.errors.conf_new_password[0]);
                        }

                    } else if (res.message) {
                        $('#generalSettingsPasswordError').text(res.message);
                    }
                } else {
                    $('#generalSettingsPasswordError').text('Naməlum xəta baş verdi.');
                }
            }
        });
    });
</script>
