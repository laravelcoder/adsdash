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
                    
                    @can('profile_access')
                    <li>
                        <a href="{{ route('admin.profiles.index') }}">
                            <i class="fa fa-gears"></i>
                            <span>@lang('global.profiles.title')</span>
                        </a>
                    </li>@endcan
                    
                    @can('ad_access')
                    <li>
                        <a href="{{ route('admin.ads.index') }}">
                            <i class="fa fa-video-camera"></i>
                            <span>@lang('global.ads.title')</span>
                        </a>
                    </li>@endcan
                    
                    @can('ad_type_access')
                    <li>
                        <a href="{{ route('admin.ad_types.index') }}">
                            <i class="fa fa-gears"></i>
                            <span>@lang('global.ad-types.title')</span>
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
                    
                </ul>
            </li>@endcan
            
            @can('channel_access')
            <li>
                <a href="{{ route('admin.channels.index') }}">
                    <i class="fa fa-gears"></i>
                    <span>@lang('global.channels.title')</span>
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
                    
                </ul>
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
            
            @can('assets_management_access')
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-book"></i>
                    <span>@lang('global.assets-management.title')</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    @can('asset_access')
                    <li>
                        <a href="{{ route('admin.assets.index') }}">
                            <i class="fa fa-book"></i>
                            <span>@lang('global.assets.title')</span>
                        </a>
                    </li>@endcan
                    
                    @can('assets_category_access')
                    <li>
                        <a href="{{ route('admin.assets_categories.index') }}">
                            <i class="fa fa-tags"></i>
                            <span>@lang('global.assets-categories.title')</span>
                        </a>
                    </li>@endcan
                    
                    @can('assets_location_access')
                    <li>
                        <a href="{{ route('admin.assets_locations.index') }}">
                            <i class="fa fa-map-marker"></i>
                            <span>@lang('global.assets-locations.title')</span>
                        </a>
                    </li>@endcan
                    
                    @can('assets_status_access')
                    <li>
                        <a href="{{ route('admin.assets_statuses.index') }}">
                            <i class="fa fa-server"></i>
                            <span>@lang('global.assets-statuses.title')</span>
                        </a>
                    </li>@endcan
                    
                    @can('assets_history_access')
                    <li>
                        <a href="{{ route('admin.assets_histories.index') }}">
                            <i class="fa fa-th-list"></i>
                            <span>@lang('global.assets-history.title')</span>
                        </a>
                    </li>@endcan
                    
                </ul>
            </li>@endcan
            
            @can('client_management_access')
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-briefcase"></i>
                    <span>@lang('global.client-management.title')</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    @can('client_access')
                    <li>
                        <a href="{{ route('admin.clients.index') }}">
                            <i class="fa fa-user-plus"></i>
                            <span>@lang('global.clients.title')</span>
                        </a>
                    </li>@endcan
                    
                    @can('client_project_access')
                    <li>
                        <a href="{{ route('admin.client_projects.index') }}">
                            <i class="fa fa-briefcase"></i>
                            <span>@lang('global.client-projects.title')</span>
                        </a>
                    </li>@endcan
                    
                    @can('client_note_access')
                    <li>
                        <a href="{{ route('admin.client_notes.index') }}">
                            <i class="fa fa-comments-o"></i>
                            <span>@lang('global.client-notes.title')</span>
                        </a>
                    </li>@endcan
                    
                    @can('client_document_access')
                    <li>
                        <a href="{{ route('admin.client_documents.index') }}">
                            <i class="fa fa-file-text-o"></i>
                            <span>@lang('global.client-documents.title')</span>
                        </a>
                    </li>@endcan
                    
                    @can('client_transaction_access')
                    <li>
                        <a href="{{ route('admin.client_transactions.index') }}">
                            <i class="fa fa-credit-card"></i>
                            <span>@lang('global.client-transactions.title')</span>
                        </a>
                    </li>@endcan
                    
                </ul>
            </li>@endcan
            
            @can('client_management_setting_access')
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-gears"></i>
                    <span>@lang('global.client-management-settings.title')</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    @can('client_currency_access')
                    <li>
                        <a href="{{ route('admin.client_currencies.index') }}">
                            <i class="fa fa-money"></i>
                            <span>@lang('global.client-currencies.title')</span>
                        </a>
                    </li>@endcan
                    
                    @can('client_transaction_type_access')
                    <li>
                        <a href="{{ route('admin.client_transaction_types.index') }}">
                            <i class="fa fa-exchange"></i>
                            <span>@lang('global.client-transaction-types.title')</span>
                        </a>
                    </li>@endcan
                    
                    @can('client_income_source_access')
                    <li>
                        <a href="{{ route('admin.client_income_sources.index') }}">
                            <i class="fa fa-database"></i>
                            <span>@lang('global.client-income-sources.title')</span>
                        </a>
                    </li>@endcan
                    
                    @can('client_status_access')
                    <li>
                        <a href="{{ route('admin.client_statuses.index') }}">
                            <i class="fa fa-server"></i>
                            <span>@lang('global.client-statuses.title')</span>
                        </a>
                    </li>@endcan
                    
                    @can('client_project_status_access')
                    <li>
                        <a href="{{ route('admin.client_project_statuses.index') }}">
                            <i class="fa fa-server"></i>
                            <span>@lang('global.client-project-statuses.title')</span>
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

