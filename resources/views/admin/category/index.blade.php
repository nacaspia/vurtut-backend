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
                        <h5>@lang('admin.categories')</h5>
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
                                <th>@lang('admin.title')</th>
                                <th>@lang('admin.settings')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(!empty($categories[0]) && isset($categories[0]))
                                @foreach($categories as $data)
                                    <tr>
                                        <td>{{ $data['id'] }}</td>
                                        <td>
                                            <div class="table-category-card">
                                                @if(!empty($data['image']))

                                                    <div class="part-icon">
                                                     <span>
                                                         <img src="{{ asset('uploads/categories/'.$data['image']) }}">
                                                     </span>
                                                    </div>
                                                @endif
                                                <div class="part-txt">
                                                    <span class="category-name">{!! $data['title']['az'] !!}</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="btn-box">
                                                @if(!empty($data['parentcategories'][0]) && isset($data['parentcategories'][0]))
                                                <button class="btn btn-sm btn-icon btn-primary" data-bs-toggle="modal"
                                                        data-bs-target="#eyeTaskModal{{$data['id']}}"><i
                                                        class="fa-light fa-eye"></i>
                                                </button>
                                                @endif
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
                <form action="{{ route('admin.category.store') }}" method="POST" enctype="multipart/form-data">
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
                                                <label class="form-label">@lang('admin.title')
                                                    - {{$lang['code']}}</label>
                                                <input type="text" class="form-control" name="title[{{$lang['code']}}]">
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                            <div class="tab-pane" id="other" role="tabpanel">
                                <div class="row g-3">
                                    <div class="col-sm-12">
                                        <label class="form-label">@lang('admin.icon')</label>
                                        <input type="file" class="form-control" name="image">
                                    </div>
                                    <div class="col-sm-12">
                                        <label class="form-label">@lang('admin.main_categories')</label>
                                        <select class="form-control" name="parent_id">
                                            <option></option>
                                            @if(!empty($categories[0]) && isset($categories[0]))
                                                @foreach($categories as $data)
                                                    <option value="{!! $data['id'] !!}">{!! $data['title']['az'] !!}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <div class="col-sm-12">
                                        <label class="form-label">@lang('admin.main_categories')</label>
                                        <select class="form-control" name="sub_category_id">
                                            <option value="">-Sec</option>
                                            @if(!empty($parentCategories[0]) && isset($parentCategories[0]))
                                                @foreach($parentCategories as $dataParent)
                                                    <option value="{!! $dataParent['id'] !!}">{!! $dataParent['title']['az'] !!}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
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
                        <button type="button" class="btn btn-sm btn-secondary"
                                data-bs-dismiss="modal">@lang('admin.close')</button>
                        <button type="submit" class="btn btn-sm btn-primary">@lang('admin.save')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- add new task modal -->

    @if(!empty($categories[0]) && isset($categories[0]))
        @foreach($categories as $value)
            @if(empty($value['parent_id']))
            <!-- edit task modal -->
            <div class="modal fade" id="eyeTaskModal{{$value['id']}}" tabindex="-1"
                 aria-labelledby="eyeTaskModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
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
                                <th>@lang('admin.title')</th>
                                <th>@lang('admin.settings')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(!empty($value['parentcategories'][0]) && isset($value['parentcategories'][0]))
                                @foreach($value['parentcategories'] as $parentcategory)
                                    <tr>
                                        <td>{{ $parentcategory['id'] }}</td>
                                        <td>
                                            <div class="table-category-card">
                                                @if(!empty($parentcategory['image']))

                                                    <div class="part-icon">
                                                     <span>
                                                         <img src="{{ asset('uploads/categories/'.$parentcategory['image']) }}">
                                                     </span>
                                                    </div>
                                                @endif
                                                <div class="part-txt">
                                                    <span class="category-name">{!! $parentcategory['title']['az'] !!}</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="btn-box">
                                                @if(!empty($parentcategory['subcategories'][0]) && isset($parentcategory['subcategories'][0]))
                                                    <button class="btn btn-sm btn-icon btn-primary" data-bs-toggle="modal"
                                                            data-bs-target="#eyeSubCatModal{{$parentcategory['id']}}"><i
                                                            class="fa-light fa-eye"></i>
                                                    </button>
                                                @endif
                                                <button class="btn btn-sm btn-icon btn-primary" data-bs-toggle="modal"
                                                        data-bs-target="#editTaskModal{{$parentcategory['id']}}"><i
                                                        class="fa-light fa-edit"></i>
                                                </button>

                                                <button class="btn btn-sm btn-icon btn-danger" data-bs-toggle="modal"
                                                        data-bs-target="#deletecategory{{$parentcategory['id']}}"><i
                                                        class="fa-light fa-trash-can"></i></button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- edit task modal -->
            <!-- edit task modal -->
            <div class="modal fade" id="editTaskModal{{$value['id']}}" tabindex="-1"
                 aria-labelledby="editTaskModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <form action="{{ route('admin.category.update',$value['id']) }}" method="POST"
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
                                                        <label class="form-label">@lang('admin.title')
                                                            - {{$lang['code']}}</label>
                                                        <input type="text" class="form-control"
                                                               name="title[{{$lang['code']}}]"
                                                               value="{{ !empty($value['title'][$lang['code']])? $value['title'][$lang['code']]: NULL }}">
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                    <div class="tab-pane" id="editother{{$value['id']}}" role="tabpanel">
                                        <div class="row g-3">
                                            <div class="col-sm-12">
                                                <label class="form-label">@lang('admin.icon')</label>
                                                <input type="file" class="form-control" name="image">
                                            </div>

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
                                <button type="button" class="btn btn-sm btn-secondary"
                                        data-bs-dismiss="modal">@lang('admin.close')</button>
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
                            <button type="button" class="btn btn-sm btn-icon btn-outline-primary"
                                    data-bs-dismiss="modal" aria-label="Close"><i class="fa-light fa-times"></i>
                            </button>
                        </div>
                        <form action="{{ route('admin.category.destroy',$value['id']) }}" method="POST">
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
            @endif
            @if(!empty($value['parentcategories'][0]) && isset($value['parentcategories'][0]))
                @foreach($value['parentcategories'] as $parentcategoryvalue)
                    <div class="modal fade" id="editTaskModal{{$parentcategoryvalue['id']}}" tabindex="-1"
                         aria-labelledby="editTaskModalLabel"
                         aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content">
                                <form action="{{ route('admin.category.update',$parentcategoryvalue['id']) }}" method="POST"
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
                                                   href="#editother{{$parentcategoryvalue['id']}}" role="tab">
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
                                                                <label class="form-label">@lang('admin.title')
                                                                    - {{$lang['code']}}</label>
                                                                <input type="text" class="form-control"
                                                                       name="title[{{$lang['code']}}]"
                                                                       value="{{ !empty($parentcategoryvalue['title'][$lang['code']])? $parentcategoryvalue['title'][$lang['code']]: NULL }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @endif
                                            <div class="tab-pane" id="editother{{$parentcategoryvalue['id']}}" role="tabpanel">
                                                <div class="row g-3">
                                                    <div class="col-sm-12">
                                                        <label class="form-label">@lang('admin.icon')</label>
                                                        <input type="file" class="form-control" name="image">
                                                    </div>

                                                    <div class="col-sm-12">
                                                        <label class="form-label">@lang('admin.status')</label>
                                                        <select class="form-control" name="status">
                                                            <option value="1" @if($parentcategoryvalue['status'] == 1) selected @endif>@lang('admin.active')</option>
                                                            <option value="0" @if($parentcategoryvalue['status'] == 0) selected @endif>@lang('admin.nonactive')</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-sm btn-secondary"
                                                data-bs-dismiss="modal">@lang('admin.close')</button>
                                        <button type="submit" class="btn btn-sm btn-primary">@lang('admin.save')</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- edit task modal -->
                    <div class="modal fade" id="deletecategory{{$parentcategoryvalue['id']}}" tabindex="-1"
                         aria-labelledby="deletecategory{{$parentcategoryvalue['id']}}Label" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h2 class="modal-title" id="deletecategory{{$parentcategoryvalue['id']}}Label">@lang('admin.delete')</h2>
                                    <button type="button" class="btn btn-sm btn-icon btn-outline-primary"
                                            data-bs-dismiss="modal" aria-label="Close"><i class="fa-light fa-times"></i>
                                    </button>
                                </div>
                                <form action="{{ route('admin.category.destroy',$parentcategoryvalue['id']) }}" method="POST">
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


                    <div class="modal fade" id="eyeSubCatModal{{$parentcategoryvalue['id']}}" tabindex="-1"
                         aria-labelledby="eyeTaskModalLabel"
                         aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content">
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
                                        <th>@lang('admin.title')</th>
                                        <th>@lang('admin.settings')</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(!empty($parentcategoryvalue['subcategories'][0]) && isset($parentcategoryvalue['subcategories'][0]))
                                        @foreach($parentcategoryvalue['subcategories'] as $subcategories)
                                            <tr>
                                                <td>{{ $subcategories['id'] }}</td>
                                                <td>
                                                    <div class="table-category-card">
                                                        @if(!empty($subcategories['image']))

                                                            <div class="part-icon">
                                                     <span>
                                                         <img src="{{ asset('uploads/categories/'.$subcategories['image']) }}">
                                                     </span>
                                                            </div>
                                                        @endif
                                                        <div class="part-txt">
                                                            <span class="category-name">{!! $subcategories['title']['az'] !!}</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="btn-box">
                                                            <button class="btn btn-sm btn-icon btn-primary" data-bs-toggle="modal"
                                                                    data-bs-target="#editSubCatModal{{$subcategories['id']}}"><i
                                                                    class="fa-light fa-edit"></i>
                                                            </button>

                                                            <button class="btn btn-sm btn-icon btn-danger" data-bs-toggle="modal"
                                                                    data-bs-target="#deleteSubCatModal{{$subcategories['id']}}"><i
                                                                    class="fa-light fa-trash-can"></i></button>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    @if(!empty($parentcategoryvalue['subcategories'][0]) && isset($parentcategoryvalue['subcategories'][0]))
                        @foreach($parentcategoryvalue['subcategories'] as $subcategories)



                            <div class="modal fade" id="editSubCatModal{{$subcategories['id']}}" tabindex="-1"
                                 aria-labelledby="editSubLabel"
                                 aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-lg">
                                    <div class="modal-content">
                                        <form action="{{ route('admin.category.update',$subcategories['id']) }}" method="POST"
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
                                                           href="#editother{{$subcategories['id']}}" role="tab">
                                                            <span class="d-none d-sm-block">@lang('admin.other')</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                                <div class="tab-content p-3 text-muted">
                                                    @if(!empty($locales))
                                                        @foreach($locales as $key => $lang)
                                                            <div class="tab-pane @if(++$key ==1) active @endif"
                                                                 id="edit{{$lang['id']}}{{$lang['code']}}" role="tabpanel">
                                                                <div class="row g-3">
                                                                    <div class="col-12">
                                                                        <label class="form-label">@lang('admin.title')
                                                                            - {{$lang['code']}}</label>
                                                                        <input type="text" class="form-control"
                                                                               name="title[{{$lang['code']}}]"
                                                                               value="{{ !empty($subcategories['title'][$lang['code']])? $subcategories['title'][$lang['code']]: NULL }}">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    @endif
                                                    <div class="tab-pane" id="editother{{$subcategories['id']}}" role="tabpanel">
                                                        <div class="row g-3">
                                                            <div class="col-sm-12">
                                                                <label class="form-label">@lang('admin.icon')</label>
                                                                <input type="file" class="form-control" name="image">
                                                            </div>

                                                            <div class="col-sm-12">
                                                                <label class="form-label">@lang('admin.status')</label>
                                                                <select class="form-control" name="status">
                                                                    <option value="1" @if($subcategories['status'] == 1) selected @endif>@lang('admin.active')</option>
                                                                    <option value="0" @if($subcategories['status'] == 0) selected @endif>@lang('admin.nonactive')</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-sm btn-secondary"
                                                        data-bs-dismiss="modal">@lang('admin.close')</button>
                                                <button type="submit" class="btn btn-sm btn-primary">@lang('admin.save')</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- edit task modal -->
                            <div class="modal fade" id="deleteSubCat{{$parentcategoryvalue['id']}}" tabindex="-1"
                                 aria-labelledby="deleteSubCat{{$subcategories['id']}}Label" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h2 class="modal-title" id="deleteSubCat{{$subcategories['id']}}Label">@lang('admin.delete')</h2>
                                            <button type="button" class="btn btn-sm btn-icon btn-outline-primary"
                                                    data-bs-dismiss="modal" aria-label="Close"><i class="fa-light fa-times"></i>
                                            </button>
                                        </div>
                                        <form action="{{ route('admin.category.destroy',$subcategories['id']) }}" method="POST">
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


                @endforeach
            @endif
        @endforeach
    @endif

@endsection

@section('admin.js')
    <script src="{{ asset('admin/assets/vendor/js/jquery.uploader.min.js') }}"></script>
    <script src="{{ asset('admin/assets/vendor/js/select2.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/select2-init.js') }}"></script>
    <script src="{{ asset('admin/assets/js/category.js') }}"></script>
@endsection

