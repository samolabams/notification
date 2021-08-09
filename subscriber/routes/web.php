<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\SubscriberTestController;

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
    return ['service' => 'Subscriber'];
});

Route::post('/test1', [SubscriberTestController::class, 'test1']);
Route::post('/test2', [SubscriberTestController::class, 'test2']);
