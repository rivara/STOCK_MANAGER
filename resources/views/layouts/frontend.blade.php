<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet" />
    <link href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/buttons/1.2.4/css/buttons.dataTables.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/select/1.3.0/css/select.dataTables.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/1.5.0/css/perfect-scrollbar.min.css" rel="stylesheet" />
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet" />
    @yield('styles')
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        @guest
                        @else
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('frontend.home') }}">
                                    {{ __('Dashboard') }}
                                </a>
                            </li>
                        @endguest
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if(Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                                    <a class="dropdown-item" href="{{ route('frontend.profile.index') }}">{{ __('My profile') }}</a>

                                    @can('task_management_access')
                                        <a class="dropdown-item disabled" href="#">
                                            {{ trans('cruds.taskManagement.title') }}
                                        </a>
                                    @endcan
                                    @can('task_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.tasks.index') }}">
                                            {{ trans('cruds.task.title') }}
                                        </a>
                                    @endcan
                                    @can('job_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.jobs.index') }}">
                                            {{ trans('cruds.job.title') }}
                                        </a>
                                    @endcan
                                    @can('asset_management_access')
                                        <a class="dropdown-item disabled" href="#">
                                            {{ trans('cruds.assetManagement.title') }}
                                        </a>
                                    @endcan
                                    @can('asset_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.assets.index') }}">
                                            {{ trans('cruds.asset.title') }}
                                        </a>
                                    @endcan
                                    @can('assets_history_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.assets-histories.index') }}">
                                            {{ trans('cruds.assetsHistory.title') }}
                                        </a>
                                    @endcan
                                    @can('user_management_access')
                                        <a class="dropdown-item disabled" href="#">
                                            {{ trans('cruds.userManagement.title') }}
                                        </a>
                                    @endcan
                                    @can('permission_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.permissions.index') }}">
                                            {{ trans('cruds.permission.title') }}
                                        </a>
                                    @endcan
                                    @can('role_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.roles.index') }}">
                                            {{ trans('cruds.role.title') }}
                                        </a>
                                    @endcan
                                    @can('user_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.users.index') }}">
                                            {{ trans('cruds.user.title') }}
                                        </a>
                                    @endcan
                                    @can('administracion_access')
                                        <a class="dropdown-item disabled" href="#">
                                            {{ trans('cruds.administracion.title') }}
                                        </a>
                                    @endcan
                                    @can('asset_location_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.asset-locations.index') }}">
                                            {{ trans('cruds.assetLocation.title') }}
                                        </a>
                                    @endcan
                                    @can('parameter_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.parameters.index') }}">
                                            {{ trans('cruds.parameter.title') }}
                                        </a>
                                    @endcan
                                    @can('task_tag_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.task-tags.index') }}">
                                            {{ trans('cruds.taskTag.title') }}
                                        </a>
                                    @endcan
                                    @can('task_status_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.task-statuses.index') }}">
                                            {{ trans('cruds.taskStatus.title') }}
                                        </a>
                                    @endcan
                                    @can('asset_status_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.asset-statuses.index') }}">
                                            {{ trans('cruds.assetStatus.title') }}
                                        </a>
                                    @endcan
                                    @can('asset_category_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.asset-categories.index') }}">
                                            {{ trans('cruds.assetCategory.title') }}
                                        </a>
                                    @endcan
                                    @can('asset_sub_category_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.asset-sub-categories.index') }}">
                                            {{ trans('cruds.assetSubCategory.title') }}
                                        </a>
                                    @endcan
                                    @can('incidences_category_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.incidences-categories.index') }}">
                                            {{ trans('cruds.incidencesCategory.title') }}
                                        </a>
                                    @endcan
                                    @can('incidences_subcategory_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.incidences-subcategories.index') }}">
                                            {{ trans('cruds.incidencesSubcategory.title') }}
                                        </a>
                                    @endcan
                                    @can('mark_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.marks.index') }}">
                                            {{ trans('cruds.mark.title') }}
                                        </a>
                                    @endcan
                                    @can('sample_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.samples.index') }}">
                                            {{ trans('cruds.sample.title') }}
                                        </a>
                                    @endcan
                                    @can('network_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.networks.index') }}">
                                            {{ trans('cruds.network.title') }}
                                        </a>
                                    @endcan
                                    @can('zone_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.zones.index') }}">
                                            {{ trans('cruds.zone.title') }}
                                        </a>
                                    @endcan
                                    @can('area_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.areas.index') }}">
                                            {{ trans('cruds.area.title') }}
                                        </a>
                                    @endcan
                                    @can('province_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.provinces.index') }}">
                                            {{ trans('cruds.province.title') }}
                                        </a>
                                    @endcan
                                    @can('municipality_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.municipalities.index') }}">
                                            {{ trans('cruds.municipality.title') }}
                                        </a>
                                    @endcan
                                    @can('magnitude_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.magnitudes.index') }}">
                                            {{ trans('cruds.magnitude.title') }}
                                        </a>
                                    @endcan
                                    @can('unit_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.units.index') }}">
                                            {{ trans('cruds.unit.title') }}
                                        </a>
                                    @endcan
                                    @can('technique_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.techniques.index') }}">
                                            {{ trans('cruds.technique.title') }}
                                        </a>
                                    @endcan
                                    @can('calculation_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.calculations.index') }}">
                                            {{ trans('cruds.calculation.title') }}
                                        </a>
                                    @endcan
                                    @can('period_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.periods.index') }}">
                                            {{ trans('cruds.period.title') }}
                                        </a>
                                    @endcan
                                    @can('record_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.records.index') }}">
                                            {{ trans('cruds.record.title') }}
                                        </a>
                                    @endcan
                                    @can('user_alert_access')
                                        <a class="dropdown-item" href="{{ route('frontend.user-alerts.index') }}">
                                            {{ trans('cruds.userAlert.title') }}
                                        </a>
                                    @endcan

                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @if(session('message'))
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="alert alert-success" role="alert">{{ session('message') }}</div>
                        </div>
                    </div>
                </div>
            @endif
            @if($errors->count() > 0)
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="alert alert-danger">
                                <ul class="list-unstyled mb-0">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            @yield('content')
        </main>
    </div>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/1.5.0/perfect-scrollbar.min.js"></script>
<script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script src="//cdn.datatables.net/buttons/1.2.4/js/dataTables.buttons.min.js"></script>
<script src="//cdn.datatables.net/buttons/1.2.4/js/buttons.flash.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.colVis.min.js"></script>
<script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
<script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
<script src="https://cdn.datatables.net/select/1.3.0/js/dataTables.select.min.js"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/16.0.0/classic/ckeditor.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.full.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js"></script>
<script src="{{ asset('js/main.js') }}"></script>
@yield('scripts')

</html>
