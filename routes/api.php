<?php

Route::group(['prefix' => '/v1', 'namespace' => 'Api\V1', 'as' => 'api.'], function () {

        Route::resource('contact_companies', 'ContactCompaniesController', ['except' => ['create', 'edit']]);

        Route::resource('contacts', 'ContactsController', ['except' => ['create', 'edit']]);

        Route::resource('agents', 'AgentsController', ['except' => ['create', 'edit']]);

        Route::resource('ads', 'AdsController', ['except' => ['create', 'edit']]);

        Route::resource('networks', 'NetworksController', ['except' => ['create', 'edit']]);

        Route::resource('stations', 'StationsController', ['except' => ['create', 'edit']]);

        Route::resource('variables', 'VariablesController', ['except' => ['create', 'edit']]);

        Route::resource('ad_responses', 'AdResponsesController', ['except' => ['create', 'edit']]);

});
