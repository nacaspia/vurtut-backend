<?php
use Illuminate\Support\Facades\Route;

Route::get('/login', 'AuthController@login')->name('login');
Route::post('/admin/loginAccept', 'AuthController@loginAccept')->name('loginAccept');

Route::middleware('admin')->group(function () {
    Route::get('/logout', 'AuthController@logout')->name('logout');
    Route::get('/home', 'HomeController@index')->name('index');

    Route::resource('roles','RoleController');

    Route::resource('permissions','PermissionController');

    Route::resource('cms-users', 'CmsUserController');
    Route::get('cms-users/logs/{id}', 'CmsUserController@logs')->name('cms-users.logs');

    Route::resource('translations', 'TranslationsController');
    Route::post('translations/status/{id}', 'TranslationsController@status')->name('translations.status');

    Route::resource('category', 'CategoryController');

    Route::resource('companies', 'CompaniesController');
    Route::get('companies/logs/{id}', 'CompaniesController@logs')->name('companies.logs');
    Route::post('companies/service/status', 'CompaniesController@companyServiceSetStatus')->name('companies.companyServiceSetStatus');
    Route::post('companies/person/status', 'CompaniesController@companyPerson')->name('companies.companyPerson');

    Route::resource('users', 'UsersController');
    Route::get('users/logs/{id}', 'UsersController@logs')->name('users.logs');

    Route::resource('static-page', 'StaticPageController');

    Route::resource('country', 'CountryController');

    Route::resource('city', 'CityController');

    Route::get('settings', 'SettingsController@settings')->name('settings');
    Route::post('settings/save', 'SettingsController@settingsSave')->name('settingsSave');
    Route::put('settings/update/{id}', 'SettingsController@settingsUpdate')->name('settingsUpdate');
});
