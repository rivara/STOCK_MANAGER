<?php


//Route::view('/', 'auth.login');



Route::get('/', function () {
    return redirect('dnota/home');
});





Auth::routes(['register' => false]);

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth', 'admin']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::post('users/parse-csv-import', 'UsersController@parseCsvImport')->name('users.parseCsvImport');
    Route::post('users/process-csv-import', 'UsersController@processCsvImport')->name('users.processCsvImport');
    Route::resource('users', 'UsersController');

    // Audit Logs
    Route::resource('audit-logs', 'AuditLogsController', ['except' => ['create', 'store', 'edit', 'update', 'destroy']]);

    // Task Statuses
    Route::delete('task-statuses/destroy', 'TaskStatusController@massDestroy')->name('task-statuses.massDestroy');
    Route::resource('task-statuses', 'TaskStatusController');

    // Task Tags
    Route::delete('task-tags/destroy', 'TaskTagController@massDestroy')->name('task-tags.massDestroy');
    Route::resource('task-tags', 'TaskTagController');

    // Tasks
    Route::delete('tasks/destroy', 'TaskController@massDestroy')->name('tasks.massDestroy');
    Route::post('tasks/media', 'TaskController@storeMedia')->name('tasks.storeMedia');
    Route::post('tasks/ckmedia', 'TaskController@storeCKEditorImages')->name('tasks.storeCKEditorImages');
    Route::post('tasks/parse-csv-import', 'TaskController@parseCsvImport')->name('tasks.parseCsvImport');
    Route::post('tasks/process-csv-import', 'TaskController@processCsvImport')->name('tasks.processCsvImport');
    Route::resource('tasks', 'TaskController');

    // Tasks Calendars
    Route::resource('tasks-calendars', 'TasksCalendarController', ['except' => ['create', 'store', 'edit', 'update', 'show', 'destroy']]);

    // Asset Categories
    Route::delete('asset-categories/destroy', 'AssetCategoryController@massDestroy')->name('asset-categories.massDestroy');
    Route::resource('asset-categories', 'AssetCategoryController');

    // Asset Locations
    Route::delete('asset-locations/destroy', 'AssetLocationController@massDestroy')->name('asset-locations.massDestroy');
    Route::post('asset-locations/parse-csv-import', 'AssetLocationController@parseCsvImport')->name('asset-locations.parseCsvImport');
    Route::post('asset-locations/process-csv-import', 'AssetLocationController@processCsvImport')->name('asset-locations.processCsvImport');
    Route::resource('asset-locations', 'AssetLocationController');

    // Asset Statuses
    Route::delete('asset-statuses/destroy', 'AssetStatusController@massDestroy')->name('asset-statuses.massDestroy');
    Route::resource('asset-statuses', 'AssetStatusController');

    // Assets
    Route::delete('assets/destroy', 'AssetController@massDestroy')->name('assets.massDestroy');
    Route::post('assets/media', 'AssetController@storeMedia')->name('assets.storeMedia');
    Route::post('assets/ckmedia', 'AssetController@storeCKEditorImages')->name('assets.storeCKEditorImages');
    Route::post('assets/parse-csv-import', 'AssetController@parseCsvImport')->name('assets.parseCsvImport');
    Route::post('assets/process-csv-import', 'AssetController@processCsvImport')->name('assets.processCsvImport');
    Route::resource('assets', 'AssetController');

    // Assets Histories
    Route::post('assets-histories/parse-csv-import', 'AssetsHistoryController@parseCsvImport')->name('assets-histories.parseCsvImport');
    Route::post('assets-histories/process-csv-import', 'AssetsHistoryController@processCsvImport')->name('assets-histories.processCsvImport');
    Route::resource('assets-histories', 'AssetsHistoryController', ['except' => ['create', 'store', 'edit', 'update', 'destroy']]);

    // User Alerts
    Route::delete('user-alerts/destroy', 'UserAlertsController@massDestroy')->name('user-alerts.massDestroy');
    Route::resource('user-alerts', 'UserAlertsController', ['except' => ['edit', 'update']]);

    // Networks
    Route::delete('networks/destroy', 'NetworksController@massDestroy')->name('networks.massDestroy');
    Route::resource('networks', 'NetworksController');

    // Zones
    Route::delete('zones/destroy', 'ZonesController@massDestroy')->name('zones.massDestroy');
    Route::resource('zones', 'ZonesController');

    // Areas
    Route::delete('areas/destroy', 'AreasController@massDestroy')->name('areas.massDestroy');
    Route::resource('areas', 'AreasController');

    // Provinces
    Route::delete('provinces/destroy', 'ProvincesController@massDestroy')->name('provinces.massDestroy');
    Route::resource('provinces', 'ProvincesController');

    // Municipalities
    Route::delete('municipalities/destroy', 'MunicipalitiesController@massDestroy')->name('municipalities.massDestroy');
    Route::resource('municipalities', 'MunicipalitiesController');

    // Marks
    Route::delete('marks/destroy', 'MarksController@massDestroy')->name('marks.massDestroy');
    Route::resource('marks', 'MarksController');

    // Samples
    Route::delete('samples/destroy', 'SamplesController@massDestroy')->name('samples.massDestroy');
    Route::resource('samples', 'SamplesController');

    // Periods
    Route::delete('periods/destroy', 'PeriodsController@massDestroy')->name('periods.massDestroy');
    Route::resource('periods', 'PeriodsController');

    // Incidences Categories
    Route::delete('incidences-categories/destroy', 'IncidencesCategoriesController@massDestroy')->name('incidences-categories.massDestroy');
    Route::resource('incidences-categories', 'IncidencesCategoriesController');

    // Incidences Subcategories
    Route::delete('incidences-subcategories/destroy', 'IncidencesSubcategoriesController@massDestroy')->name('incidences-subcategories.massDestroy');
    Route::resource('incidences-subcategories', 'IncidencesSubcategoriesController');

    // Calculations
    Route::delete('calculations/destroy', 'CalculationsController@massDestroy')->name('calculations.massDestroy');
    Route::resource('calculations', 'CalculationsController');

    // Units
    Route::delete('units/destroy', 'UnitsController@massDestroy')->name('units.massDestroy');
    Route::resource('units', 'UnitsController');

    // Techniques
    Route::delete('techniques/destroy', 'TechniquesController@massDestroy')->name('techniques.massDestroy');
    Route::resource('techniques', 'TechniquesController');

    // Asset Sub Categories
    Route::delete('asset-sub-categories/destroy', 'AssetSubCategoryController@massDestroy')->name('asset-sub-categories.massDestroy');
    Route::resource('asset-sub-categories', 'AssetSubCategoryController');

    // Magnitudes
    Route::delete('magnitudes/destroy', 'MagnitudesController@massDestroy')->name('magnitudes.massDestroy');
    Route::resource('magnitudes', 'MagnitudesController');

    // Parameters
    Route::delete('parameters/destroy', 'ParametersController@massDestroy')->name('parameters.massDestroy');
    Route::post('parameters/parse-csv-import', 'ParametersController@parseCsvImport')->name('parameters.parseCsvImport');
    Route::post('parameters/process-csv-import', 'ParametersController@processCsvImport')->name('parameters.processCsvImport');
    Route::resource('parameters', 'ParametersController');

    // Records
    Route::post('records/media', 'RecordsController@storeMedia')->name('records.storeMedia');
    Route::post('records/ckmedia', 'RecordsController@storeCKEditorImages')->name('records.storeCKEditorImages');
    Route::resource('records', 'RecordsController', ['except' => ['edit', 'update', 'destroy']]);

    // Jobs
    Route::delete('jobs/destroy', 'JobsController@massDestroy')->name('jobs.massDestroy');
    Route::resource('jobs', 'JobsController');

    Route::get('messenger', 'MessengerController@index')->name('messenger.index');
    Route::get('messenger/create', 'MessengerController@createTopic')->name('messenger.createTopic');
    Route::post('messenger', 'MessengerController@storeTopic')->name('messenger.storeTopic');
    Route::get('messenger/inbox', 'MessengerController@showInbox')->name('messenger.showInbox');
    Route::get('messenger/outbox', 'MessengerController@showOutbox')->name('messenger.showOutbox');
    Route::get('messenger/{topic}', 'MessengerController@showMessages')->name('messenger.showMessages');
    Route::delete('messenger/{topic}', 'MessengerController@destroyTopic')->name('messenger.destroyTopic');
    Route::post('messenger/{topic}/reply', 'MessengerController@replyToTopic')->name('messenger.reply');
    Route::get('messenger/{topic}/reply', 'MessengerController@showReply')->name('messenger.showReply');
    Route::get('user-alerts/read', 'UserAlertsController@read');
});
Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth']], function () {
    // Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
        Route::post('profile', 'ChangePasswordController@updateProfile')->name('password.updateProfile');
        Route::post('profile/destroy', 'ChangePasswordController@destroy')->name('password.destroyProfile');
    }
});
//Dnota
Route::group(['prefix' => 'dnota', 'as' => 'dnota.', 'namespace' => 'dnota', 'middleware' => ['auth']], function () {
    //home
    Route::get('home',  'HomeController@index')->name('home');
    Route::post('home', 'DnotaController@EquiposProvincias')->name('home');
    Route::get('home/p', ['uses' => 'DnotaController@EquiposZona', 'as' => 'listado_equipos']);
    Route::get('dnota/eliminarEquipo', 'DnotaController@eliminarEquipo')->name('eliminarEquipo');
    Route::get('EditarEquipo', 'DnotaController@editarEquipo')->name('editarEquipo');
    Route::post('ActualizarEquipo', 'DnotaController@actualizarEquipo')->name('actualizarEquipo');
    Route::get('EstacionDetalle', 'DnotaController@EstacionDetalle')->name('EstacionDetalle');
    Route::get('EstacionDetalle/p', ['uses' => 'DnotaController@EstacionDetalleDatatable', 'as' => 'listado_tareas_locales']);
    Route::get('Registros/p', ['uses' => 'DnotaController@RegistroeDatatable', 'as' => 'listado_registros']);

    //Actuaciones pendientes
    Route::get('ActuacionesPendientes', 'DnotaController@ActuacionesPendientes')->name('ActuacionesPendientes');
    Route::get('ActuacionesPendientesDetalle', ['uses' => 'DnotaController@ActuacionesPendientesDetalleDatatable', 'as' => 'listado_tareas_globales_Act']);
    Route::get('dnota/eliminarActuacionPendiente', 'DnotaController@eliminarActuacionPendiente')->name('eliminarActuacionPendiente');
    Route::get('EditarActuacionPendiente', 'DnotaController@editarActuacionPendiente')->name('editarActuacionPendiente');
    Route::post('ActualizarActuacionPendiente', 'DnotaController@ActualizarActuacionPendiente')->name('ActualizarActuacionPendiente');
    Route::post('BuscaSubincidencia', 'DnotaController@BuscaSubincidencia');
    
    // Actuaciones por equipo
    Route::get('ActuacionesPorEquipo', 'DnotaController@ActuacionesPorEquipo')->name('ActuacionesPorEquipo');
    Route::get('ActuacionesPorEquipoDetalle', ['uses' => 'DnotaController@ActuacionesPorEquipoDetalle', 'as' => 'listado_tareas_globales_act_porEquipo']);
    Route::get('dnota/eliminarActuacionesPorEquipo', 'DnotaController@eliminarActuacionesPorEquipo')->name('eliminarActuacionesPorEquipo');
    Route::get('EditarActuacionesPorEquipo', 'DnotaController@editarActuacionesPorEquipo')->name('editarActuacionesPorEquipo');
    Route::post('ActualizarActuacionesPorEquipo', 'DnotaController@ActualizarActuacionesPorEquipo')->name('ActualizarActuacionesPorEquipo');
    Route::get('CrearAccion', 'DnotaController@CrearAccion')->name('CrearAccion');
    Route::post('BuscaEquipos', 'DnotaController@BuscaEquipos');
    Route::post('GrabaAccion', 'DnotaController@GrabaAccion')->name('GrabaAccion');
    Route::get('GrabaPatrones', 'DnotaController@GrabaPatrones')->name('GrabaPatrones');
    Route::get('Registros', 'DnotaController@Registros')->name('Registros');
    Route::get('EditarRegistros', 'DnotaController@EditarRegistros')->name('EditarRegistros');
    Route::post('ActualizarRegistro', 'DnotaController@ActualizarRegistro')->name('ActualizarRegistro');
    Route::get('ActuacionesPorEquipoBack', 'DnotaController@ActuacionesPorEquipoBack')->name('ActuacionesPorEquipoBack');
    
    //Equipos
    Route::get('Equipos', 'DnotaController@Equipos')->name('Equipos');
    Route::post('Equipos', 'DnotaController@SubCategorias');
    Route::get('EquiposDetalles', ['uses' => 'DnotaController@EquiposDetalleDatatable', 'as' => 'listado_equipos_2']);
    Route::get('EquiposHistorico', 'DnotaController@EquiposHistorico')->name('EquiposHistorico');
    Route::get('EquiposDetalle', ['uses' => 'DnotaController@EquipoHistorico', 'as' => 'listado_historicos_equipos']);

    //Planificacion
    Route::get('Planificacion', 'DnotaController@Planificacion')->name('Planificacion');
    Route::post('Planificacion', 'DnotaController@PlanificacionCalendario');
    Route::get('editarTarea/{id}', 'DnotaController@editarTarea')->name('editarTarea');
    // Route::post('actualizarTarea', 'DnotaController@actualizarTarea')->name('actualizarTarea');
    Route::post('tarea', 'DnotaController@tarea')->name('tarea');


    //Administracion
    Route::get('Admin', 'DnotaController@AdminIndex');
    Route::get('Admin/p', ['uses' => 'DnotaController@Admin', 'as' => 'listado_usuarios']);
});

