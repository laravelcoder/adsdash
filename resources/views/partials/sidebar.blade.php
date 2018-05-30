@inject('request', 'Illuminate\Http\Request')
<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <ul class="sidebar-menu">

            <li>
                <select class="searchable-field form-control"></select>
            </li>

            <li class="{{ $request->segment(1) == 'home' ? 'active' : '' }}">
                <a href="{{ url('/') }}">
                    <i class="fa fa-wrench"></i>
                    <span class="title">@lang('global.app_dashboard')</span>
                </a>
            </li>

            @can('ads_dashboard_access')
            <li>
                <a href="{{ route('admin.ads_dashboards.index') }}">
                    <i class="fa fa-gears"></i>
                    <span>@lang('global.ads-dashboard.title')</span>
                </a>
            </li>@endcan
            
            @can('network_dashboard_access')
            <li>
                <a href="{{ route('admin.network_dashboards.index') }}">
                    <i class="fa fa-video-camera"></i>
                    <span>@lang('global.network-dashboard.title')</span>
                </a>
            </li>@endcan
            
            @can('content_management_access')
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-book"></i>
                    <span>@lang('global.content-management.title')</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    @can('content_category_access')
                    <li>
                        <a href="{{ route('admin.content_categories.index') }}">
                            <i class="fa fa-folder"></i>
                            <span>@lang('global.content-categories.title')</span>
                        </a>
                    </li>@endcan
                    
                    @can('content_tag_access')
                    <li>
                        <a href="{{ route('admin.content_tags.index') }}">
                            <i class="fa fa-tags"></i>
                            <span>@lang('global.content-tags.title')</span>
                        </a>
                    </li>@endcan
                    
                    @can('content_page_access')
                    <li>
                        <a href="{{ route('admin.content_pages.index') }}">
                            <i class="fa fa-file-o"></i>
                            <span>@lang('global.content-pages.title')</span>
                        </a>
                    </li>@endcan
                    
                    @can('page_builder_access')
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-gears"></i>
                            <span>@lang('global.page-builder.title')</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            @can('template_access')
                            <li>
                                <a href="{{ route('admin.templates.index') }}">
                                    <i class="fa fa-gears"></i>
                                    <span>@lang('global.templates.title')</span>
                                </a>
                            </li>@endcan
                            
                            @can('stylesheet_access')
                            <li>
                                <a href="{{ route('admin.stylesheets.index') }}">
                                    <i class="fa fa-gears"></i>
                                    <span>@lang('global.stylesheet.title')</span>
                                </a>
                            </li>@endcan
                            
                            @can('top_script_access')
                            <li>
                                <a href="{{ route('admin.top_scripts.index') }}">
                                    <i class="fa fa-gears"></i>
                                    <span>@lang('global.top-scripts.title')</span>
                                </a>
                            </li>@endcan
                            
                            @can('bottom_script_access')
                            <li>
                                <a href="{{ route('admin.bottom_scripts.index') }}">
                                    <i class="fa fa-gears"></i>
                                    <span>@lang('global.bottom-scripts.title')</span>
                                </a>
                            </li>@endcan
                            
                            @can('layout_access')
                            <li>
                                <a href="{{ route('admin.layouts.index') }}">
                                    <i class="fa fa-clone"></i>
                                    <span>@lang('global.layouts.title')</span>
                                </a>
                            </li>@endcan
                            
                        </ul>
                    </li>@endcan
                    
                </ul>
            </li>@endcan
            
            @can('internal_notification_access')
            <li>
                <a href="{{ route('admin.internal_notifications.index') }}">
                    <i class="fa fa-briefcase"></i>
                    <span>@lang('global.internal-notifications.title')</span>
                </a>
            </li>@endcan
            
            @can('management_access')
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-phone-square"></i>
                    <span>@lang('global.management.title')</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    @can('contact_company_access')
                    <li>
                        <a href="{{ route('admin.contact_companies.index') }}">
                            <i class="fa fa-building-o"></i>
                            <span>@lang('global.contact-companies.title')</span>
                        </a>
                    </li>@endcan
                    
                    @can('contact_access')
                    <li>
                        <a href="{{ route('admin.contacts.index') }}">
                            <i class="fa fa-user-plus"></i>
                            <span>@lang('global.contacts.title')</span>
                        </a>
                    </li>@endcan
                    
                    @can('agent_access')
                    <li>
                        <a href="{{ route('admin.agents.index') }}">
                            <i class="fa fa-user-plus"></i>
                            <span>@lang('global.agents.title')</span>
                        </a>
                    </li>@endcan
                    
                    @can('ad_access')
                    <li>
                        <a href="{{ route('admin.ads.index') }}">
                            <i class="fa fa-video-camera"></i>
                            <span>@lang('global.ads.title')</span>
                        </a>
                    </li>@endcan
                    
                    @can('audience_access')
                    <li>
                        <a href="{{ route('admin.audiences.index') }}">
                            <i class="fa fa-gears"></i>
                            <span>@lang('global.audiences.title')</span>
                        </a>
                    </li>@endcan
                    
                    @can('demographic_access')
                    <li>
                        <a href="{{ route('admin.demographics.index') }}">
                            <i class="fa fa-gears"></i>
                            <span>@lang('global.demographics.title')</span>
                        </a>
                    </li>@endcan
                    
                    @can('phone_access')
                    <li>
                        <a href="{{ route('admin.phones.index') }}">
                            <i class="fa fa-phone-square"></i>
                            <span>@lang('global.phones.title')</span>
                        </a>
                    </li>@endcan
                    
                </ul>
            </li>@endcan
            
            @can('network_stat_access')
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-tv"></i>
                    <span>@lang('global.network-stats.title')</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    @can('network_access')
                    <li>
                        <a href="{{ route('admin.networks.index') }}">
                            <i class="fa fa-tv"></i>
                            <span>@lang('global.networks.title')</span>
                        </a>
                    </li>@endcan
                    
                    @can('provider_access')
                    <li>
                        <a href="{{ route('admin.providers.index') }}">
                            <i class="fa fa-adjust"></i>
                            <span>@lang('global.providers.title')</span>
                        </a>
                    </li>@endcan
                    
                    @can('station_access')
                    <li>
                        <a href="{{ route('admin.stations.index') }}">
                            <i class="fa fa-video-camera"></i>
                            <span>@lang('global.stations.title')</span>
                        </a>
                    </li>@endcan
                    
                </ul>
            </li>@endcan
            
            @can('clipdb_access')
            <li>
                <a href="{{ route('admin.clipdbs.index') }}">
                    <i class="fa fa-database"></i>
                    <span>@lang('global.clipdb.title')</span>
                </a>
            </li>@endcan
            
            @can('user_management_access')
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-users"></i>
                    <span>@lang('global.user-management.title')</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    @can('permission_access')
                    <li>
                        <a href="{{ route('admin.permissions.index') }}">
                            <i class="fa fa-briefcase"></i>
                            <span>@lang('global.permissions.title')</span>
                        </a>
                    </li>@endcan
                    
                    @can('role_access')
                    <li>
                        <a href="{{ route('admin.roles.index') }}">
                            <i class="fa fa-briefcase"></i>
                            <span>@lang('global.roles.title')</span>
                        </a>
                    </li>@endcan
                    
                    @can('user_access')
                    <li>
                        <a href="{{ route('admin.users.index') }}">
                            <i class="fa fa-user"></i>
                            <span>@lang('global.users.title')</span>
                        </a>
                    </li>@endcan
                    
                    @can('team_access')
                    <li>
                        <a href="{{ route('admin.teams.index') }}">
                            <i class="fa fa-users"></i>
                            <span>@lang('global.teams.title')</span>
                        </a>
                    </li>@endcan
                    
                </ul>
            </li>@endcan
            
            @can('default_setting_access')
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-gears"></i>
                    <span>@lang('global.default-settings.title')</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    @can('user_base_access')
                    <li>
                        <a href="{{ route('admin.user_bases.index') }}">
                            <i class="fa fa-gears"></i>
                            <span>@lang('global.user-base.title')</span>
                        </a>
                    </li>@endcan
                    
                    @can('variable_access')
                    <li>
                        <a href="{{ route('admin.variables.index') }}">
                            <i class="fa fa-gears"></i>
                            <span>@lang('global.variables.title')</span>
                        </a>
                    </li>@endcan
                    
                </ul>
            </li>@endcan
            
            @can('response_datum_access')
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-gears"></i>
                    <span>@lang('global.response-data.title')</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    @can('ad_response_access')
                    <li>
                        <a href="{{ route('admin.ad_responses.index') }}">
                            <i class="fa fa-adjust"></i>
                            <span>@lang('global.ad-responses.title')</span>
                        </a>
                    </li>@endcan
                    
                </ul>
            </li>@endcan
            

            

            
            @php ($unread = App\MessengerTopic::countUnread())
            <li class="{{ $request->segment(2) == 'messenger' ? 'active' : '' }} {{ ($unread > 0 ? 'unread' : '') }}">
                <a href="{{ route('admin.messenger.index') }}">
                    <i class="fa fa-envelope"></i>

                    <span>Messages</span>
                    @if($unread > 0)
                        {{ ($unread > 0 ? '('.$unread.')' : '') }}
                    @endif
                </a>
            </li>
            <style>
                .page-sidebar-menu .unread * {
                    font-weight:bold !important;
                }
            </style>



            <li class="{{ $request->segment(1) == 'change_password' ? 'active' : '' }}">
                <a href="{{ route('auth.change_password') }}">
                    <i class="fa fa-key"></i>
                    <span class="title">@lang('global.app_change_password')</span>
                </a>
            </li>

            <li>
                <a href="#logout" onclick="$('#logout').submit();">
                    <i class="fa fa-arrow-left"></i>
                    <span class="title">@lang('global.app_logout')</span>
                </a>
            </li>
        </ul>
    </section>
</aside>

