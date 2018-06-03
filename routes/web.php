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


Route::get('rates/getrate', 'RatesController@getrate');
Route::post('save/order', 'OrderController@index');
Route::get('thankyou', 'OrderController@thankyou');
Route::get('data/getcondos', 'HomeController@getcondos');
Route::get('data/getresorts', 'HomeController@getresorts');
Route::get('data/getreservationdata', 'HomeController@getreservationdata');
Route::get('/resorts/{resortname}/{bedrooms?}', 'HomeController@resorts');
Route::any('/', 'HomeController@index');

//ADMIN SECTION
Route::any('/admin/', 'AdminController@index');
Route::any('/admin/reservations', 'AdminController@reservations');
Route::any('/admin/reservation/{id}', 'AdminController@reservation');
Route::any('/admin/reservationChange', 'AdminController@reservationChange');
Route::any('/admin/guestChange', 'AdminController@guestChange');
Route::any('/admin/creditCardChange', 'AdminController@creditCardChange');
Route::any('/admin/seasonRatesChange', 'AdminController@seasonRatesChange');
Route::any('/admin/statusChange', 'AdminController@statusChange');
Route::any('/admin/charge', 'AdminController@charge');
Route::any('/admin/logout', 'AdminController@logout');
Route::any('/admin/resorts', 'AdminController@resorts');
Route::any('/admin/resort/{resortid}', 'AdminController@resort');
Route::any('/admin/condos', 'AdminController@condos');
Route::any('/admin/condo/{condoid}', 'AdminController@condo');
Route::any('/admin/getrates', 'AdminController@getRates');
Route::any('/admin/saverates', 'AdminController@saveRates');
Route::any('/admin/deleterates', 'AdminController@deleteRates');
Route::any('/admin/deletereservation', 'AdminController@deleteReservation');
Route::any('/admin/getratepricing', 'AdminController@getRatePricing');
Route::any('/admin/setratespricing', 'AdminController@setRatesPricing');
Route::any('/admin/unsetratespricing', 'AdminController@unsetRatesPricing');
Route::any('/admin/emails', 'AdminController@emails');
Route::any('/admin/leads', 'AdminController@leads');
Route::any('/admin/users', 'AdminController@users');