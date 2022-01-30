<?php

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:api']], function () {
    // Permissions
    Route::apiResource('permissions', 'PermissionsApiController');

    // Roles
    Route::apiResource('roles', 'RolesApiController');

    // Users
    Route::apiResource('users', 'UsersApiController');

    // Task Statuses
    Route::apiResource('task-statuses', 'TaskStatusApiController');

    // Task Tags
    Route::apiResource('task-tags', 'TaskTagApiController');

    // Tasks
    Route::post('tasks/media', 'TaskApiController@storeMedia')->name('tasks.storeMedia');
    Route::apiResource('tasks', 'TaskApiController');

    // Asset Categories
    Route::apiResource('asset-categories', 'AssetCategoryApiController');

    // Asset Locations
    Route::apiResource('asset-locations', 'AssetLocationApiController');

    // Asset Statuses
    Route::apiResource('asset-statuses', 'AssetStatusApiController');

    // Assets
    Route::post('assets/media', 'AssetApiController@storeMedia')->name('assets.storeMedia');
    Route::apiResource('assets', 'AssetApiController');

    // Assets Histories
    Route::apiResource('assets-histories', 'AssetsHistoryApiController', ['except' => ['store', 'update', 'destroy']]);

    // Networks
    Route::apiResource('networks', 'NetworksApiController');

    // Zones
    Route::apiResource('zones', 'ZonesApiController');

    // Areas
    Route::apiResource('areas', 'AreasApiController');

    // Provinces
    Route::apiResource('provinces', 'ProvincesApiController');

    // Municipalities
    Route::apiResource('municipalities', 'MunicipalitiesApiController');

    // Marks
    Route::apiResource('marks', 'MarksApiController');

    // Samples
    Route::apiResource('samples', 'SamplesApiController');

    // Periods
    Route::apiResource('periods', 'PeriodsApiController');

    // Incidences Categories
    Route::apiResource('incidences-categories', 'IncidencesCategoriesApiController');

    // Incidences Subcategories
    Route::apiResource('incidences-subcategories', 'IncidencesSubcategoriesApiController');

    // Calculations
    Route::apiResource('calculations', 'CalculationsApiController');

    // Units
    Route::apiResource('units', 'UnitsApiController');

    // Techniques
    Route::apiResource('techniques', 'TechniquesApiController');

    // Asset Sub Categories
    Route::apiResource('asset-sub-categories', 'AssetSubCategoryApiController');

    // Magnitudes
    Route::apiResource('magnitudes', 'MagnitudesApiController');

    // Parameters
    Route::apiResource('parameters', 'ParametersApiController');

    // Records
    Route::post('records/media', 'RecordsApiController@storeMedia')->name('records.storeMedia');
    Route::apiResource('records', 'RecordsApiController', ['except' => ['update', 'destroy']]);

    // Jobs
    Route::apiResource('jobs', 'JobsApiController');
});