//Frontend
Route::group(['as' => 'frontend.', 'namespace' => 'Frontend', 'middleware' => ['auth']], function () {
    Route::get('/home', 'HomeController@index')->name('home');

    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // Audit Logs
    Route::resource('audit-logs', 'AuditLogsController', ['except' => ['create', 'store', 'edit', 'update', 'destroy']]);

    // Task Statuses
    Route::delete('task-statuses/destroy', 'TaskStatusController@massDestroy')->name('task-statuses.massDestroy');
    Route::resource('task-statuses', 'TaskStatusController');

    // Task Tags
    Route::delete('task-tags/destroy', 'TaskTagController@massDestroy')->name('task-tags.massDestroy');
    Route::resource('task-tags', 'TaskTagController');

    // Tasks
    Route::delete('tasks/destroy', 'TaskController@massDestroy')->name('tasks.massDestroy');
    Route::resource('tasks', 'TaskController');

    // Tasks Calendars
    Route::resource('tasks-calendars', 'TasksCalendarController', ['except' => ['create', 'store', 'edit', 'update', 'show', 'destroy']]);

    // Asset Categories
    Route::delete('asset-categories/destroy', 'AssetCategoryController@massDestroy')->name('asset-categories.massDestroy');
    Route::resource('asset-categories', 'AssetCategoryController');

    // Asset Locations
    Route::delete('asset-locations/destroy', 'AssetLocationController@massDestroy')->name('asset-locations.massDestroy');
    Route::resource('asset-locations', 'AssetLocationController');

    // Asset Statuses
    Route::delete('asset-statuses/destroy', 'AssetStatusController@massDestroy')->name('asset-statuses.massDestroy');
    Route::resource('asset-statuses', 'AssetStatusController');

    // Assets
    Route::delete('assets/destroy', 'AssetController@massDestroy')->name('assets.massDestroy');
    Route::resource('assets', 'AssetController');

    // Assets Histories
    Route::resource('assets-histories', 'AssetsHistoryController', ['except' => ['create', 'store', 'edit', 'update', 'destroy']]);

    // User Alerts
    Route::delete('user-alerts/destroy', 'UserAlertsController@massDestroy')->name('user-alerts.massDestroy');
    Route::resource('user-alerts', 'UserAlertsController', ['except' => ['edit', 'update']]);

    // Networks
    Route::delete('networks/destroy', 'NetworksController@massDestroy')->name('networks.massDestroy');
    Route::resource('networks', 'NetworksController');

    // Zones
    Route::delete('zones/destroy', 'ZonesController@massDestroy')->name('zones.massDestroy');
    Route::resource('zones', 'ZonesController');

    // Areas
    Route::delete('areas/destroy', 'AreasController@massDestroy')->name('areas.massDestroy');
    Route::resource('areas', 'AreasController');

    // Provinces
    Route::delete('provinces/destroy', 'ProvincesController@massDestroy')->name('provinces.massDestroy');
    Route::resource('provinces', 'ProvincesController');

    // Municipalities
    Route::delete('municipalities/destroy', 'MunicipalitiesController@massDestroy')->name('municipalities.massDestroy');
    Route::resource('municipalities', 'MunicipalitiesController');

    // Marks
    Route::delete('marks/destroy', 'MarksController@massDestroy')->name('marks.massDestroy');
    Route::resource('marks', 'MarksController');

    // Samples
    Route::delete('samples/destroy', 'SamplesController@massDestroy')->name('samples.massDestroy');
    Route::resource('samples', 'SamplesController');

    // Periods
    Route::delete('periods/destroy', 'PeriodsController@massDestroy')->name('periods.massDestroy');
    Route::resource('periods', 'PeriodsController');

    // Incidences Categories
    Route::delete('incidences-categories/destroy', 'IncidencesCategoriesController@massDestroy')->name('incidences-categories.massDestroy');
    Route::resource('incidences-categories', 'IncidencesCategoriesController');

    // Incidences Subcategories
    Route::delete('incidences-subcategories/destroy', 'IncidencesSubcategoriesController@massDestroy')->name('incidences-subcategories.massDestroy');
    Route::resource('incidences-subcategories', 'IncidencesSubcategoriesController');

    // Calculations
    Route::delete('calculations/destroy', 'CalculationsController@massDestroy')->name('calculations.massDestroy');
    Route::resource('calculations', 'CalculationsController');

    // Units
    Route::delete('units/destroy', 'UnitsController@massDestroy')->name('units.massDestroy');
    Route::resource('units', 'UnitsController');

    // Techniques
    Route::delete('techniques/destroy', 'TechniquesController@massDestroy')->name('techniques.massDestroy');
    Route::resource('techniques', 'TechniquesController');

    // Asset Sub Categories
    Route::delete('asset-sub-categories/destroy', 'AssetSubCategoryController@massDestroy')->name('asset-sub-categories.massDestroy');
    Route::resource('asset-sub-categories', 'AssetSubCategoryController');

    // Magnitudes
    Route::delete('magnitudes/destroy', 'MagnitudesController@massDestroy')->name('magnitudes.massDestroy');
    Route::resource('magnitudes', 'MagnitudesController');

    // Parameters
    Route::delete('parameters/destroy', 'ParametersController@massDestroy')->name('parameters.massDestroy');
    Route::resource('parameters', 'ParametersController');

    // Records
    Route::resource('records', 'RecordsController', ['except' => ['edit', 'update', 'destroy']]);

    // Jobs
    Route::delete('jobs/destroy', 'JobsController@massDestroy')->name('jobs.massDestroy');
    Route::resource('jobs', 'JobsController');

    Route::get('frontend/profile', 'ProfileController@index')->name('profile.index');
    Route::post('frontend/profile/destroy', 'ProfileController@destroy')->name('profile.destroy');
    Route::post('frontend/profile/password', 'ProfileController@password')->name('profile.password');
});
