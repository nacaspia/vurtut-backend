  <div class="main-content">
        <div class="dashboard-breadcrumb mb-25">
            <h2>@lang('admin.categories')</h2>
        </div>
        @if ( Session::get('error'))
            <div class="col-12 mt-1">
                <div class="alert alert-danger" role="alert">
                    <div class="alert-body">{{ Session::get('error') }}</div>
                </div>
            </div>
        @endif
        @if (Session::get('success'))
            <div class="col-12 mt-1">
                <div class="alert alert-success" role="alert">
                    <div class="alert-body">{{ Session::get('success') }}</div>
                </div>
            </div>
        @endif
        <div class="row g-4">
            <div class="col-xxl-4 col-md-5">
                <div class="panel">
                    <div class="panel-header">
                        <h5>@lang('admin.add')</h5>
                    </div>
                    <div class="panel-body">
                        <form action="{{ route('admin.category.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <ul class="nav nav-pills nav-justified" role="tablist">
                                @if(!empty($locales))
                                    @foreach($locales as $key => $lang)
                                        <li class="nav-item waves-effect waves-light">
                                            <a class="nav-link @if(++$key ==1) active @endif" data-bs-toggle="tab" href="#{{$lang->code}}" role="tab">
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
                                        <div class="tab-pane @if(++$key ==1) active @endif" id="{{$lang['code']}}" role="tabpanel">
                                            <div class="row g-3">
                                                <div class="col-12">
                                                    <label class="form-label">@lang('admin.title')- {{$lang['code']}}</label>
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
                                    </div>
                                </div>
                            </div>
                            <div class="row g-3">
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
                        <table class="table table-dashed table-hover digi-dataTable all-product-table table-striped"
                               id="allProductTable">
                            <thead>
                            <tr>


                                <th class="no-sort">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="markAllProduct">
                                    </div>
                                </th>
                                <th>#</th>
                                <th>@lang('admin.type')</th>
                                <th>@lang('admin.title')</th>
                                <th>@lang('admin.settings')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(!empty($categories[0]) && isset($categories[0]))
                                @foreach($categories as $key => $value)
                                    <tr>
                                        <td>
                                            <input class="form-check-input status-checkbox" type="checkbox" id="status"
                                                   data-id="{{ $value['id'] }}" data-status="{{ $value['status'] }}"
                                                   @if($value['status'] == 1) checked="checked" @endif>
                                        </td>
                                        <td>{{++$key}}</td>
                                        <td>{!! $value['type'] !!}</td>
                                        <td>
                                            <div class="table-category-card">
                                                @if(!empty($value['image']))

                                                    <div class="part-icon">
                                                     <span>
                                                         <img src="{{ asset('uploads/categories/'.$value['image']) }}">
                                                     </span>
                                                    </div>
                                                @endif
                                                <div class="part-txt">
                                                    <span class="category-name">{!! $value['title']['az'] !!}</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="btn-box">
                                                <button class="btn btn-sm btn-icon btn-primary" data-bs-toggle="modal" data-bs-target="#editTaskModal"><i class="fa-light fa-edit"></i></button>
                                                <button class="btn btn-sm btn-icon btn-danger"><i class="fa-light fa-trash-can"></i></button>
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
        <!-- edit task modal -->
        <div class="modal fade" id="editTaskModal" tabindex="-1" aria-labelledby="editTaskModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="modal-title" id="editTaskModalLabel">@lang('admin.edit')</h2>
                        <button type="button" class="btn btn-sm btn-icon btn-outline-primary" data-bs-dismiss="modal" aria-label="Close"><i class="fa-light fa-times"></i></button>
                    </div>
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-12">
                                <label for="editTaskName" class="form-label">Name</label>
                                <input type="text" id="editTaskName" class="form-control form-control-sm" placeholder="Task Name" value="Web Design & Development">
                            </div>
                            <div class="col-12">
                                <label for="editTaskAttchment" class="form-label">Attach File</label>
                                <input type="file" id="editTaskAttchment" class="form-control form-control-sm" multiple>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-sm btn-primary">Save Changes</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- edit task modal -->
