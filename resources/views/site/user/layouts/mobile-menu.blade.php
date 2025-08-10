<div class="col-lg-12">
    <div class="dashboard_navigationbar dn db-992">
        <div class="dropdown">
            <button onclick="myFunction()" class="dropbtn"><i class="fa fa-bars pr10"></i>İstifadəçi bölməsi</button>
            <ul id="myDropdown" class="dropdown-content">

                <?php $user = auth('user')->user(); ?>
                @if (!empty($user['country_id']) && !empty($user['city_id']))
                <li><a class="active" href="{{ route('site.user.index') }}"><span class="flaticon-web-page"></span>Hesabım</a></li>
                <li><a href="{{ route('site.user.settings') }}"><span class="flaticon-avatar"></span>Parametrlər</a></li>
                <li><a href="{{ route('site.user.announcements') }}"><span class="flaticon-list"></span>Bildirişlərim</a></li>
                <li><a href="{{ route('site.user.favorites') }}"><span class="flaticon-love"></span>Sevimlilər</a></li>
{{--                <li><a href="{{ route('site.user.review') }}"><span class="flaticon-note"></span>Rəylərim</a></li>--}}
                <li><a href="{{ route('site.user.reservation') }}"><span class="flaticon-logout"></span>Rezervasiyalarım</a></li>
                <li><a href="{{ route('site.user.logout') }}"><span class="flaticon-logout"></span>Çıxış</a></li>
                @else
                    <li><a href="{{ route('site.user.settings') }}"><span class="flaticon-avatar"></span>Parametrlər</a></li>
                    <li><a href="{{ route('site.user.logout') }}"><span class="flaticon-logout"></span>Çıxış</a></li>
                @endif
            </ul>
        </div>
    </div>
</div>
