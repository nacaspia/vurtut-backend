<?php $company = auth('company')->user(); ?>
@if (!empty($company['country_id']) && !empty($company['city_id']))
    <div class="col-lg-12">
        <div class="dashboard_navigationbar dn db-992">
            <div class="dropdown">
                <button onclick="myFunction()" class="dropbtn"><i class="fa fa-bars pr10"></i>Müəssisə bölməsi</button>
                <ul id="myDropdown" class="dropdown-content">
                    <li><a class="{{ Route::currentRouteName() === 'site.company.index' ? 'active' : '' }}" href="{{ route('site.company.index') }}"><i class="fa-solid fa-landmark" style="padding-right: 5px;"></i>Müəssisəm</a></li>
                    <li><a class="{{ Route::currentRouteName() === 'site.company.settings' ? 'active' : '' }}" href="{{ route('site.company.settings') }}"><i class="fa-solid fa-gear" style="padding-right: 5px;"></i>Parametrlər</a></li>
                    <li><a class="{{ Route::currentRouteName() === 'site.company.announcements' ? 'active' : '' }}" href="{{ route('site.company.announcements') }}"><i class="fa-solid fa-bell" style="padding-right: 5px;"></i>Bildirişlərim</a></li>
                    <li><a class="{{ Route::currentRouteName() === 'site.company-post.index' ? 'active' : '' }}" href="{{ route('site.company-post.index') }}"><i class="fa-regular fa-image" style="padding-right: 5px;"></i>Qalereya</a></li>
                    <li><a class="{{ Route::currentRouteName() === 'site.company-services.index' ? 'active' : '' }}" href="{{ route('site.company-services.index') }}"><i class="fa-solid fa-layer-group" style="padding-right: 5px;"></i>Kataloq</a></li>
                    @if($company['is_premium'] == 1 && $company['category']['is_reservation']== true)
                        <li><a class="{{ Route::currentRouteName() === 'site.company.reservation' ? 'active' : '' }}" href="{{ route('site.company.reservation') }}"><span class="flaticon-date"></span>Rezervasiyalarım</a></li>
                    @endif
                    <li><a class="{{ Route::currentRouteName() === 'site.company.statistics' ? 'active' : '' }}" href="{{ route('site.company.statistics') }}"><i class="fa-solid fa-chart-line" style="padding-right: 5px;"></i>Statistikalar</a></li>
                </ul>
            </div>
        </div>
    </div>
@endif
