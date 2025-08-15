<?php
use Illuminate\Support\Facades\Route;

Route::get('/','HomeController@index')->name('index');
Route::get('/404','HomeController@notFound')->name('notFound');
Route::get('/trends/{slug}','HomeController@trends')->name('trends');
Route::get('/city/{citySlug}/{subRegionSlug?}','HomeController@city')->name('city');
Route::get('/category/{categorySlug}','HomeController@category')->name('category');
Route::get('/map','HomeController@map')->name('map');
Route::get('/news','HomeController@news')->name('news');
Route::get('/news-details/{slug}','HomeController@newsDetails')->name('news-details');

Route::get('/company-detail/{slug}','HomeController@companyDetails')->name('companyDetails');

Route::get('/faqs','HomeController@faqs')->name('faqs');
Route::get('/about','HomeController@about')->name('about');
Route::get('/career','HomeController@career')->name('career');
Route::get('/how-we-work','HomeController@howWeWork')->name('how-we-work');
Route::get('/terms-of-use','HomeController@termsOfUse')->name('terms-of-use');
Route::get('/privacy-policy','HomeController@privacyPolicy')->name('privacy-policy');

Route::get('/search','HomeController@search')->name('search');
Route::get('/soon','HomeController@soon')->name('soon');
Route::get('/top','HomeController@top')->name('top');

Route::get('/services','HomeController@services')->name('services');
Route::get('/catalogues','HomeController@catalogues')->name('catalogues');
Route::get('/catalogues/{id}','HomeController@catalogDetails')->name('catalogDetails');
Route::get('/company','HomeController@companies')->name('companies');
//Route::get('/company/{id}','HomeController@companyDetails')->name('companyDetails');
Route::get('/contact','HomeController@contact')->name('contact');


///Start Ajax
Route::post('/company/share', 'AjaxController@companyShare')->name('companyShare');
Route::get('/map-data', 'AjaxController@mapAjax')->name('mapAjax');
Route::get('/parent-categories', 'AjaxController@parentCategories')->name('parentCategories');
Route::get('/main-cities', 'AjaxController@mainCities')->name('mainCities');
Route::get('/parent-cities', 'AjaxController@parentCities')->name('parentCities');
Route::post('/comments', 'AjaxController@comments')->name('comments');
Route::get('/comments/list/{id}', 'AjaxController@listComments')->name('comments.list');
/// End Ajax

///login register
Route::post('/login-accept', 'AuthController@loginAccept')->name('loginAccept');
Route::post('/register-accept', 'AuthController@registerAccept')->name('registerAccept');
Route::get('/company/accept/{token}/{id}', 'AuthController@companyAccept');
Route::get('/user/accept/{token}/{id}', 'AuthController@userAccept');
Route::post('/forgot-status', 'AuthController@forgotStatus')->name('forgotStatus');
Route::get('/forgot-password', 'AuthController@forgotPassword')->name('forgotPassword');
Route::post('/forgot-set-password', 'AuthController@forgotSetPassword')->name('forgotSetPassword');
///login register

Route::prefix('/company')->middleware('company')->group(function () {
    Route::get('/logout', 'Company\CompanyController@logout')->name('company.logout');
    Route::get('/account', 'Company\CompanyController@index')->name('company.index');
    Route::get('/announcements', 'Company\CompanyController@announcements')->name('company.announcements');
    Route::get('/settings', 'Company\CompanyController@settings')->name('company.settings');
    Route::resource('company-post','Company\CompanyPostController');
    Route::get('/sub-categories', 'Company\ServicesController@subCategories')->name('company.subCategories');
    Route::resource('company-services','Company\ServicesController');
    Route::resource('company-persons','Company\CompanyPersonsController');
    Route::get('/statistics', 'Company\CompanyController@statistics')->name('company.statistics');
    Route::get('/reservation', 'Company\CompanyController@reservation')->name('company.reservation');
    Route::put('/reservation-update/{id}', 'Company\CompanyController@reservationUpdate')->name('company.reservationUpdate');

    //premium hesab
    Route::post('/premiumRedirectToBank', 'Company\PremiumController@redirectToBank')->name('company.premium.redirectToBank');
    Route::post('/premiumPaymentCallback', 'Company\PremiumController@paymentCallback')->name('company.premium.paymentCallback');

    //ajax
    Route::get('/cities', 'Company\CompanyController@cities')->name('company.cities');
    Route::put('/settings/{id}', 'Company\CompanyController@settingsUpdate')->name('company.settings-update');
    Route::put('/settings-register/{id}', 'Company\CompanyController@settingsRegister')->name('company.settings-register');
    Route::put('/settings-password/{id}', 'Company\CompanyController@settingsPasswordUpdate')->name('company.settings-password-update');
    Route::post('/review-send', 'Company\CompanyController@reviewSend')->name('company.reviewSend');

});

//user
Route::prefix('/user')->middleware('user')->group(function () {
    //menu
    Route::get('/account', 'User\UserController@index')->name('user.index');
    Route::get('/settings', 'User\UserController@settings')->name('user.settings');
    Route::get('/announcements', 'User\UserController@announcements')->name('user.announcements');
    Route::get('/favorites', 'User\UserController@favorites')->name('user.favorites');
    Route::get('/review', 'User\UserController@review')->name('user.review');
    Route::get('/reservation', 'User\UserController@reservation')->name('user.reservation');
    Route::get('/logout', 'User\UserController@logout')->name('user.logout');

    //ajax
    Route::get('/cities', 'User\UserController@cities')->name('user.cities');
    Route::put('/settings/{id}', 'User\UserController@settingsUpdate')->name('user.settings-update');
    Route::put('/settings-password/{id}', 'User\UserController@settingsPasswordUpdate')->name('user.settings-password-update');
    Route::post('/like', 'User\UserController@like')->name('user.like');
    Route::post('/unlike', 'User\UserController@unlike')->name('user.unlike');
    Route::post('/reservation-send', 'User\UserController@reservationSend')->name('user.reservationSend');
    Route::post('/review-send', 'User\UserController@reviewSend')->name('user.reviewSend');

    //baxilacaq
    //Route::resource('user-post','User\UserPostController');
});
Route::fallback(function () {
    abort(404);
});
