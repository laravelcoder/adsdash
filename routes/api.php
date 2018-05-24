<?php

Route::group(['prefix' => '/v1', 'namespace' => 'Api\V1', 'as' => 'api.'], function () {

        Route::resource('networks', 'NetworksController', ['except' => ['create', 'edit']]);

        Route::resource('contact_companies', 'ContactCompaniesController', ['except' => ['create', 'edit']]);

        Route::resource('profiles', 'ProfilesController', ['except' => ['create', 'edit']]);

        Route::resource('ads', 'AdsController', ['except' => ['create', 'edit']]);

        Route::resource('ad_types', 'AdTypesController', ['except' => ['create', 'edit']]);

        Route::resource('variables', 'VariablesController', ['except' => ['create', 'edit']]);

        Route::resource('stations', 'StationsController', ['except' => ['create', 'edit']]);

});
