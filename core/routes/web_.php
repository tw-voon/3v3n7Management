<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('landing_page');
});

Auth::routes();
Route::get('/reset/success', 'Auth\ResetPasswordController@success')->name('reset.success');
Route::get('/logout', 'Auth\LoginController@logout');

// for testing purposes
Route::get('/test', 'Auth\LoginController@test');

Route::group(['middleware' => ['web','auth']], function () {

	Route::get('/home', 'Web\eventDashboardController@index')->name('home');
	Route::get('/events_category', 'Web\EventsCategoryController@index')->name('event_cat.index');

	// AGENCY COMPANY PROFILE 
	Route::get('/agency', 'Web\agencyController@index')->name('agency.index');
	Route::get('/agency/new', 'Web\agencyController@create')->name('agency.create');
	Route::post('/agency/store', 'Web\agencyController@store')->name('agency.save');
	Route::get('/agency/edit/{id}', 'Web\agencyController@edit')->name('agency.edit');
	Route::post('/agency/update/{id}', 'Web\agencyController@update')->name('agency.update');

	// AGENCY USER
	Route::get('/agency/new_user', 'Web\AgencyApplicationController@create')->name('agency_user.create');
	Route::post('/agency/new_user', 'Web\AgencyApplicationController@store')->name('agency_user.save');
	Route::get('/agency/edit_user/{id}', 'Web\AgencyApplicationController@edit')->name('agency_user.edit');
	Route::post('/agency/edit_user/{id}', 'Web\AgencyApplicationController@update')->name('agency_user.update');
	Route::post('agency/remove_user/{id}', 'Web\AgencyApplicationController@remove')->name('agency_user.remove_user');

	// EVENT 
	Route::get('/events/view/{id}', 'Web\EventsController@view')->name('event.view');
	Route::get('/events', 'Web\EventsController@index')->name('event.index');

	// EVENT CATEGORY
	Route::get('/events_category/new', 'Web\EventsCategoryController@create')->name('event_cat.create');
	Route::post('/events_category/store', 'Web\EventsCategoryController@store')->name('event_cat.save');
	Route::get('/events_category/edit/{id}', 'Web\EventsCategoryController@edit')->name('event_cat.edit');
	Route::post('/events_category/update/{id}', 'Web\EventsCategoryController@update')->name('event_cat.update');

	// APP USER
	Route::get('/app_user', 'Web\AppUserController@index')->name('app_user.index');
	Route::get('/app_user/new', 'Web\AppUserController@create')->name('app_user.create');
	Route::get('/app_user/edit/{id}', 'Web\AppUserController@edit')->name('app_user.edit');
	Route::post('/app_user/store', 'Web\AppUserController@store')->name('app_user.save');
	Route::post('/app_user/update/{id}', 'Web\AppUserController@update')->name('app_user.update');

	// mail controller
	Route::get('testmail', 'Web\eventMailController@send');

	// Event Reporting
	Route::get('report/index', 'Web\eventReportController@index')->name('report.index');
	Route::get('report/monthly', 'Web\eventReportController@monthly')->name('report.monthly');
	Route::get('report/agency', 'Web\eventReportController@agency_report')->name('report.agency');
	Route::get('report/roles_user', 'Web\eventReportController@app_user_report')->name('report.roles_user');

	// Push Notification
	Route::get('notify/test', 'Web\eventPushNotification@sendMessage')->name('notify.test');

	// Apps Info Page
	Route::get('info/index', 'Web\eventAppsInfo@index')->name('info.index');
	Route::post('info/save', 'Web\eventAppsInfo@store')->name('info.save');

	// System profile
	Route::get('profile','Web\eventAppsInfo@profile')->name('profile.info');

});

