<div class="main-sidebar">
    <div class="main-menu">
        <ul class="sidebar-menu scrollable">

            @can('dashboards-view')
            <li class="sidebar-item">
                <a href="{{ route('admin.index') }}" class="sidebar-link-group-title {{ Route::currentRouteName() === 'admin.index' ? 'active' : '' }}">@lang('admin.dashboard')</a>
            </li>
            @endcan
            <li class="sidebar-item">
                <a role="button" class="sidebar-link-group-title has-sub">@lang('admin.companies_about')</a>
                <ul class="sidebar-link-group" @if(in_array(Route::currentRouteName(),['admin.category.index', 'admin.companies.index'])) style="display: block;!important;" @else style="display: none;!important;" @endif>
                    @can('category-view')
                    <li class="sidebar-dropdown-item">
                        <a href="{{ route('admin.category.index') }}" class="sidebar-link">
                            <span class="nav-icon">
                                <i class="fa-light fa-filter-list"></i>
                            </span>
                            <span class="sidebar-txt">@lang('admin.categories')</span>
                        </a>
                    </li>
                    @endcan
                    @can('companies-view')
                    <li class="sidebar-dropdown-item">
                        <a href="{{ route('admin.companies.index') }}" class="sidebar-link">
                            <span class="nav-icon">
                                <i class="fa-light fa-filter-list"></i>
                            </span>
                            <span class="sidebar-txt">@lang('admin.companies')</span>
                        </a>
                    </li>
                    @endcan
                </ul>
            </li>
            <li class="sidebar-item">
                <a role="button" class="sidebar-link-group-title has-sub">@lang('admin.users_about')</a>
                <ul class="sidebar-link-group"  style="display: none;!important;">
                    @can('users-view')
                    <li class="sidebar-dropdown-item">
                        <a href="{{ route('admin.users.index') }}" class="sidebar-link">
                            <span class="nav-icon">
                                <i class="fa-light fa-filter-list"></i>
                            </span>
                            <span class="sidebar-txt">@lang('admin.users')</span>
                        </a>
                    </li>
                    @endcan
                </ul>
            </li>

            <li class="sidebar-item">
                <a role="button" class="sidebar-link-group-title has-sub">@lang('admin.security')</a>
                <ul class="sidebar-link-group"  style="display: none;!important;">
                    @can('cms-users-view')
                    <li class="sidebar-dropdown-item">
                        <a href="{{ route('admin.cms-users.index') }}" class="sidebar-link">
                            <span class="nav-icon">
                                <i class="fa-light fa-filter-list"></i>
                            </span>
                            <span class="sidebar-txt">@lang('admin.cms_users')</span>
                        </a>
                    </li>
                    @endcan
                    @can('roles-view')
                    <li class="sidebar-dropdown-item">
                        <a href="{{ route('admin.roles.index') }}" class="sidebar-link">
                            <span class="nav-icon">
                                <i class="fa-light fa-filter-list"></i>
                            </span>
                            <span class="sidebar-txt">@lang('admin.roles')</span>
                        </a>
                    </li>
                    @endcan
                    @can('permissions-view')
                    <li class="sidebar-dropdown-item">
                        <a href="{{ route('admin.permissions.index') }}" class="sidebar-link">
                            <span class="nav-icon">
                                <i class="fa-light fa-filter-list"></i>
                            </span>
                            <span class="sidebar-txt">@lang('admin.permissions')</span>
                        </a>
                    </li>
                    @endcan
                </ul>
            </li>

            <li class="sidebar-item">
                <a role="button" class="sidebar-link-group-title has-sub">@lang('admin.admin_settings')</a>
                <ul class="sidebar-link-group"  style="display: none;!important;">
                    @can('translations-view')
                    <li class="sidebar-dropdown-item">
                        <a href="{{ route('admin.translations.index') }}" class="sidebar-link">
                            <span class="nav-icon">
                                <i class="fa-light fa-language"></i>
                            </span>
                            <span class="sidebar-txt">@lang('admin.translations')</span>
                        </a>
                    </li>
                    @endcan
                    @can('static-page-view')
                    <li class="sidebar-dropdown-item">
                        <a href="{{ route('admin.static-page.index') }}" class="sidebar-link">
                            <span class="nav-icon">
                                <i class="fa-light fa-language"></i>
                            </span>
                            <span class="sidebar-txt">@lang('admin.static_page')</span>
                        </a>
                    </li>
                    @endcan
                    @can('country-view')
                    <li class="sidebar-dropdown-item">
                        <a href="{{ route('admin.country.index') }}" class="sidebar-link">
                            <span class="nav-icon">
                                <i class="fa-light fa-language"></i>
                            </span>
                            <span class="sidebar-txt">@lang('admin.country')</span>
                        </a>
                    </li>
                    @endcan
                    @can('city-view')
                    <li class="sidebar-dropdown-item">
                        <a href="{{ route('admin.city.index') }}" class="sidebar-link">
                            <span class="nav-icon">
                                <i class="fa-light fa-language"></i>
                            </span>
                            <span class="sidebar-txt">@lang('admin.city')</span>
                        </a>
                    </li>
                    @endcan
                    @can('settings-view')
                    <li class="sidebar-dropdown-item">
                        <a href="{{ route('admin.settings') }}" class="sidebar-link">
                            <span class="nav-icon">
                                <i class="fa-light fa-language"></i>
                            </span>
                            <span class="sidebar-txt">@lang('admin.settings')</span>
                        </a>
                    </li>
                    @endcan
                </ul>
            </li>
        </ul>
    </div>
</div>
