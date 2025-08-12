@extends('site.company.layouts.app')
@section('company.css')
    <style>
        .contact.active {
            background-color: #f0f0f0;
            border-left: 3px solid #007bff;
        }
    </style>
    <link rel="stylesheet" href="{{ asset("site/css/bootstrap.min.css") }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('company.content')
    <!-- Our Dashbord -->
    <section class="our-dashbord dashbord bgc-f4">
        <div class="container">
            <div class="row">
                @include('site.company.layouts.mobile-menu')
                <div class="col-lg-12 mb15">
                    <div class="breadcrumb_content style2">
                        <h2 class="breadcrumb_title float-left">Rezervasiyalar</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-5 col-xl-4">
                    <div class="message_container">
                        <div class="inbox_user_list">
                            {{--<div class="iu_heading">
                                <div class="candidate_revew_search_box">
                                    <form class="form-inline">
                                        <input class="form-control" type="search" placeholder="Müştəri axtar" aria-label="Search">
                                        <button class="btn" type="submit"><span class="flaticon-loupe"></span></button>
                                    </form>
                                </div>
                            </div>--}}
                            <ul>
                                @if(!empty($users[0]))
                                    @foreach($users as $user)
                                        <li class="contact" data-company-id="{{ $user->id }}">
                                            <a href="#">
                                                <div class="wrap">
                                                    {{--                                                    <span class="contact-status online"></span>--}}
                                                    <img class="img-fluid" src="{{ !empty($user->image)? asset("uploads/user/".$user->image): asset('site/images/Vurtut logo icon/account.png') }}" alt="author2.png">
                                                    <div class="meta">
                                                        <h5 class="name">{{ $user['full_name'] }}</h5>
                                                        <p class="preview">İstifadəçi</p>
                                                    </div>
                                                    {{--                                                    <div class="m_notif">2</div>--}}
                                                </div>
                                            </a>
                                        </li>
                                    @endforeach
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7 col-xl-8">
                    @if(!empty($users[0]))
                        @foreach($users as $user)
                            {{--                            <div class="message_container mt30-smd">--}}
                            <div class="card mb-3 reservation-wrapper" data-company-id="{{ $user->id }}">
                                <div class="card-body">
                                    <div class="user_heading">
                                        <div class="wrap">
                                            <span class="contact-status online"></span>
                                            <img class="img-fluid" style="max-width: 64px;!important;" src="{{ !empty($user->image)? asset("uploads/user/".$user->image): asset('site/images/Vurtut logo icon/account.png') }}" alt="author2.png">
                                            <div class="meta">
                                                <h5 class="name">{{ $user['full_name'] }}</h5>
                                                <p class="preview">Sorğu göndərilmə tarixi: {{ $user['companyReservation']->first()?->date ?? 'Məlumat yoxdur' }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="reservation-list" style="max-height: 400px; overflow-y: auto;">
                                        @foreach($user['companyReservation'] as $userReservation)
                                            <div class="card mb-3 reservation-card">
                                                <div class="card-body">
                                                    <h5 class="card-title mb-2">🗓️ {{ date('Y-m-d',strtotime($userReservation['date'])) }}  ⏰ {{ date('H:i',strtotime($userReservation['date'])) }}</h5>
                                                    <p class="mb-1"><strong>Ad Soyad:</strong>{{ $userReservation['full_name'] }}</p>
                                                    <p class="mb-1"><strong>Əlaqə nömrəsi:</strong>{{ $userReservation['phone'] }}</p>
                                                    <p class="mb-1"><strong>Yer/Masa sayı:</strong> {{ $userReservation['place_count'] }}</p>
                                                    <p class="mb-1"><strong>Adam sayı:</strong> {{ $userReservation['person_count'] }}</p>
                                                    <p class="mb-0"><strong>Əlavə məlumat:</strong> {{ $userReservation['text'] }}</p>
                                                    <p><strong>Rezervasiya cavabı:</strong> <span class="text-muted">{{ $userReservation['company_text'] ?? 'Rezervasiya cavablandırılmayıb.' }}</span></p>
                                                        <?php
                                                        $status = 'Baxılmayıb';
                                                        if ($userReservation['status'] == 1) {
                                                            $status = 'Qəbul edildi';
                                                        }elseif ($userReservation['status'] == 2) {
                                                            $status = 'Qəbul edilmədi';
                                                        }
                                                        ?>
                                                    <p><strong>Status:</strong> <span class="text-muted">{{$status}}</span></p>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
{{--                                    @dd($user['companyReservation']->first())--}}
                                    @if($user['companyReservation']->first()?->status ==0)
                                    <form id="reservationAccept">
                                        <input type="hidden" id="reservation_id" name="reservation_id" value="{{$user['companyReservation']->first()?->id}}">
                                        <input type="hidden" id="status" name="status" value=""> <!-- Yeni: status dəyəri üçün -->
                                        <div class="mt-3">
                                            <textarea id="company_text" name="company_text" class="form-control mb-2" rows="2" placeholder="Cavabınızı yazın..."></textarea>
                                            <div class="invalid-feedback" id="companyTextError"></div>
                                            <div class="d-flex justify-content-end">
                                                <button type="button" class="btn btn-danger mr-2" id="rejectReservation">Rədd et</button>
                                                <button type="button" class="btn btn-success" id="acceptReservation">Qəbul et</button>
                                            </div>
                                        </div>
                                    </form>
                                    @endif
                                </div>
                            </div>
                            {{--                            </div>--}}
                        @endforeach
                    @endif
                    {{--<div class="message_container mt30-smd">
                        <div class="user_heading">
                            <div class="wrap">
                                <span class="contact-status online"></span>
                                <img class="img-fluid mr10" src="images/team/s3.jpg" alt="s3.jpg"/>
                                <div class="meta">
                                    <h5 class="name">Joanne Davies</h5>
                                    <p class="preview">Sorğu göndərilmə tarixi: 2025.07.03 11:43</p>
                                </div>
                            </div>
                        </div>
                        <div class="reservation-list" style="max-height: 400px; overflow-y: auto;">
                            <div class="card mb-3 reservation-card" data-reply="" data-status="" data-id="1">
                                <div class="card-body">
                                    <h5 class="card-title mb-2">🗓️ 2025-07-04 - ⏰ 14:00</h5>
                                    <p class="mb-1"><strong>Ad Soyad:</strong>Qəzənfər Məzahirli</p>
                                    <p class="mb-1"><strong>Əlaqə nömrəsi:</strong>+994 50 123 45 67</p>
                                    <p class="mb-1"><strong>Yer sayı:</strong> 2</p>
                                    <p class="mb-1"><strong>Adam sayı:</strong> 4</p>
                                    <p class="mb-0"><strong>Əlavə məlumat:</strong> Uşaqlar üçün xüsusi menyu istəyirik.</p>
                                </div>
                            </div>
                            <div class="card mb-3 reservation-card" data-reply="" data-status="" data-id="2">
                                <div class="card-body">
                                    <h5 class="card-title mb-2">🗓️ 2025-07-06 - ⏰ 19:00</h5>
                                    <p class="mb-1"><strong>Ad Soyad:</strong> Joanne Davies</p>
                                    <p class="mb-1"><strong>Əlaqə nömrəsi:</strong> +994 50 987 65 43</p>
                                    <p class="mb-1"><strong>Yer sayı:</strong> 1</p>
                                    <p class="mb-1"><strong>Adam sayı:</strong> 2</p>
                                    <p class="mb-0"><strong>Əlavə:</strong> Ad günü qeyd olunacaq</p>
                                </div>
                            </div>
                            <div class="card mb-3 reservation-card" data-reply="" data-status="" data-id="3">
                                <div class="card-body">
                                    <h5 class="card-title mb-2">🗓️ 2025-07-07 - ⏰ 13:00</h5>
                                    <p class="mb-1"><strong>Ad Soyad:</strong> Elvin Məmmədov</p>
                                    <p class="mb-1"><strong>Əlaqə nömrəsi:</strong> +994 50 456 78 90</p>
                                    <p class="mb-1"><strong>Yer sayı:</strong> 3</p>
                                    <p class="mb-1"><strong>Adam sayı:</strong> 6</p>
                                    <p class="mb-0"><strong>Əlavə məlumat:</strong> Balkon masası istəyirik.</p>
                                </div>
                            </div>
                            <div class="card mb-3 reservation-card" data-reply="" data-status="" data-id="4">
                                <div class="card-body">
                                    <h5 class="card-title mb-2">🗓️ 2025-07-08 - ⏰ 20:00</h5>
                                    <p class="mb-1"><strong>Ad Soyad:</strong> Nigar Rəhimli</p>
                                    <p class="mb-1"><strong>Əlaqə nömrəsi:</strong> +994 50 321 45 67</p>
                                    <p class="mb-1"><strong>Yer sayı:</strong> 2</p>
                                    <p class="mb-1"><strong>Adam sayı:</strong> 3</p>
                                    <p class="mb-0"><strong>Əlavə məlumat:</strong> Səssiz künc masa istəyirik.</p>
                                </div>
                            </div>
                        </div>
                        <div id="reservationReplyBox" class="mt-3 p-3 border rounded bg-light">
                            <p><strong>Rezervasiya cavabı:</strong> <span id="reservationResponseText" class="text-muted">Rezervasiya cavablandırılmayıb.</span></p>
                            <p><strong>Status:</strong> <span id="reservationStatusText" class="text-muted">-</span></p>
                        </div>
                        <div class="mt-3">
                            <textarea id="adminReplyInput" class="form-control mb-2" rows="2" placeholder="Cavabınızı yazın..."></textarea>
                            <div class="d-flex justify-content-end">
                                <button class="btn btn-danger mr-2" id="rejectReservation">Rədd et</button>
                                <button class="btn btn-success" id="acceptReservation">Qəbul et</button>
                            </div>
                        </div>
                    </div>--}}
                </div>
            </div>
        </div>
    </section>

    <div class="settings_modal modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md mt100" role="document">
            <div class="modal-content">
                <div class="modal-header" style="text-align: center;display: flex!important;">
                    <h4> -Rezervasiya qəbulu</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body container pb20 pl0 pr0 pt0">

                    <div class="tab-content container" id="myTabContent">
                        <div class="row mt40 tab-pane fade show active pl20 pr20" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <div class="col-lg-12">
                                <div class="login_form">
                                    <div class="text-danger text-center mt-2" id="generalReservationError" style="font-weight: bold;!important;"></div>
                                    <div class="text-success text-center mt-2" id="generalReservationSuccess" style="font-weight: bold;!important;"></div>
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
            const contacts = document.querySelectorAll('.contact');
            const wrappers = document.querySelectorAll('.reservation-wrapper');

            contacts.forEach(contact => {
                contact.addEventListener('click', function () {
                    const companyId = this.getAttribute('data-company-id');

                    // Bütün reservation-wrapper'ları gizlət
                    wrappers.forEach(wrapper => {
                        wrapper.style.display = 'none';
                    });

                    // Uyğun olanı göstər
                    const targetWrapper = document.querySelector(`.reservation-wrapper[data-company-id="${companyId}"]`);
                    if (targetWrapper) {
                        targetWrapper.style.display = 'block';
                    }

                    // Aktiv class idarəsi (istəyə bağlı)
                    contacts.forEach(c => c.classList.remove('active'));
                    this.classList.add('active');
                });
            });

            // İlk müəssisəni avtomatik açmaq üçün:
            if (contacts.length > 0) {
                contacts[0].click();
            }
        });
        $(document).ready(function () {
            $('#rejectReservation').click(function () {
                $('#status').val(2); // Rədd et
                sendReservation();
            });

            $('#acceptReservation').click(function () {
                $('#status').val(1); // Qəbul et
                sendReservation();
            });

            function sendReservation() {
                $('.form-control').removeClass('is-invalid');
                $('#companyTextError, #generalReservationSuccess, #generalReservationSuccess').text('');
                let form = $('#reservationAccept')[0];
                let formData = new FormData(form);
                let reservationId = formData.get('reservation_id');

                // PUT metodu üçün _method əlavə olunur
                formData.append('_method', 'PUT');

                $.ajax({
                    url: `/company/reservation-update/${reservationId}`,
                    type: 'POST', // PUT əvəzinə POST göndərilir, amma _method ilə PUT kimi işləyir
                    data: formData,
                    processData: false,
                    contentType: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (response) {
                        if (response.success) {
                            if (response.success) {
                                $('#generalReservationSuccess').text(response.message);
                                $('.settings_modal').modal('show'); // modalı göstər
                            }
                        }
                    },
                    error: function (xhr) {
                        if (xhr.status === 422) {
                            const res = xhr.responseJSON;
                            if (res.errors) {
                                if (res.errors.company_text) {
                                    $('#company_text').addClass('is-invalid');
                                    $('#companyTextError').removeClass('d-none').addClass('d-block').text(res.errors.company_text[0]);
                                }

                            } else if (res.message) {
                                $('#generalReservationError').removeClass('d-none').addClass('d-block').text(res.message);
                            }
                        } else {
                            $('#generalReservationError').removeClass('d-none').addClass('d-block').text('Naməlum xəta baş verdi.');
                        }
                    }
                });
            }
        });
        $('.settings_modal').on('hidden.bs.modal', function () {
            location.reload(); // Modal bağlananda səhifə yenilə
        });

    </script>

