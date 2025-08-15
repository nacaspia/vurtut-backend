<?php $company = auth('company')->user(); ?>
@if (!empty($company['country_id']) && !empty($company['city_id']))
    <div class="col-lg-12">
        <div class="dashboard_navigationbar dn db-992">
            <div class="dropdown">
                <button onclick="myFunction()" class="dropbtn"><i class="fa fa-bars pr10"></i>Müəssisə bölməsi</button>
                <ul id="myDropdown" class="dropdown-content">
                    <li><a class="{{ Route::currentRouteName() === 'site.company.index' ? 'active' : '' }}" href="{{ route('site.company.index') }}"><span class="flaticon-web-page"></span>Müəssisəm</a></li>
                    <li><a class="{{ Route::currentRouteName() === 'site.company.settings' ? 'active' : '' }}" href="{{ route('site.company.settings') }}"><span class="flaticon-avatar"></span>Parametrlər</a></li>
                    <li><a class="{{ Route::currentRouteName() === 'site.company.announcements' ? 'active' : '' }}" href="{{ route('site.company.announcements') }}"><span class="flaticon-list"></span>Bildirişlərim</a></li>
                    <li><a class="{{ Route::currentRouteName() === 'site.company-post.index' ? 'active' : '' }}" href="{{ route('site.company-post.index') }}"><span class="flaticon-love"></span>Qalereya</a></li>
                    <li><a class="{{ Route::currentRouteName() === 'site.company-services.index' ? 'active' : '' }}" href="{{ route('site.company-services.index') }}"><span class="flaticon-list"></span>Kataloq</a></li>
                    @if($company['category']['is_reservation']== true)
                        <li><a class="{{ Route::currentRouteName() === 'site.company.reservation' ? 'active' : '' }}" href="{{ route('site.company.reservation') }}"><span class="flaticon-date"></span>Rezervasiyalarım</a></li>
                    @endif
                    <li><a class="{{ Route::currentRouteName() === 'site.company.statistics' ? 'active' : '' }}" href="{{ route('site.company.statistics') }}"><span class="flaticon-note"></span>Statistikalar</a></li>
                </ul>
            </div>
        </div>
    </div>
@endif
