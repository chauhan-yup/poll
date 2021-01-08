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

Route::group(
    [
        "middleware" => 'api',
        'as' => 'api.'
    ], function () {
        
        
        \Auth::routes();
        Route::group(
            [
                'middleware' => ['guest']
            ], function () {
                Route::get('ui-render', 'Api\\PollController@uiRender');
            }
        );

        Route::group(
            [
                'namespace' => 'Api',
                'middleware' => 'auth:api',
                'as' => 'poll.'
            ], function () {
                route::get('poll/{type?}', 'PollController@getActivePolls')->name('load');
                route::get('answer-poll/{poll}/{pollAnswer}', 'PollController@store');
                route::get('poll/render-poll/{poll}', 'PollController@render');
            }
        );
    }
);

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


