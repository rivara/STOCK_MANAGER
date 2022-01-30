<aside class="main-sidebar sidebar-dark-primary elevation-4" style="min-height: 917px;">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <span class="brand-text font-weight-light">{{ trans('panel.site_title') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route("admin.home") }}">
                        <i class="fas fa-fw fa-tachometer-alt nav-icon">
                        </i>
                        <p>
                            {{ trans('global.dashboard') }}
                        </p>
                    </a>
                </li>
                @can('task_management_access')
                    <li class="nav-item has-treeview {{ request()->is("admin/tasks-calendars*") ? "menu-open" : "" }} {{ request()->is("admin/tasks*") ? "menu-open" : "" }} {{ request()->is("admin/jobs*") ? "menu-open" : "" }}">
                        <a class="nav-link nav-dropdown-toggle" href="#">
                            <i class="fa-fw nav-icon fas fa-list">

                            </i>
                            <p>
                                {{ trans('cruds.taskManagement.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('tasks_calendar_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.tasks-calendars.index") }}" class="nav-link {{ request()->is("admin/tasks-calendars") || request()->is("admin/tasks-calendars/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-calendar">

                                        </i>
                                        <p>
                                            {{ trans('cruds.tasksCalendar.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('task_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.tasks.index") }}" class="nav-link {{ request()->is("admin/tasks") || request()->is("admin/tasks/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-toolbox">

                                        </i>
                                        <p>
                                            {{ trans('cruds.task.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('job_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.jobs.index") }}" class="nav-link {{ request()->is("admin/jobs") || request()->is("admin/jobs/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-chalkboard-teacher">

                                        </i>
                                        <p>
                                            {{ trans('cruds.job.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('asset_management_access')
                    <li class="nav-item has-treeview {{ request()->is("admin/assets*") ? "menu-open" : "" }} {{ request()->is("admin/assets-histories*") ? "menu-open" : "" }}">
                        <a class="nav-link nav-dropdown-toggle" href="#">
                            <i class="fa-fw nav-icon fas fa-book">

                            </i>
                            <p>
                                {{ trans('cruds.assetManagement.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('asset_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.assets.index") }}" class="nav-link {{ request()->is("admin/assets") || request()->is("admin/assets/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-book">

                                        </i>
                                        <p>
                                            {{ trans('cruds.asset.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('assets_history_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.assets-histories.index") }}" class="nav-link {{ request()->is("admin/assets-histories") || request()->is("admin/assets-histories/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-th-list">

                                        </i>
                                        <p>
                                            {{ trans('cruds.assetsHistory.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('user_management_access')
                    <li class="nav-item has-treeview {{ request()->is("admin/permissions*") ? "menu-open" : "" }} {{ request()->is("admin/roles*") ? "menu-open" : "" }} {{ request()->is("admin/users*") ? "menu-open" : "" }} {{ request()->is("admin/audit-logs*") ? "menu-open" : "" }}">
                        <a class="nav-link nav-dropdown-toggle" href="#">
                            <i class="fa-fw nav-icon fas fa-users">

                            </i>
                            <p>
                                {{ trans('cruds.userManagement.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('permission_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.permissions.index") }}" class="nav-link {{ request()->is("admin/permissions") || request()->is("admin/permissions/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-unlock-alt">

                                        </i>
                                        <p>
                                            {{ trans('cruds.permission.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('role_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.roles.index") }}" class="nav-link {{ request()->is("admin/roles") || request()->is("admin/roles/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-briefcase">

                                        </i>
                                        <p>
                                            {{ trans('cruds.role.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('user_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.users.index") }}" class="nav-link {{ request()->is("admin/users") || request()->is("admin/users/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-user">

                                        </i>
                                        <p>
                                            {{ trans('cruds.user.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('audit_log_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.audit-logs.index") }}" class="nav-link {{ request()->is("admin/audit-logs") || request()->is("admin/audit-logs/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-file-alt">

                                        </i>
                                        <p>
                                            {{ trans('cruds.auditLog.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('administracion_access')
                    <li class="nav-item has-treeview {{ request()->is("admin/asset-locations*") ? "menu-open" : "" }} {{ request()->is("admin/parameters*") ? "menu-open" : "" }} {{ request()->is("admin/task-tags*") ? "menu-open" : "" }} {{ request()->is("admin/task-statuses*") ? "menu-open" : "" }} {{ request()->is("admin/asset-statuses*") ? "menu-open" : "" }} {{ request()->is("admin/asset-categories*") ? "menu-open" : "" }} {{ request()->is("admin/asset-sub-categories*") ? "menu-open" : "" }} {{ request()->is("admin/incidences-categories*") ? "menu-open" : "" }} {{ request()->is("admin/incidences-subcategories*") ? "menu-open" : "" }} {{ request()->is("admin/marks*") ? "menu-open" : "" }} {{ request()->is("admin/samples*") ? "menu-open" : "" }} {{ request()->is("admin/networks*") ? "menu-open" : "" }} {{ request()->is("admin/zones*") ? "menu-open" : "" }} {{ request()->is("admin/areas*") ? "menu-open" : "" }} {{ request()->is("admin/provinces*") ? "menu-open" : "" }} {{ request()->is("admin/municipalities*") ? "menu-open" : "" }} {{ request()->is("admin/magnitudes*") ? "menu-open" : "" }} {{ request()->is("admin/units*") ? "menu-open" : "" }} {{ request()->is("admin/techniques*") ? "menu-open" : "" }} {{ request()->is("admin/calculations*") ? "menu-open" : "" }} {{ request()->is("admin/periods*") ? "menu-open" : "" }} {{ request()->is("admin/records*") ? "menu-open" : "" }}">
                        <a class="nav-link nav-dropdown-toggle" href="#">
                            <i class="fa-fw nav-icon fas fa-cogs">

                            </i>
                            <p>
                                {{ trans('cruds.administracion.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('asset_location_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.asset-locations.index") }}" class="nav-link {{ request()->is("admin/asset-locations") || request()->is("admin/asset-locations/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-map-marker">

                                        </i>
                                        <p>
                                            {{ trans('cruds.assetLocation.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('parameter_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.parameters.index") }}" class="nav-link {{ request()->is("admin/parameters") || request()->is("admin/parameters/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon far fa-list-alt">

                                        </i>
                                        <p>
                                            {{ trans('cruds.parameter.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('task_tag_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.task-tags.index") }}" class="nav-link {{ request()->is("admin/task-tags") || request()->is("admin/task-tags/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-server">

                                        </i>
                                        <p>
                                            {{ trans('cruds.taskTag.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('task_status_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.task-statuses.index") }}" class="nav-link {{ request()->is("admin/task-statuses") || request()->is("admin/task-statuses/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-server">

                                        </i>
                                        <p>
                                            {{ trans('cruds.taskStatus.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('asset_status_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.asset-statuses.index") }}" class="nav-link {{ request()->is("admin/asset-statuses") || request()->is("admin/asset-statuses/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-server">

                                        </i>
                                        <p>
                                            {{ trans('cruds.assetStatus.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('asset_category_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.asset-categories.index") }}" class="nav-link {{ request()->is("admin/asset-categories") || request()->is("admin/asset-categories/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-tags">

                                        </i>
                                        <p>
                                            {{ trans('cruds.assetCategory.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('asset_sub_category_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.asset-sub-categories.index") }}" class="nav-link {{ request()->is("admin/asset-sub-categories") || request()->is("admin/asset-sub-categories/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-tags">

                                        </i>
                                        <p>
                                            {{ trans('cruds.assetSubCategory.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('incidences_category_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.incidences-categories.index") }}" class="nav-link {{ request()->is("admin/incidences-categories") || request()->is("admin/incidences-categories/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-exclamation-circle">

                                        </i>
                                        <p>
                                            {{ trans('cruds.incidencesCategory.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('incidences_subcategory_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.incidences-subcategories.index") }}" class="nav-link {{ request()->is("admin/incidences-subcategories") || request()->is("admin/incidences-subcategories/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-exclamation-circle">

                                        </i>
                                        <p>
                                            {{ trans('cruds.incidencesSubcategory.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('mark_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.marks.index") }}" class="nav-link {{ request()->is("admin/marks") || request()->is("admin/marks/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon far fa-list-alt">

                                        </i>
                                        <p>
                                            {{ trans('cruds.mark.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('sample_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.samples.index") }}" class="nav-link {{ request()->is("admin/samples") || request()->is("admin/samples/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon far fa-list-alt">

                                        </i>
                                        <p>
                                            {{ trans('cruds.sample.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('network_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.networks.index") }}" class="nav-link {{ request()->is("admin/networks") || request()->is("admin/networks/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-project-diagram">

                                        </i>
                                        <p>
                                            {{ trans('cruds.network.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('zone_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.zones.index") }}" class="nav-link {{ request()->is("admin/zones") || request()->is("admin/zones/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-compass">

                                        </i>
                                        <p>
                                            {{ trans('cruds.zone.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('area_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.areas.index") }}" class="nav-link {{ request()->is("admin/areas") || request()->is("admin/areas/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-compact-disc">

                                        </i>
                                        <p>
                                            {{ trans('cruds.area.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('province_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.provinces.index") }}" class="nav-link {{ request()->is("admin/provinces") || request()->is("admin/provinces/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-globe-africa">

                                        </i>
                                        <p>
                                            {{ trans('cruds.province.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('municipality_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.municipalities.index") }}" class="nav-link {{ request()->is("admin/municipalities") || request()->is("admin/municipalities/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-globe">

                                        </i>
                                        <p>
                                            {{ trans('cruds.municipality.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('magnitude_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.magnitudes.index") }}" class="nav-link {{ request()->is("admin/magnitudes") || request()->is("admin/magnitudes/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon far fa-sun">

                                        </i>
                                        <p>
                                            {{ trans('cruds.magnitude.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('unit_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.units.index") }}" class="nav-link {{ request()->is("admin/units") || request()->is("admin/units/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-ruler">

                                        </i>
                                        <p>
                                            {{ trans('cruds.unit.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('technique_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.techniques.index") }}" class="nav-link {{ request()->is("admin/techniques") || request()->is("admin/techniques/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-bong">

                                        </i>
                                        <p>
                                            {{ trans('cruds.technique.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('calculation_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.calculations.index") }}" class="nav-link {{ request()->is("admin/calculations") || request()->is("admin/calculations/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-calculator">

                                        </i>
                                        <p>
                                            {{ trans('cruds.calculation.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('period_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.periods.index") }}" class="nav-link {{ request()->is("admin/periods") || request()->is("admin/periods/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon far fa-clock">

                                        </i>
                                        <p>
                                            {{ trans('cruds.period.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('record_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.records.index") }}" class="nav-link {{ request()->is("admin/records") || request()->is("admin/records/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-bars">

                                        </i>
                                        <p>
                                            {{ trans('cruds.record.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('user_alert_access')
                    <li class="nav-item">
                        <a href="{{ route("admin.user-alerts.index") }}" class="nav-link {{ request()->is("admin/user-alerts") || request()->is("admin/user-alerts/*") ? "active" : "" }}">
                            <i class="fa-fw nav-icon fas fa-bell">

                            </i>
                            <p>
                                {{ trans('cruds.userAlert.title') }}
                            </p>
                        </a>
                    </li>
                @endcan
                @php($unread = \App\Models\QaTopic::unreadCount())
                    <li class="nav-item">
                        <a href="{{ route("admin.messenger.index") }}" class="{{ request()->is("admin/messenger") || request()->is("admin/messenger/*") ? "active" : "" }} nav-link">
                            <i class="fa-fw fa fa-envelope nav-icon">

                            </i>
                            <p>{{ trans('global.messages') }}</p>
                            @if($unread > 0)
                                <strong>( {{ $unread }} )</strong>
                            @endif

                        </a>
                    </li>
                    @if(file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php')))
                        @can('profile_password_edit')
                            <li class="nav-item">
                                <a class="nav-link {{ request()->is('profile/password') || request()->is('profile/password/*') ? 'active' : '' }}" href="{{ route('profile.password.edit') }}">
                                    <i class="fa-fw fas fa-key nav-icon">
                                    </i>
                                    <p>
                                        {{ trans('global.change_password') }}
                                    </p>
                                </a>
                            </li>
                        @endcan
                    @endif
                    <li class="nav-item">
                        <a href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                            <p>
                                <i class="fas fa-fw fa-sign-out-alt nav-icon">

                                </i>
                                <p>{{ trans('global.logout') }}</p>
                            </p>
                        </a>
                    </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
