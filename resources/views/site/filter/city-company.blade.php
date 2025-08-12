<div class="col-xl-4">
    <div class="sidebar_listing_grid1 dn-lg">
        <div class="sidebar_listing_list">
            <div class="sidebar_advanced_search_widget">
                <form id="filterForm">
                    <ul class="sasw_list style2 mb0">
                        <li class="search_area">
                            <div class="form-group">
                                <input type="text" class="form-control" id="search" name="search" placeholder="İstədiyin müəssisəni axtar">
                            </div>
                        </li>
                        @if(!empty($mainCategories[0]))
                            <li>
                                <div class="search_option_two">
                                    <div class="sidebar_select_options">
                                        <select class="selectpicker w100 show-tick" id="category_id" name="category_id">
                                            <option value="">Bütün kateqoriyalar</option>
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
                                                    <input type="checkbox" class="custom-control-input" id="service_type_all" name="service_type[]" value="">
                                                    <label class="custom-control-label" for="service_type_all">Bütün xidmətlər</label>
                                                </div>
                                            </li>
                                            @foreach($serviceTypes as $serviceType)
                                                <li>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input service_type_item" id="service_type{{$serviceType['id']}}" name="service_type[]" value="{{$serviceType['id']}}">
                                                        <label class="custom-control-label" for="service_type{{$serviceType['id']}}">{{$serviceType['name'][$currentLang]}}</label>
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
                                <button type="submit" id="searchButton" class="btn btn-block btn-thm mb15">Axtar</button>
{{--                                <a class="tdu fz14" href="#">Təmizlə</a>--}}
                            </div>
                        </li>
                    </ul>
                </form>
            </div>
        </div>
    </div>
</div>
