<div class="row">
    <div class="col-lg-12">
        <div class="breadcrumb_content style2 mb0-991">
            <h2 class="breadcrumb_title">{{ $city['name'][$currentLang] }}</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('site.index') }}">@lang('site.home')</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $city['name'][$currentLang] }}</li>
            </ol>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="listing_sidebar dn db-lg">
            <div class="sidebar_content_details style3">
                <!-- <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a> -->
                <div class="sidebar_listing_list style2 mobile_sytle_sidebar mb0">
                    <div class="sidebar_advanced_search_widget">
                        <h4 class="mb25">Ətraflı axtarış
                            <a class="filter_closed_btn float-right" href="#">
                                <small>Bağla</small>
                                <span class="flaticon-close"></span>
                            </a>
                        </h4>
                        <form id="mobileFilterForm">
                            <ul class="sasw_list style2 mb0">
                                <li class="search_area">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="search" name="search" placeholder="İstədiyin müəssəni axtar...">
                                    </div>
                                </li>
                                @if(!empty($mainCategories[0]))
                                    <li>
                                        <div class="search_option_two">
                                            <div class="sidebar_select_options">
                                                <select class="selectpicker w100 show-tick" id="category_id" name="category_id">
                                                    <option value="">Bütün kateqoryalar</option>
                                                    @foreach($mainCategories as $mainCategory)
                                                        <option value="{{ $mainCategory['id'] }}">{{$mainCategory['title'][$currentLang]}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </li>
                                @endif
                                @if(!empty($subRegions))
                                    <li>
                                        <div class="search_option_two">
                                            <div class="sidebar_select_options">
                                                <select class="selectpicker w100 show-tick" id="sub_region_id" name="sub_region_id">
                                                    <option value="">Daha yaxın ərazi</option>
                                                    @foreach($subRegions as $subRegion)
                                                        <option value="{{ $subRegion['id'] }}">{{$subRegion['name'][$currentLang]}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </li>
                                @endif
                                @if(!empty($serviceTypes[0]))
                                    <li>
                                        <div class="ui_kit_checkbox sidebar_tag">
                                            <h4 class="title">Əlavə xidmətlər</h4>
                                            <div class="wrapper">
                                                <ul>
                                                    <li>
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input" id="service_type_all_mobile" name="service_type[]" value="">
                                                            <label class="custom-control-label" for="service_type_all_mobile">Bütün xidmətlər</label>
                                                        </div>
                                                    </li>
                                                    @foreach($serviceTypes as $serviceType)
                                                        <li>
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input service_type_item" id="service_type_mobile{{$serviceType['id']}}" name="service_type[]" value="{{$serviceType['id']}}">
                                                                <label class="custom-control-label" for="service_type_mobile{{$serviceType['id']}}">{{$serviceType['name'][$currentLang]}}</label>
                                                            </div>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </li>
                                @endif
                                <li>
                                    <div class="search_option_button text-center mt25">
                                        <button type="submit" class="btn btn-block btn-thm mb15">Axtar</button>
                                        <a class="tdu fz14" href="#">Təmizlə</a>
                                    </div>
                                </li>
                            </ul>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="dn db-lg mt30 mb0 tac-767">
            <div id="main2">
                <span id="open2" class="fa fa-filter filter_open_btn style2"> Axtarış</span>
            </div>
        </div>
    </div>
</div>
