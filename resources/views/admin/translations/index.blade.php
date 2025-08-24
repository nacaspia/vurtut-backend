@extends('admin.layouts.app')
@section('admin.title')
    @lang('admin.translations')
@endsection
@section('admin.css')
    <meta name="_token" content="{{ csrf_token() }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/toastr/toastr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/css/jquery.uploader.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/css/select2.min.css') }}">
@endsection
@section('admin.content')
    <div class="main-content">
        <div class="dashboard-breadcrumb mb-25">
            <h2>@lang('admin.translations')</h2>
        </div>
        @include('components.admin.error')
        <div class="row g-4">
            <div class="col-xxl-4 col-md-5">
                <div class="panel">
                    <div class="panel-header">
                        <h5>@lang('admin.add')</h5>
                    </div>
                    <div class="panel-body">
                        <form action="{{ route('admin.translations.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row g-3">
                                <div class="col-12">
                                    <label class="form-label">@lang('admin.lang')</label>
                                    <input type="text" class="form-control" name="name">
                                </div>

                                <div class="col-12">
                                    <label class="form-label">@lang('admin.code')</label>
                                    <input type="text" class="form-control" name="code">
                                </div>
                                <div class="col-sm-12">
                                    <label class="form-label">@lang('admin.icon')</label>
                                    <input type="file" class="form-control" name="image">
                                </div>

                                <div class="col-12 d-flex justify-content-end">
                                    <div class="btn-box">
                                        <button class="btn btn-primary w-100 login-btn">@lang('admin.save')</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-xxl-8 col-md-7">
                <div class="panel">
                    <div class="panel-body">
                        <table class="table table-dashed table-hover digi-dataTable all-product-table table-striped" id="allProductTable">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th class="no-sort">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="markAllProduct">
                                    </div>
                                </th>
                                <th>@lang('admin.code')</th>
                                <th>@lang('admin.lang')</th>

                            </tr>
                            </thead>
                            <tbody>
                            @if(!empty($translations[0]) && isset($translations[0]))
                                @foreach($translations as $key => $value)
                            <tr>
                                <td>
                                    <input class="form-check-input status-checkbox" type="checkbox" id="status" data-id="{{ $value['id'] }}" data-status="{{ $value['status'] }}" @if($value['status'] == 1) checked="checked" @endif>
                                </td>
                                <td>{{++$key}}</td>
                                <td>{!! $value['code'] !!}</td>
                                <td>
                                    <div class="table-category-card">
                                        <div class="part-icon">
                                             <span>
                                                 <img src="{{ asset('uploads/translations/'.$value['image']) }}">
                                             </span>
                                        </div>
                                        <div class="part-txt">
                                            <span class="category-name">{!! $value['name'] !!}</span>
                                        </div>
                                    </div>
                                </td>

                            </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                        <div class="table-bottom-control"></div>
                    </div>
                </div>
            </div>
        </div>
@endsection
@section('admin.js')
    <script src="{{ asset('admin/assets/vendor/js/jquery.uploader.min.js') }}"></script>
    <script src="{{ asset('admin/assets/vendor/js/select2.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/select2-init.js') }}"></script>
    <script src="{{ asset('admin/assets/js/category.js') }}"></script>
{{--    <script src="{{ asset('admin/assets/js/jquery.min.js') }}"></script>--}}
    <script src="{{ asset('admin/toastr/toastr.min.js') }}"></script>
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    <!-- Your script using jQuery -->
            <script>
                $(document).ready(function() {
                    function changeStat(id, status, isChecked) {
                        console.log('salamsss');
                        var token = $("meta[name='_token']").attr('content');
                        var url = '{{ url('admin/translations/status') }}/' + id;
                        console.log('salam');
                        $.ajax({
                            url: url,
                            dataType: 'json',
                            data: {
                                status: status,
                                isChecked: isChecked,
                                _token: token
                            },
                            type: 'post',
                            success: function (data) {
                                toastr.success("Məlumat yeniləndi");
                            },
                            error: function (data) {
                                toastr.error("Yenidən cəhd göstərin");
                            }
                        });
                    }

                    // Attach the event handler to each checkbox with the class 'status-checkbox'
                    $('#status').change(function() {
                        console.log('salam');
                        var id = $(this).data('id');
                        console.log(id);
                        var status = $(this).data('status');
                        var isChecked = $(this).prop('checked');
                        changeStat(id, status, isChecked);
                    });
                });
            </script>
@endsection
