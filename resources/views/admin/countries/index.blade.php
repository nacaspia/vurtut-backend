@extends('admin.layouts.app')
@section('admin.title')
    @lang('admin.categories')
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
                        <h5>@lang('admin.countries')</h5>
                        <div class="btn-box d-flex flex-wrap gap-2">
                            <div id="tableSearch"></div>
                            <button class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#addTaskModal"><i class="fa-light fa-plus"></i> @lang('admin.add')
                            </button>
                        </div>
                    </div>
                    <div class="panel-body">
                        <table class="table table-dashed table-hover digi-dataTable task-table table-striped"
                               id="taskTable">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>@lang('admin.name')</th>
                                <th>@lang('admin.settings')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(!empty($countries[0]) && isset($countries[0]))
                                @foreach($countries as $data)
                                    <tr>
                                        <td>{{ $data['id'] }}</td>
                                        <td>
                                            <div class="table-category-card">
                                                <div class="part-txt">
                                                    <span class="category-name">{!! $data['name']['az'] !!}</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="btn-box">

                                                <button class="btn btn-sm btn-icon btn-primary" data-bs-toggle="modal"
                                                        data-bs-target="#editTaskModal{{$data['id']}}"><i
                                                        class="fa-light fa-edit"></i>
                                                </button>

                                                <button class="btn btn-sm btn-icon btn-danger" data-bs-toggle="modal"
                                                        data-bs-target="#deletecategory{{$data['id']}}"><i
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

    <!-- add new task modal -->
    <div class="modal fade" id="addTaskModal" tabindex="-1" aria-labelledby="addTaskModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title" id="addTaskModalLabel">@lang('admin.add')</h2>
                    <button type="button" class="btn btn-sm btn-icon btn-outline-primary" data-bs-dismiss="modal"
                            aria-label="Close"><i class="fa-light fa-times"></i></button>
                </div>
                <form action="{{ route('admin.country.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <ul class="nav nav-pills nav-justified" role="tablist">
                            @if(!empty($locales))
                                @foreach($locales as $key => $lang)
                                    <li class="nav-item waves-effect waves-light">
                                        <a class="nav-link @if(++$key ==1) active @endif" data-bs-toggle="tab"
                                           href="#{{$lang->code}}" role="tab">
                                            <span class="d-none d-sm-block">{{$lang->code}}</span>
                                        </a>
                                    </li>
                                @endforeach
                            @endif
                            <li class="nav-item waves-effect waves-light">
                                <a class="nav-link" data-bs-toggle="tab"
                                   href="#other" role="tab">
                                    <span class="d-none d-sm-block">@lang('admin.other')</span>
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content p-3 text-muted">
                            @if(!empty($locales))
                                @foreach($locales as $key => $lang)
                                    <div class="tab-pane @if(++$key ==1) active @endif" id="{{$lang['code']}}"
                                         role="tabpanel">
                                        <div class="row g-3">
                                            <div class="col-12">
                                                <label class="form-label">@lang('admin.name')- {{$lang['code']}}</label>
                                                <input type="text" class="form-control" name="name[{{$lang['code']}}]">
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                            <div class="tab-pane" id="other" role="tabpanel">
                                <div class="row g-3">
                                    <div class="col-sm-12">
                                        <label class="form-label">@lang('admin.status')</label>
                                        <select class="form-control" name="status">
                                            <option value="1">@lang('admin.active')</option>
                                            <option value="0">@lang('admin.nonactive')</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">@lang('admin.close')</button>
                        <button type="submit" class="btn btn-sm btn-primary">@lang('admin.save')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- add new task modal -->

    @if(!empty($countries[0]) && isset($countries[0]))
        @foreach($countries as $value)
            <!-- edit task modal -->

            <!-- edit task modal -->
            <!-- edit task modal -->
            <div class="modal fade" id="editTaskModal{{$value['id']}}" tabindex="-1"
                 aria-labelledby="editTaskModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <form action="{{ route('admin.country.update',$value['id']) }}" method="POST"
                              enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="modal-body">
                                <ul class="nav nav-pills nav-justified" role="tablist">
                                    @if(!empty($locales))
                                        @foreach($locales as $key => $lang)
                                            <li class="nav-item waves-effect waves-light">
                                                <a class="nav-link @if(++$key ==1) active @endif" data-bs-toggle="tab"
                                                   href="#edit{{$value['id']}}{{$lang->code}}" role="tab">
                                                    <span class="d-none d-sm-block">{{$lang->code}}</span>
                                                </a>
                                            </li>
                                        @endforeach
                                    @endif
                                    <li class="nav-item waves-effect waves-light">
                                        <a class="nav-link" data-bs-toggle="tab"
                                           href="#editother{{$value['id']}}" role="tab">
                                            <span class="d-none d-sm-block">@lang('admin.other')</span>
                                        </a>
                                    </li>
                                </ul>
                                <div class="tab-content p-3 text-muted">
                                    @if(!empty($locales))
                                        @foreach($locales as $key => $lang)
                                            <div class="tab-pane @if(++$key ==1) active @endif"
                                                 id="edit{{$value['id']}}{{$lang['code']}}" role="tabpanel">
                                                <div class="row g-3">
                                                    <div class="col-12">
                                                        <label class="form-label">@lang('admin.title')- {{$lang['code']}}</label>
                                                        <input type="text" class="form-control" name="name[{{$lang['code']}}]" value="{{ !empty($value['name'][$lang['code']])? $value['name'][$lang['code']]: NULL }}">
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                    <div class="tab-pane" id="editother{{$value['id']}}" role="tabpanel">
                                        <div class="row g-3">
                                            <div class="col-sm-12">
                                                <label class="form-label">@lang('admin.status')</label>
                                                <select class="form-control" name="status">
                                                    <option value="1" @if($value['status'] == 1) selected @endif>@lang('admin.active')</option>
                                                    <option value="0" @if($value['status'] == 0) selected @endif>@lang('admin.nonactive')</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">@lang('admin.close')</button>
                                <button type="submit" class="btn btn-sm btn-primary">@lang('admin.save')</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- edit task modal -->
            <div class="modal fade" id="deletecategory{{$value['id']}}" tabindex="-1"
                 aria-labelledby="deletecategory{{$value['id']}}Label" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h2 class="modal-title" id="deletecategory{{$value['id']}}Label">@lang('admin.delete')</h2>
                            <button type="button" class="btn btn-sm btn-icon btn-outline-primary" data-bs-dismiss="modal" aria-label="Close"><i class="fa-light fa-times"></i></button>
                        </div>
                        <form action="{{ route('admin.country.destroy',$value['id']) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <div class="modal-body">
                                <h2>@lang('admin.delete_about')</h2>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">@lang('admin.not')</button>
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
@endsection

