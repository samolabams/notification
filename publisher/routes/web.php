<?php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Publish\PublishController;
use App\Http\Controllers\Subscribe\SubscribeController;

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
    return ['service' => 'Publisher'];
});

Route::post('/subscribe/{topic}', [SubscribeController::class, 'create']);
Route::post('/publish/{topic}', [PublishController::class, 'create']);
