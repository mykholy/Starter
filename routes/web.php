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

use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::get('/', function () {

    //$users = User::select('email')->get();
    $users = User::pluck('email')->toArray();
    dd($users);
    return view('welcome');
});

Route::get('/redirect/{service}', 'SocialController@redirect');
Route::get('/callback/{service}', 'SocialController@callback');


Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');

Route::get('fillabel', 'CrudController@getOffers');


Route::group(['prefix' => LaravelLocalization::setLocale(), 'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']], function () {
    Route::group(['prefix' => 'offers'], function () {

        Route::post('store', 'CrudController@store')->name('offers.store');
        Route::get('create', 'CrudController@create');
        Route::get('all', 'CrudController@getAllOffers');

        Route::get('edit/{offer_id}', 'CrudController@editOffer');
        Route::put('update/{offer_id}', 'CrudController@updateOffer')->name('offers.update');

    });

});
