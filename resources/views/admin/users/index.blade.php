@extends('admin.layouts.app')
@section('admin.title')
    @lang('admin.users')
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
                        <h5>@lang('admin.users')</h5>
                        <div class="btn-box d-flex flex-wrap gap-2">
                            <div id="tableSearch"></div>

                            <button class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#addTaskModal"><i class="fa-light fa-plus"></i> @lang('admin.add')
                            </button>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="table-filter-option">
                            <div class="row g-3">
                                <div class="col-xl-10 col-md-10 col-9 col-xs-12">
                                    <div class="row g-3">
                                        <div class="col">
                                            <form action="?" method="get" class="row g-2">
                                                @csrf
                                                <div class="col">
                                                    <select class="form-control form-control-sm" name="status" data-placeholder="@lang('admin.status') @lang('admin.choose')">
                                                        <option value="" >@lang('admin.choose')</option>
                                                        <option value="active" @if(!empty($_GET['status']) && $_GET['status'] == 'active') selected="selected" @endif>@lang('admin.active')</option>
                                                        <option value="nonactive" @if(!empty($_GET['status']) && $_GET['status'] == 'nonactive') selected="selected" @endif>@lang('admin.nonactive')</option>
                                                    </select>
                                                </div>
                                                <div class="col">
                                                    <button class="btn btn-sm btn-primary w-100" name="filter" value="1">@lang('admin.filter')</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-2 col-md-2 col-3 col-xs-12 d-flex justify-content-end">
                                    <div id="employeeTableLength"></div>
                                </div>
                            </div>
                        </div>
                        <table class="table table-dashed table-hover digi-dataTable task-table table-striped"
                               id="taskTable">
                            <thead>
                            <tr>
                                <th class="no-sort">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="markAllLeads">
                                    </div>
                                </th>
                                <th>#</th>
                                <th>@lang('admin.user')</th>
                                <th>@lang('admin.phone')</th>
                                <th>@lang('admin.email')</th>
                                <th>@lang('admin.settings')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(!empty($users[0]) && isset($users[0]))
                                @foreach($users as $data)
                                    <tr>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="status"
                                                       data-id="{{ $data['id'] }}" data-status="{{ $data['status'] }}"
                                                       @if($data['status'] == 1) checked="checked" @endif >
                                            </div>
                                        </td>
                                        <td>{{ $data['id'] }}</td>
                                        <td>
                                            <div class="table-category-card">
                                                <div class="part-icon">
                                                 <span>
                                                     <img src="{{ !empty($data['image'])? asset('uploads/user/'.$data['image']): asset('admin/avatar/avatar.png') }}">
                                                 </span>
                                                </div>
                                                <div class="part-txt">
                                                    <span class="category-name">{!! $data['full_name'] !!}</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>{!! $data['phone'] !!}</td>
                                        <td>{!! $data['email'] !!}</td>
                                        <td>
                                            <div class="btn-box">
                                                <a href="{{ route('admin.users.logs',$data['id']) }}"
                                                   class="btn btn-sm btn-icon btn-primary"
                                                   title="@lang('admin.logs')"><i
                                                        class="fa-light fa-lock"></i>
                                                </a>
                                                <a href="{{ route('admin.users.edit',$data['id']) }}" class="btn btn-sm btn-icon btn-primary" title="@lang('admin.edit')"><i
                                                        class="fa-light fa-edit"></i>
                                                </a>

                                                <button class="btn btn-sm btn-icon btn-danger" data-bs-toggle="modal" data-bs-target="#deletecategory{{$data['id']}}" title="@lang('admin.delete')">
                                                    <i class="fa-light fa-trash-can"></i>
                                                </button>
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
    </div>
    <!-- main content end -->
    @if(!empty($users[0]) && isset($users[0]))
        @foreach($users as $value)
            <div class="modal fade" id="deletecategory{{$value['id']}}" tabindex="-1"
                     aria-labelledby="deletecategory{{$value['id']}}Label" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h2 class="modal-title" id="deletecategory{{$value['id']}}Label">@lang('admin.delete')</h2>
                                <button type="button" class="btn btn-sm btn-icon btn-outline-primary"
                                        data-bs-dismiss="modal" aria-label="Close"><i class="fa-light fa-times"></i>
                                </button>
                            </div>
                            <form action="{{ route('admin.users.destroy',$value['id']) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <div class="modal-body">
                                    <h2>@lang('admin.delete_about')</h2>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-sm btn-secondary"
                                            data-bs-dismiss="modal">@lang('admin.not')</button>
                                    <button type="submit" class="btn btn-sm btn-primary">@lang('admin.yes')</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
        @endforeach
    @endif
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

