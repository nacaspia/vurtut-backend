<div class="row">
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
                                        <input type="text" class="form-control" id="search" name="search" placeholder="İstədiyin müəssisəni axtar">
                                    </div>
                                </li>
                                @if($slug == 'premium' && !empty($cities[0]))
                                    <li>
                                        <div class="search_option_two">
                                            <div class="sidebar_select_options">
                                                <select class="selectpicker w100 show-tick" id="mobile_city_id" name="mobile_city_id">
                                                    <option value="">Bütün şəhərlər</option>
                                                    @foreach($cities as $city)
                                                        <option value="{{ $city['id'] }}">{{$city['name'][$currentLang]}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="search_option_two">
                                            <div class="sidebar_select_options">
                                                <select class="selectpicker w100 show-tick" id="mobile_sub_region_id" name="mobile_sub_region_id">
                                                    <option value="">Daha yaxın ərazi</option>
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
                                        <button type="submit" id="searchMobileButton"  class="btn btn-block btn-thm mb15">Axtar</button>
                                        {{--                                        <a class="tdu fz14" href="#">Təmizlə</a>--}}
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
        <div class="breadcrumb_content style2 mb0-991">
            <h2 class="breadcrumb_title">{{ $title }}</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('site.index') }}">@lang('site.home')</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
            </ol>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="dn db-lg mt30 mb0 tac-767">
            <div id="main2">
                 <div id="main2" class="d-flex justify-content-center">
                <button class="filter_open_btn style2" style="outline:none;border:none; display:flex; align-items:center; justify-content: center; gap: 5px;"><i class="fa-solid fa-filter"></i>Axtarış</button>

            </div>
            </div>
        </div>
    </div>
</div>
