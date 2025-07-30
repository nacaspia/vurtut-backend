@extends('site.user.layouts.app')
@section('user.css')
    <link type="text/css" rel="stylesheet" href="{{ asset('site/css/modal.css') }}">
    <style>
        .modal-content {
            width: 50%; /* Modalın eni - İstəyə görə 40-60% arası edə bilərsiniz */
            max-width: 500px; /* Maksimum genişlik təyin edin */
            margin: auto; /* Ortaya çəkmək üçün */
            top: 50%; /* Yuxarıdan ortalamaq üçün */
            left: 50%;
            transform: translate(-50%, -50%); /* X və Y oxunda tam ortalama */
            position: fixed; /* Sayfanın ortasında qalması üçün */
            padding: 20px;
        }

        /* Mobil üçün uyğunlaşdırma */
        @media (max-width: 768px) {
            .modal-content {
                width: 90%; /* Kiçik ekranlarda modalın genişliyini artırın */
                max-width: none;
            }
        }

    </style>
@endsection
@section('user.content')
<div class="col-md-9" style="top: 52px!important;">
<div class="dashboard-title dt-inbox fl-wrap">
    <h3>@lang('site.posts')</h3>
    <button id="myPostAdd" class="btn color2-bg float-btn">@lang('site.add_post')</button>
    @include('components.site.error')
</div>
<div class="dashboard-list-box fl-wrap block_box">
    <div class="row">
        @if(!empty($userPost[0]))
            @foreach($userPost as $post)
                <div class="col-md-4" style="display: block; margin-bottom: 20px; position: relative;!important;">
                    <!-- inline-facts -->
                    <a href="{{ asset('uploads/user-posts/'.$post['image']) }}" class="image-popup">
                        <img
                            style="min-width: 271px; min-height: 151px; max-width: 271px; max-height: 151px;!important;"
                            src="{{ asset('uploads/user-posts/'.$post['image']) }}" alt="">
                    </a>
                    <!-- Edit & Delete Buttons -->
                    <div class="image-actions" style="position: absolute; top: 10px; right: 10px;">
                        <form action="{{ route('site.user-post.destroy', $post['id']) }}?type=delete" method="POST"
                              style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Are you sure?')">
                                <span class="new-dashboard-item"><i class="fal fa-times"></i></span>
                            </button>
                        </form>
                    </div>
                    <!-- inline-facts end -->
                </div>
            @endforeach
        @endif
    </div>
</div>
@include('site.user.user-post.add')
@endsection
@section('user.js')
@endsection
