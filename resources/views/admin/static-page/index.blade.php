@extends('admin.layouts.app')
@section('admin.title')
    @lang('admin.translations')
@endsection
@section('admin.css')
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
                        <h5>@lang('admin.static_pages')</h5>
                        <div class="btn-box d-flex flex-wrap gap-2">
                            <div id="tableSearch"></div>
                            <a class="btn btn-sm btn-primary" href="{{ route('admin.static-page.create') }}">
                                <i class="fa-light fa-plus"></i> @lang('admin.add')
                            </a>
                        </div>
                    </div>
                    <div class="panel-body">
                        <table class="table table-dashed table-hover digi-dataTable task-table table-striped" id="taskTable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>@lang('admin.title')</th>
                                    <th>@lang('admin.type')</th>
                                    <th>@lang('admin.settings')</th>
                                </tr>
                            </thead>
                            <tbody>
                            @if(!empty($static_pages[0]) && isset($static_pages[0]))
                                @foreach($static_pages as $data)
                                    <tr>
                                        <td>{{ $data['id'] }}</td>
                                        <td>{{ $data['type'] }}</td>
                                        <td>{{ $data['title']['az'] }}</td>
                                        <td>
                                            <div class="btn-box">
                                                <a href="{{ route('admin.static-page.edit',$data['id']) }}" class="btn btn-sm btn-icon btn-primary" title="@lang('admin.edit')">
                                                    <i class="fa-light fa-edit"></i>
                                                </a>
                                                <button class="btn btn-sm btn-icon btn-danger" data-bs-toggle="modal" data-bs-target="#delete{{$data['id']}}">
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
    @if(!empty($static_pages[0]) && isset($static_pages[0]))
        @foreach($static_pages as $value)
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
                        <form action="{{ route('admin.static-page.destroy',$value['id']) }}" method="POST">
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
@endsection

