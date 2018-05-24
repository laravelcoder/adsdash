<?php

Route::group(['prefix' => '/v1', 'namespace' => 'Api\V1', 'as' => 'api.'], function () {

        Route::resource('channels', 'ChannelsController', ['except' => ['create', 'edit']]);

        Route::resource('profiles', 'ProfilesController', ['except' => ['create', 'edit']]);

});
