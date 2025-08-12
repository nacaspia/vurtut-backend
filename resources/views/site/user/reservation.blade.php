@extends('site.user.layouts.app')
@section('user.css')
    <style>
        .contact.active {
            background-color: #f0f0f0;
            border-left: 3px solid #007bff;
        }
    </style>
@endsection
@section('user.content')
    <!-- Our Dashbord -->
    <section class="our-dashbord dashbord bgc-f4">
        <div class="container">
            <div class="row">
                @include('site.user.layouts.mobile-menu')
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
                                        <input class="form-control" type="search" placeholder="Müəssisəni axtar" aria-label="Search">
                                        <button class="btn" type="submit"><span class="flaticon-loupe"></span></button>
                                    </form>
                                </div>
                            </div>--}}
                            <ul>
                                @if(!empty($companies[0]))
                                    @foreach($companies as $company)
                                        <li class="contact" data-company-id="{{ $company->id }}">
                                            <a href="#">
                                                <div class="wrap">
{{--                                                    <span class="contact-status online"></span>--}}
                                                    <img class="img-fluid" src="{{ !empty($company->image)? asset("uploads/company/".$company->image): asset('site/images/Vurtut logo icon/account.png') }}" alt="author2.png">
                                                    <div class="meta">
                                                        <h5 class="name">{{ $company['full_name'] }}</h5>
                                                        <p class="preview">{{ $company['category']['title'][$currentLang] }}</p>
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
                    @if(!empty($companies[0]))
                        @foreach($companies as $company)
{{--                            <div class="message_container mt30-smd">--}}
                            <div class="card mb-3 reservation-wrapper" data-company-id="{{ $company->id }}">
                                <div class="card-body">
                                <div class="user_heading">
                                    <div class="wrap">
                                        <span class="contact-status online"></span>
                                        <img class="img-fluid" style="max-width: 64px;!important;" src="{{ !empty($company->image)? asset("uploads/company/".$company->image): asset('site/images/Vurtut logo icon/account.png') }}" alt="author2.png">
                                        <div class="meta">
                                            <h5 class="name">{{ $company['full_name'] }}</h5>
                                            <p class="preview">Sorğu göndərilmə tarixi: {{ $company['userReservation']->first()?->date ?? 'Məlumat yoxdur' }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="reservation-list" style="max-height: 400px; overflow-y: auto;">
                                    @foreach($company['userReservation'] as $userReservation)
                                    <div class="card mb-3 reservation-card">
                                        <div class="card-body">
                                            <h5 class="card-title mb-2">🗓️ {{ date('Y-m-d',strtotime($userReservation['date'])) }}  ⏰ {{ date('H:i',strtotime($userReservation['date'])) }}</h5>
                                            <p class="mb-1"><strong>Ad Soyad:</strong>{{ $userReservation['full_name'] }}</p>
                                            <p class="mb-1"><strong>Əlaqə nömrəsi:</strong>{{ $userReservation['phone'] }}</p>
                                            <p class="mb-1"><strong>Yer/Masa sayı:</strong> {{ $userReservation['place_count'] }}</p>
                                            <p class="mb-1"><strong>Adam sayı:</strong> {{ $userReservation['person_count'] }}</p>
                                            <p class="mb-0"><strong>Əlavə məlumat:</strong> {{ $userReservation['text'] }}</p>
                                            <p><strong>Rezervasiya cavabı:</strong> <span id="reservationResponseText" class="text-muted">{{ $userReservation['company_text'] ?? 'Rezervasiya cavablandırılmayıb.' }}</span></p>
                                            <?php
                                                $status = 'Baxılmayıb';
                                                if ($userReservation['status'] == 1) {
                                                    $status = 'Qəbul edildi';
                                                }elseif ($userReservation['status'] == 2) {
                                                    $status = 'Qəbul edilmədi';
                                                }
                                            ?>
                                            <p><strong>Status:</strong> <span id="reservationStatusText" class="text-muted">{{$status}}</span></p>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                {{--<div class="mt-3">
                                    <textarea id="adminReplyInput" class="form-control mb-2" rows="2" placeholder="Cavabınızı yazın..."></textarea>
                                    <div class="d-flex justify-content-end">
                                        <button class="btn btn-danger mr-2" id="rejectReservation">Rədd et</button>
                                        <button class="btn btn-success" id="acceptReservation">Qəbul et</button>
                                    </div>
                                </div>--}}
                            </div>
                                </div>
{{--                            </div>--}}
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection
@section('user.js')
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
    </script>


    {{--    <script>
            let selectedCard = null;
            document.querySelectorAll('.reservation-card').forEach(card => {
                card.addEventListener('click', () => {
                    selectedCard = card;
                    const reply = card.getAttribute('data-reply') || 'Rezervasiya cavablandırılmayıb.';
                    const status = card.getAttribute('data-status') || '-';
                    document.getElementById('reservationResponseText').innerText = reply;
                    document.getElementById('reservationStatusText').innerText = status;
                });
            });
            document.getElementById('acceptReservation').addEventListener('click', () => {
                if (!selectedCard) return;
                const reply = document.getElementById('adminReplyInput').value.trim();
                selectedCard.setAttribute('data-reply', reply);
                selectedCard.setAttribute('data-status', 'Qəbul edildi ✅');
                document.getElementById('reservationResponseText').innerText = reply;
                document.getElementById('reservationStatusText').innerText = 'Qəbul edildi ✅';
                document.getElementById('adminReplyInput').value = '';
            });
            document.getElementById('rejectReservation').addEventListener('click', () => {
                if (!selectedCard) return;
                const reply = document.getElementById('adminReplyInput').value.trim();
                selectedCard.setAttribute('data-reply', reply);
                selectedCard.setAttribute('data-status', 'Rədd edildi ❌');
                document.getElementById('reservationResponseText').innerText = reply;
                document.getElementById('reservationStatusText').innerText = 'Rədd edildi ❌';
                document.getElementById('adminReplyInput').value = '';
            });
        </script>--}}
@endsection
