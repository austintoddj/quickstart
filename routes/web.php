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

Route::middleware('web')->namespace('Web')->group(function () {
    Route::get('/', 'PublicController@index')->name('public.home');

    Route::namespace('Auth')->group(function () {
        if (config('auth.registration')) {
            Route::prefix('register')->group(function () {
                Route::get('/', 'RegisterController@showRegistrationForm')->name('register');
                Route::post('/', 'RegisterController@register');
            });
        }

        Route::prefix('login')->group(function () {
            Route::get('{social}', 'LoginController@socialLogin')->where('social', 'twitter|facebook|google|github');
            Route::get('{social}/callback', 'LoginController@handleProviderCallback')->where('social', 'twitter|facebook|google|github');
            Route::get('/', 'LoginController@showLoginForm')->name('login');
            Route::post('/', 'LoginController@login');
        });

        Route::prefix('logout')->group(function () {
            Route::post('/', 'LoginController@logout')->name('logout');
        });

        Route::prefix('password')->group(function () {
            Route::get('reset', 'ForgotPasswordController@showLinkRequestForm')->name('password.request');
            Route::post('email', 'ForgotPasswordController@sendResetLinkEmail')->name('password.email');
            Route::get('reset/{token}', 'ResetPasswordController@showResetForm')->name('password.reset');
            Route::post('reset', 'ResetPasswordController@reset');
        });
    });

    Route::namespace('Admin')->group(function () {
        Route::prefix('dashboard')->group(function () {
            Route::get('/', 'DashboardController')->name('dashboard');
        });

        Route::prefix('profile')->group(function () {
            Route::get('/', 'ProfileController@index')->name('profile');
            Route::post('/', 'ProfileController@update')->name('profile.update');
        });
    });
});