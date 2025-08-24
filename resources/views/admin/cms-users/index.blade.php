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
                        <h5>@lang('admin.cms_users')</h5>
                        <div class="btn-box d-flex flex-wrap gap-2">
                            <div id="tableSearch"></div>

                            <a class="btn btn-sm btn-primary" href="{{ route('admin.cms-users.create') }}"><i
                                    class="fa-light fa-plus"></i> @lang('admin.add')
                            </a>
                        </div>
                    </div>
                    <div class="panel-body">
                        <table class="table table-dashed table-hover digi-dataTable task-table table-striped"
                               id="taskTable">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>@lang('admin.full_name')</th>
                                <th>@lang('admin.role')</th>
                                <th>@lang('admin.phone')</th>
                                <th>@lang('admin.email')</th>
                                <th>@lang('admin.settings')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(!empty($cms_users[0]) && isset($cms_users[0]))
                                @foreach($cms_users as $data)
                                    <tr>
                                        <td>{{ $data['id'] }}</td>
                                        <td>
                                            <div class="table-category-card">
                                                <div class="part-txt">
                                                    <span
                                                        class="category-name">{!! $data['name'] !!} {!! $data['surname'] !!} {!! $data['father_name'] !!}</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>{!! $data['type'] !!}</td>
                                        <td>{!! $data['phone'] !!}</td>
                                        <td>{!! $data['email'] !!}</td>
                                        <td>
                                            <div class="btn-box">
                                                <a href="{{ route('admin.cms-users.logs',$data['id']) }}"
                                                   class="btn btn-sm btn-icon btn-primary"
                                                   title="@lang('admin.logs')"><i
                                                        class="fa-light fa-lock"></i>
                                                </a>
                                                <a href="{{ route('admin.cms-users.edit',$data['id']) }}"
                                                   class="btn btn-sm btn-icon btn-primary"
                                                   title="@lang('admin.edit')"><i
                                                        class="fa-light fa-edit"></i>
                                                </a>

                                                <button class="btn btn-sm btn-icon btn-danger" data-bs-toggle="modal"
                                                        data-bs-target="#delete{{$data['id']}}"><i
                                                        class="fa-light fa-trash-can"></i></button>
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
    @if(!empty($cms_users[0]) && isset($cms_users[0]))
        @foreach($cms_users as $value)
            <div class="modal fade" id="delete{{$value['id']}}" tabindex="-1"
                 aria-labelledby="deletecategory{{$value['id']}}Label" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h2 class="modal-title" id="deletecategory{{$value['id']}}Label">@lang('admin.delete')</h2>
                            <button type="button" class="btn btn-sm btn-icon btn-outline-primary"
                                    data-bs-dismiss="modal" aria-label="Close"><i class="fa-light fa-times"></i>
                            </button>
                        </div>
                        <form action="{{ route('admin.cms-users.destroy',$value['id']) }}" method="POST">
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

