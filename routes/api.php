<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/



Route::group([
    'prefix' => 'v1',
    'namespace' => 'Api',
    'as'=>'api.'
], function () {

    Route::group([
        'prefix' => 'telegram',
        'as'=>'telegram.'
    ], function () {

        Route::pattern('id', '[0-9]+');
        Route::get('set/webhook','TelegramController@setWebhook')->name('set.webhook');
        Route::post('webhook','TelegramController@webhook')->name('webhook');
        Route::get('list','TelegramController@list')->name('list');
        Route::get('detail/{id}','TelegramController@detail')->name('detail');
    });



});


