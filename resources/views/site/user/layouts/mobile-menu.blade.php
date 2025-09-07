<?php $user = auth('user')->user(); ?>
@if (!empty($user['country_id']) && !empty($user['city_id']))
<div class="col-lg-12">
    <div class="dashboard_navigationbar dn db-992">
        <div class="dropdown">
            <button onclick="myFunction()" class="dropbtn"><i class="fa fa-bars pr10"></i>İstifadəçi bölməsi</button>
            <ul id="myDropdown" class="dropdown-content">
                <li><a class="active" href="{{ route('site.user.index') }}"><i class="fa-solid fa-user"  style="padding-right: 5px;"></i>Hesabım</a></li>
                <li><a href="{{ route('site.user.settings') }}"><i class="fa-solid fa-gear"  style="padding-right: 5px;"></i>Parametrlər</a></li>
                <li><a href="{{ route('site.user.announcements') }}"><i class="fa-solid fa-bell"  style="padding-right: 5px;"></i>Bildirişlərim</a></li>
                <li><a href="{{ route('site.user.favorites') }}"><i class="fa-solid fa-heart"  style="padding-right: 5px;"></i>Sevimlilər</a></li>
                <li><a href="{{ route('site.user.reservation') }}"><i class="fa-solid fa-calendar-check"  style="padding-right: 5px;"></i>Rezervasiyalarım</a></li>
                <li><a href="{{ route('site.user.logout') }}"><i class="fa-solid fa-sign-out-alt"  style="padding-right: 5px;"></i>Çıxış</a></li>
            </ul>
        </div>
    </div>
</div>
@endif
