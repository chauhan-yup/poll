<?php

use App\Http\Controllers\Admin\PollController;
use App\Http\Middleware\AdminUser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Auth::routes();

Route::group(
    [
        'namespace' => 'Api',
        'as' => 'api.'
    ], function () {
        Route::get('home', 'PollController@home');
    }
);

Route::group(
    [
        "prefix" => 'admin',
        "as" => 'admin.',
        "namespace" => "Admin",
        "middleware" => AdminUser::class
    ], function () {
        Auth::routes();

        Route::group(
            [
                "middleware" => [
                    "auth:admin",
                ]
            ], function () {
                
                Route::get('/poll', [PollController::class, 'index'])->name('poll-index');
                Route::get('/poll/create', [PollController::class, 'create'])->name('poll-create');
                Route::post('/poll/store', [PollController::class, 'store'])->name('poll-store');
                Route::get('/poll/{poll}/edit', [PollController::class, 'edit'])->name('poll-edit');
                Route::put('/poll/{poll}', [PollController::class, 'update'])->name('poll-update');
            }
        );
    }
);