{{--    <script>--}}
{{--        let selectedCard = null;--}}
{{--        document.querySelectorAll('.reservation-card').forEach(card => {--}}
{{--            card.addEventListener('click', () => {--}}
{{--                selectedCard = card;--}}
{{--                const reply = card.getAttribute('data-reply') || 'Rezervasiya cavablandırılmayıb.';--}}
{{--                const status = card.getAttribute('data-status') || '-';--}}
{{--                document.getElementById('reservationResponseText').innerText = reply;--}}
{{--                document.getElementById('reservationStatusText').innerText = status;--}}
{{--            });--}}
{{--        });--}}
{{--        document.getElementById('acceptReservation').addEventListener('click', () => {--}}
{{--            if (!selectedCard) return;--}}
{{--            const reply = document.getElementById('adminReplyInput').value.trim();--}}
{{--            selectedCard.setAttribute('data-reply', reply);--}}
{{--            selectedCard.setAttribute('data-status', 'Qəbul edildi ✅');--}}
{{--            document.getElementById('reservationResponseText').innerText = reply;--}}
{{--            document.getElementById('reservationStatusText').innerText = 'Qəbul edildi ✅';--}}
{{--            document.getElementById('adminReplyInput').value = '';--}}
{{--        });--}}
{{--        document.getElementById('rejectReservation').addEventListener('click', () => {--}}
{{--            if (!selectedCard) return;--}}
{{--            const reply = document.getElementById('adminReplyInput').value.trim();--}}
{{--            selectedCard.setAttribute('data-reply', reply);--}}
{{--            selectedCard.setAttribute('data-status', 'Rədd edildi ❌');--}}
{{--            document.getElementById('reservationResponseText').innerText = reply;--}}
{{--            document.getElementById('reservationStatusText').innerText = 'Rədd edildi ❌';--}}
{{--            document.getElementById('adminReplyInput').value = '';--}}
{{--        });--}}
{{--    </script>--}}
@endsection
