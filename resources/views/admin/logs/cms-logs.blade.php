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
    <!-- main content start -->
    <div class="main-content">
        @include('components.admin.error')
        <div class="row">
            <div class="col-12">
                <div class="panel">

                    <div class="panel-header">
                        <h5>@lang('admin.logs')</h5>
                        <div class="btn-box d-flex flex-wrap gap-2">
                            <div id="tableSearch"></div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <table class="table table-dashed table-hover digi-dataTable task-table table-striped"
                               id="taskTable">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>@lang('admin.table')</th>
                                <th>@lang('admin.action')</th>
                                <th>@lang('admin.note')</th>
                                <th>@lang('admin.datetime')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(!empty($logs[0]) && isset($logs[0]))
                                @foreach($logs as $data)
                                    <tr>
                                        <td>{{ $data['id'] }}</td>
                                        <td>
                                            <div class="table-category-card">
                                                <div class="part-txt">
                                                    <span
                                                        class="category-name">{!! $data['subj_table'] !!}</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>{!! $data['action'] !!}</td>
                                        <td>{!! $data['note']['az'] !!}</td>
                                        <td>{!! $data['created_at'] !!}</td>
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
        $(document).ready(function () {
            function toggleStatus(id, status) {
                console.log('salamsss');
                var token = $("meta[name='_token']").attr('content');
                var url = '{{ url("admin/category/status") }}/' + id;
                console.log('salam');
                $.ajax({
                    url: url,
                    dataType: 'json',
                    data: {
                        status: status,
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

            // Attach the event handler to the checkbox with the id 'status'
            $('#status').click(function () {
                console.log('salam');
                var id = $(this).data('id');
                console.log(id);
                var status = $(this).data('status');

                // Toggle the status (assuming 0 and 1 are the possible values)
                var newStatus = (status === 1) ? 0 : 1;

                // Update the data-status attribute
                $(this).data('status', newStatus);

                // Perform the AJAX call
                toggleStatus(id, newStatus);
            });
        });
    </script>

@endsection

