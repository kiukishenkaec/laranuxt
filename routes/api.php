<?php

use App\Events\SymbolDepthCacheUpdated;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\SessionController;
use App\Http\Resources\API\V1\Binance\SymbolResource;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Route;
use App\Events\SymbolStatusUpdated;
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

Route::get('/push', function (){
    //\Illuminate\Support\Facades\Redis::publish('symbolsss', 'СООБЩЕНИЕ');

    //$s = \Illuminate\Support\Facades\Redis::get('miniTicker:FORUSDT');

    //$symbol = \App\Models\apiBinance\Symbol::joinHistory()->first();
    //event(new SymbolStatusUpdated(Symbol::whereId($symbolModel->id)->joinHistory()->first()));

    //$event = event(new SymbolStatusUpdated($symbol));
    //SymbolStatusUpdated::dispatch($symbol);
    //$event3 = broadcast(new SymbolStatusUpdated($symbol));

    $string = '{"BNBBTC"'.Redis::get('depthCache:BNBBTC').'}';
    //$this->info();
    event(new SymbolDepthCacheUpdated($string));

    return $string;
});

Route::get('/', [Controller::class, 'routes'])
    ->name('entry-point')
    ->withoutMiddleware('api');

Route::get('example', [Controller::class, 'example'])->name('example');
Route::get('error', [Controller::class, 'exampleError'])->name('error');

// Authentication
Route::get('login', [Controller::class, 'auth'])->name('login');

Route::controller(AuthController::class)->group(function () {
    Route::get('redirect/{provider}', 'redirect')->name('provider.redirect');
    Route::get('callback/{provider}', 'callback')->name('provider.callback');
    Route::get('onetap/{credential}', 'onetap')->name('onetap.support');
    Route::post('attempt', 'attempt')->name('auth.attempt');
    Route::post('login', 'login')->name('auth.login');
    Route::get('logout', 'logout')->middleware('auth:api')->name('auth.logout');
    Route::get('me', 'me')->middleware('auth:api')->name('auth.session');
});

Route::apiResource('session', SessionController::class)->middleware('auth:api');
