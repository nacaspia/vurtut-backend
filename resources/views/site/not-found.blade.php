@extends('site.layouts.app')
@section('site.title')
    @lang('site.about_us')
@endsection
@section('site.css')
    <style>
        .no-content {
            text-align: center;
            padding: 50px 0;
            background-color: #f8f9fa;
            color: #333;
        }

        .no-content p {
            font-size: 18px;
            margin-bottom: 20px;
        }

        .no-content .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }

        .no-content .btn:hover {
            background-color: #0056b3;
        }
    </style>
@endsection
@section('site.content')
    <div class="no-content">
        <p>Məlumat tapılmadı.</p>
        <a href="{{url()->previous()}}" class="btn btn-primary">Geri qayıt</a>
    </div>
@endsection
@section('site.js')
@endsection
