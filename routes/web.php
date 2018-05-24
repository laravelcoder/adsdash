<?php
Route::get('/', function () { return redirect('/admin/home'); });

// Authentication Routes...
$this->get('login', 'Auth\LoginController@showLoginForm')->name('login');
$this->post('login', 'Auth\LoginController@login')->name('auth.login');
$this->post('logout', 'Auth\LoginController@logout')->name('auth.logout');

// Change Password Routes...
$this->get('change_password', 'Auth\ChangePasswordController@showChangePasswordForm')->name('auth.change_password');
$this->patch('change_password', 'Auth\ChangePasswordController@changePassword')->name('auth.change_password');

// Password Reset Routes...
$this->get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('auth.password.reset');
$this->post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('auth.password.reset');
$this->get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
$this->post('password/reset', 'Auth\ResetPasswordController@reset')->name('auth.password.reset');

Route::group(['middleware' => ['auth'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('/home', 'HomeController@index');
    
    Route::resource('ads_dashboards', 'Admin\AdsDashboardsController');
    Route::resource('contact_companies', 'Admin\ContactCompaniesController');
    Route::post('contact_companies_mass_destroy', ['uses' => 'Admin\ContactCompaniesController@massDestroy', 'as' => 'contact_companies.mass_destroy']);
    Route::resource('contacts', 'Admin\ContactsController');
    Route::post('contacts_mass_destroy', ['uses' => 'Admin\ContactsController@massDestroy', 'as' => 'contacts.mass_destroy']);
    Route::resource('profiles', 'Admin\ProfilesController');
    Route::post('profiles_mass_destroy', ['uses' => 'Admin\ProfilesController@massDestroy', 'as' => 'profiles.mass_destroy']);
    Route::post('profiles_restore/{id}', ['uses' => 'Admin\ProfilesController@restore', 'as' => 'profiles.restore']);
    Route::delete('profiles_perma_del/{id}', ['uses' => 'Admin\ProfilesController@perma_del', 'as' => 'profiles.perma_del']);
    Route::resource('ads', 'Admin\AdsController');
    Route::post('ads_mass_destroy', ['uses' => 'Admin\AdsController@massDestroy', 'as' => 'ads.mass_destroy']);
    Route::post('ads_restore/{id}', ['uses' => 'Admin\AdsController@restore', 'as' => 'ads.restore']);
    Route::delete('ads_perma_del/{id}', ['uses' => 'Admin\AdsController@perma_del', 'as' => 'ads.perma_del']);
    Route::resource('ad_types', 'Admin\AdTypesController');
    Route::post('ad_types_mass_destroy', ['uses' => 'Admin\AdTypesController@massDestroy', 'as' => 'ad_types.mass_destroy']);
    Route::get('internal_notifications/read', 'Admin\InternalNotificationsController@read');
    Route::resource('internal_notifications', 'Admin\InternalNotificationsController');
    Route::post('internal_notifications_mass_destroy', ['uses' => 'Admin\InternalNotificationsController@massDestroy', 'as' => 'internal_notifications.mass_destroy']);
    Route::resource('channels', 'Admin\ChannelsController');
    Route::post('channels_mass_destroy', ['uses' => 'Admin\ChannelsController@massDestroy', 'as' => 'channels.mass_destroy']);
    Route::post('channels_restore/{id}', ['uses' => 'Admin\ChannelsController@restore', 'as' => 'channels.restore']);
    Route::delete('channels_perma_del/{id}', ['uses' => 'Admin\ChannelsController@perma_del', 'as' => 'channels.perma_del']);
    Route::resource('content_categories', 'Admin\ContentCategoriesController');
    Route::post('content_categories_mass_destroy', ['uses' => 'Admin\ContentCategoriesController@massDestroy', 'as' => 'content_categories.mass_destroy']);
    Route::resource('content_tags', 'Admin\ContentTagsController');
    Route::post('content_tags_mass_destroy', ['uses' => 'Admin\ContentTagsController@massDestroy', 'as' => 'content_tags.mass_destroy']);
    Route::resource('content_pages', 'Admin\ContentPagesController');
    Route::post('content_pages_mass_destroy', ['uses' => 'Admin\ContentPagesController@massDestroy', 'as' => 'content_pages.mass_destroy']);
    Route::resource('permissions', 'Admin\PermissionsController');
    Route::post('permissions_mass_destroy', ['uses' => 'Admin\PermissionsController@massDestroy', 'as' => 'permissions.mass_destroy']);
    Route::resource('roles', 'Admin\RolesController');
    Route::post('roles_mass_destroy', ['uses' => 'Admin\RolesController@massDestroy', 'as' => 'roles.mass_destroy']);
    Route::resource('users', 'Admin\UsersController');
    Route::post('users_mass_destroy', ['uses' => 'Admin\UsersController@massDestroy', 'as' => 'users.mass_destroy']);
    Route::resource('teams', 'Admin\TeamsController');
    Route::post('teams_mass_destroy', ['uses' => 'Admin\TeamsController@massDestroy', 'as' => 'teams.mass_destroy']);
    Route::resource('assets', 'Admin\AssetsController');
    Route::post('assets_mass_destroy', ['uses' => 'Admin\AssetsController@massDestroy', 'as' => 'assets.mass_destroy']);
    Route::resource('assets_categories', 'Admin\AssetsCategoriesController');
    Route::post('assets_categories_mass_destroy', ['uses' => 'Admin\AssetsCategoriesController@massDestroy', 'as' => 'assets_categories.mass_destroy']);
    Route::resource('assets_locations', 'Admin\AssetsLocationsController');
    Route::post('assets_locations_mass_destroy', ['uses' => 'Admin\AssetsLocationsController@massDestroy', 'as' => 'assets_locations.mass_destroy']);
    Route::resource('assets_statuses', 'Admin\AssetsStatusesController');
    Route::post('assets_statuses_mass_destroy', ['uses' => 'Admin\AssetsStatusesController@massDestroy', 'as' => 'assets_statuses.mass_destroy']);
    Route::resource('assets_histories', 'Admin\AssetsHistoriesController');
    Route::resource('clients', 'Admin\ClientsController');
    Route::post('clients_mass_destroy', ['uses' => 'Admin\ClientsController@massDestroy', 'as' => 'clients.mass_destroy']);
    Route::resource('client_projects', 'Admin\ClientProjectsController');
    Route::post('client_projects_mass_destroy', ['uses' => 'Admin\ClientProjectsController@massDestroy', 'as' => 'client_projects.mass_destroy']);
    Route::resource('client_notes', 'Admin\ClientNotesController');
    Route::post('client_notes_mass_destroy', ['uses' => 'Admin\ClientNotesController@massDestroy', 'as' => 'client_notes.mass_destroy']);
    Route::resource('client_documents', 'Admin\ClientDocumentsController');
    Route::post('client_documents_mass_destroy', ['uses' => 'Admin\ClientDocumentsController@massDestroy', 'as' => 'client_documents.mass_destroy']);
    Route::resource('client_transactions', 'Admin\ClientTransactionsController');
    Route::post('client_transactions_mass_destroy', ['uses' => 'Admin\ClientTransactionsController@massDestroy', 'as' => 'client_transactions.mass_destroy']);
    Route::resource('client_currencies', 'Admin\ClientCurrenciesController');
    Route::post('client_currencies_mass_destroy', ['uses' => 'Admin\ClientCurrenciesController@massDestroy', 'as' => 'client_currencies.mass_destroy']);
    Route::resource('client_transaction_types', 'Admin\ClientTransactionTypesController');
    Route::post('client_transaction_types_mass_destroy', ['uses' => 'Admin\ClientTransactionTypesController@massDestroy', 'as' => 'client_transaction_types.mass_destroy']);
    Route::resource('client_income_sources', 'Admin\ClientIncomeSourcesController');
    Route::post('client_income_sources_mass_destroy', ['uses' => 'Admin\ClientIncomeSourcesController@massDestroy', 'as' => 'client_income_sources.mass_destroy']);
    Route::resource('client_statuses', 'Admin\ClientStatusesController');
    Route::post('client_statuses_mass_destroy', ['uses' => 'Admin\ClientStatusesController@massDestroy', 'as' => 'client_statuses.mass_destroy']);
    Route::resource('client_project_statuses', 'Admin\ClientProjectStatusesController');
    Route::post('client_project_statuses_mass_destroy', ['uses' => 'Admin\ClientProjectStatusesController@massDestroy', 'as' => 'client_project_statuses.mass_destroy']);
    Route::resource('audiences', 'Admin\AudiencesController');
    Route::post('audiences_mass_destroy', ['uses' => 'Admin\AudiencesController@massDestroy', 'as' => 'audiences.mass_destroy']);
    Route::post('audiences_restore/{id}', ['uses' => 'Admin\AudiencesController@restore', 'as' => 'audiences.restore']);
    Route::delete('audiences_perma_del/{id}', ['uses' => 'Admin\AudiencesController@perma_del', 'as' => 'audiences.perma_del']);
    Route::resource('demographics', 'Admin\DemographicsController');
    Route::post('demographics_mass_destroy', ['uses' => 'Admin\DemographicsController@massDestroy', 'as' => 'demographics.mass_destroy']);
    Route::post('demographics_restore/{id}', ['uses' => 'Admin\DemographicsController@restore', 'as' => 'demographics.restore']);
    Route::delete('demographics_perma_del/{id}', ['uses' => 'Admin\DemographicsController@perma_del', 'as' => 'demographics.perma_del']);
    Route::resource('user_bases', 'Admin\UserBasesController');
    Route::post('user_bases_mass_destroy', ['uses' => 'Admin\UserBasesController@massDestroy', 'as' => 'user_bases.mass_destroy']);
    Route::post('user_bases_restore/{id}', ['uses' => 'Admin\UserBasesController@restore', 'as' => 'user_bases.restore']);
    Route::delete('user_bases_perma_del/{id}', ['uses' => 'Admin\UserBasesController@perma_del', 'as' => 'user_bases.perma_del']);
    Route::resource('variables', 'Admin\VariablesController');
    Route::post('variables_mass_destroy', ['uses' => 'Admin\VariablesController@massDestroy', 'as' => 'variables.mass_destroy']);
    Route::post('variables_restore/{id}', ['uses' => 'Admin\VariablesController@restore', 'as' => 'variables.restore']);
    Route::delete('variables_perma_del/{id}', ['uses' => 'Admin\VariablesController@perma_del', 'as' => 'variables.perma_del']);

    Route::model('messenger', 'App\MessengerTopic');
    Route::get('messenger/inbox', 'Admin\MessengerController@inbox')->name('messenger.inbox');
    Route::get('messenger/outbox', 'Admin\MessengerController@outbox')->name('messenger.outbox');
    Route::resource('messenger', 'Admin\MessengerController');


    Route::get('search', 'MegaSearchController@search')->name('mega-search');
    Route::get('language/{lang}', function ($lang) {
        return redirect()->back()->withCookie(cookie()->forever('language', $lang));
    })->name('language');});
