<header class="header-nav menu_style_home_one @if(Route::currentRouteName() !== 'site.index')  style2 @endif navbar-scrolltofixed stricky main-menu">
    <div class="container-fluid p0">
        <nav>
            <div class="menu-toggle">
                <img class="nav_logo_img img-fluid" src="{{ asset("site/images/Vurtut logo icon/vurtut.com.svg") }}" alt="vurtut">
                <button type="button" id="menu-btn">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <a href="{{ route('site.index') }}" class="navbar_brand float-left dn-smd">
                <img class="logo1 img-fluid rounded-circle" src="{{ asset("site/images/Vurtut logo icon/vurtut.com.svg") }}" alt="vurtut" width="50" length="50">
                <img class="logo2 img-fluid rounded-circle" src="{{ asset("site/images/Vurtut logo icon/vurtut.com.svg") }}" alt="vurtut" width="50" length="50">
                <span style="text-transform: lowercase;!important;">vurtut.com</span>
            </a>
            <ul id="respMenu" class="ace-responsive-menu text-right" data-menu-style="horizontal">
                <li>
                    <a href="#"><span class="title">Trendlər</span></a>
                    <ul class="scrol-menu">
                        <li><a href="{{ route('site.trends',['slug'=>'premium']) }}">Premium olanlar</a></li>
                        <li><a href="{{ route('site.trends',['slug'=>'visit']) }}">Ən çox ziyarət edilənlər</a></li>
                        <li><a href="{{ route('site.trends',['slug'=>'loved']) }}">Ən çox sevilənlər</a></li>
                        <li><a href="{{ route('site.trends',['slug'=>'rating']) }}">Ən çox reytinq yığanlar</a></li>
                        <li><a href="{{ route('site.trends',['slug'=>'shared']) }}">Ən çox paylaşılanlar</a></li>
                    </ul>
                </li>
                <!--Burada seherler cox olacaq javascriptle hereketli yazmaq lazimdi siyahiyi men yaza bilmedim-->
                <li>
                    <a href="#"><span class="title">Şəhərlər</span></a>
                    <ul {{--class="scrol-menu"--}}>
                        @if(!empty($cities[0]))
                            @foreach($cities as $city)
                                <li>
                                    <a href="{{ route('site.city',['citySlug' => $city['slug'][$currentLang]]) }}">{{$city['name'][$currentLang]}}</a>
                                    @if(!empty($city['subRegions'][0]))
                                        <ul class="scrol-menu">
                                            @foreach($city['subRegions'] as $subRegion)
                                                <li><a href="{{ route('site.city',['citySlug' => $city['slug'][$currentLang], 'subRegionSlug' => $subRegion['slug'][$currentLang]]) }}">{{ $subRegion['name']['az'] }}</a></li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </li>
                            @endforeach
                        @endif
                    </ul>
                </li>
                <li>
                    <a href="#"><span class="title">Kateqoriyalar</span></a>
                    <ul class="scrol-menu">
                        @if(!empty($categories[0]))
                            @foreach($categories as $category)
                                <li><a href="{{ route('site.category',['categorySlug' => $category['slug'][$currentLang]]) }}">{{ $category['title'][$currentLang] }}</a></li>
                            @endforeach
                        @endif
                    </ul>
                </li>
                <li>
                    <a href="{{ route('site.map') }}"><span class="title">Yaxında nə var?</span></a>
                </li>
                {{--<li>
                    <a href="{{ route('site.news') }}"><span class="title">Bloq və xəbərlər!</span></a>
                </li>--}}
                @if(!empty(auth('user')->user()->id))
                    <li class="user_setting">
                        <div class="dropdown">
                            <a class="btn dropdown-toggle" href="#" data-toggle="dropdown">
                                <img class="rounded-circle" style="max-height: 51px;!important;"  src="{{ !empty(auth('user')->user()->image)? asset("uploads/user/".auth('user')->user()->image): asset('site/images/Vurtut logo icon/account.png') }}" alt="e1.png">
                                <span class="dn-1366"> {{auth('user')->user()->full_name}} <span class="fa fa-angle-down"></span></span>
                            </a>
                            <div class="dropdown-menu">
                                <div class="user_set_header">
                                    <img class="float-left" style="max-height: 51px;border-radius: 50%;!important;" src="{{ !empty(auth('user')->user()->image)? asset("uploads/user/".auth('user')->user()->image): asset('site/images/Vurtut logo icon/account.png') }}" alt="e1.png">
                                    <p> {{auth('user')->user()->full_name}}</p>
                                </div>
                                <div class="user_setting_content">
                                    <a class="dropdown-item active" style="color: #484848;!important;" href="{{ route('site.user.index') }}">Hesabım</a>
{{--                                    <a class="dropdown-item" style="color: #484848;!important;" href="#">Kömək</a>--}}
                                    <a class="dropdown-item" style="color: #484848;!important;" href="{{ route('site.user.logout') }}">Çıxış</a>
                                </div>
                            </div>
                        </div>
                    </li>
                @elseif(!empty(auth('company')->user()->id))
                    <li class="user_setting">
                        <div class="dropdown">
                            <a class="btn dropdown-toggle" href="#" data-toggle="dropdown">
                                <img class="rounded-circle" style="max-height: 51px;!important;"  src="{{ !empty(auth('company')->user()->image)? asset("uploads/company/".auth('company')->user()->image): asset('site/images/Vurtut logo icon/account.png') }}" alt="e1.png">
                                <span class="dn-1366"> {{auth('company')->user()->full_name}} <span class="fa fa-angle-down"></span></span>
                            </a>
                            <div class="dropdown-menu">
                                <div class="user_set_header">
                                    <img class="float-left" style="max-height: 51px;border-radius: 50%;!important;" src="{{ !empty(auth('company')->user()->image)? asset("uploads/company/".auth('company')->user()->image): asset('site/images/Vurtut logo icon/account.png') }}" alt="e1.png">
                                    <p> {{auth('company')->user()->full_name}}</p>
                                </div>
                                <div class="user_setting_content">
                                    @if (!empty(auth('company')->user()->country_id) && !empty(auth('company')->user()->city_id))
                                    <a class="dropdown-item active" style="color: #484848;!important;" href="{{ route('site.company.index') }}">Hesabım</a>
                                    @endif
{{--                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#premiumCompany" style="color: #484848;">Premium Hesab</a>--}}
                                    <a class="dropdown-item" style="color: #484848;!important;" href="{{ route('site.company.logout') }}">Çıxış</a>
                                </div>
                            </div>
                        </div>
                    </li>
                @else
{{--                    <li class="list-inline-item list_s"><a href="#" class="btn flaticon-avatar" data-toggle="modal" data-target=".bd-example-modal-lg"> <span class="dn-1200">Giriş/Qeydiyyat</span></a></li>--}}
                    <li class="list-inline-item add_listing home2"><a href="#"  class="btn flaticon-avatar"  data-toggle="modal" data-target=".bd-example-modal-lg"> <span class="dn-1200"> Giriş/Qeydiyyat</span></a></li>
                @endif
             </ul>
        </nav>
    </div>
</header>
@include('site.layouts.login_register')

<div id="page" class="stylehome1 h0">
    <div class="mobile-menu">
        <div class="header stylehome1">
            <div class="main_logo_home2 text-left">
                <a href="{{ route('site.index') }}" style="display: inline-flex; align-items: center; text-decoration: none;width: 56px;
    height: 57px;
    padding: 0px;
    top: 0px;
    right: 329px;!important;">
                    <img class="nav_logo_img img-fluid mt15" src="{{ asset('site/images/Vurtut logo icon/Vurtut.com.png') }}" alt="Vurtut" style="border-radius: 34px !important;" width="50" height="50">
                    <span class="mt15" style="text-transform: lowercase !important; margin-left: 8px;">vurtut.com</span>
                </a>
            </div>

            <ul class="menu_bar_home2">
                <li class="list-inline-item"><a class="custom_search_with_menu_trigger msearch_icon" href="#" data-toggle="modal" data-target="#staticBackdrop"></a></li>
                @if(!empty(auth('user')->user()->id))
                    <li class="list-inline-item"><a class="muser_icon" href="{{ route('site.user.index') }}"><span class="flaticon-avatar"></span></a></li>
                @elseif(!empty(auth('company')->user()->id))
                    <li class="list-inline-item">
                        <a class="muser_icon" href="{{ route('site.company.index') }}"><span class="flaticon-avatar"></span></a>
                    </li>
                @else
                    <li class="list-inline-item">
                        <a href="#" class="muser_icon"  data-toggle="modal" data-target=".bd-example-modal-lg"><span class="flaticon-avatar"></span></a>
                    </li>
                @endif
                <li class="list-inline-item"><a class="menubar" href="#menu"><span></span></a></li>
            </ul>
        </div>
    </div><!-- /.mobile-menu -->
    <nav id="menu" class="stylehome1">
        <ul>
            <li>
                <a href="#"><span class="title">Trendlər</span></a>
                <ul>
                    <li><a href="{{ route('site.trends',['slug'=>'premium']) }}">Premium olanlar</a></li>
                    <li><a href="{{ route('site.trends',['slug'=>'visit']) }}">Ən çox ziyarət edilənlər</a></li>
                    <li><a href="{{ route('site.trends',['slug'=>'loved']) }}">Ən çox sevilənlər</a></li>
                    <li><a href="{{ route('site.trends',['slug'=>'rating']) }}">Ən çox reytinq yığanlar</a></li>
                    <li><a href="{{ route('site.trends',['slug'=>'shared']) }}">Ən çox paylaşılanlar</a></li>
                </ul>
            </li>
            <!--Burada seherler cox olacaq javascriptle hereketli yazmaq lazimdi siyahiyi men yaza bilmedim-->
            <li>
                <a href="#"><span class="title">Şəhərlər</span></a>
                <ul>
                    @if(!empty($cities[0]))
                        @foreach($cities as $city)
                            <li>
                                <a href="{{ route('site.city',['citySlug' => $city['slug'][$currentLang]]) }}">{{$city['name'][$currentLang]}}</a>
                                @if(!empty($city['subRegions'][0]))
                                    <ul>
                                        @foreach($city['subRegions'] as $subRegion)
                                            <li><a href="{{ route('site.city',['citySlug' => $city['slug'][$currentLang], 'subRegionSlug' => $subRegion['slug'][$currentLang]]) }}">{{ $subRegion['name']['az'] }}</a></li>
                                        @endforeach
                                    </ul>
                                @endif
                            </li>
                        @endforeach
                    @endif
                </ul>
            </li>
            <li>
                <a href="#"><span class="title">Kateqoriyalar</span></a>
                <ul>
                    @if(!empty($categories[0]))
                        @foreach($categories as $category)
                            <li><a href="{{ route('site.category',['categorySlug' => $category['slug'][$currentLang]]) }}">{{ $category['title'][$currentLang] }}</a></li>
                        @endforeach
                    @endif
                </ul>
            </li>
            <li>
                <a href="{{ route('site.map') }}"><span class="title">Yaxında nə var?</span></a>
            </li>
            {{--<li>
                <a href="{{ route('site.news') }}"><span class="title">Bloq və xəbərlər!</span></a>
            </li>--}}

   {{--         @if(!empty(auth('user')->user()->id))
--}}{{--                <li class="cl_btn"><a class="btn btn-block btn-lg btn-thm rounded" href="#"><span class="icon">+</span>Əlavə et</a></li>--}}{{--

            @elseif(!empty(auth('company')->user()->id))
                <li>
                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#premiumCompany" style="color: #484848;">Premium Hesab</a>
                </li>
            @else
                <li>
                    <a href="#" class="btn flaticon-avatar" data-toggle="modal" data-target=".bd-example-modal-lg">
                        <span class="title">Giriş/Qeydiyyat</span>
                    </a>
                </li>
            @endif--}}
        </ul>
    </nav>
</div>
