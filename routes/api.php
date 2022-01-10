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

Route::get('/merchants', 'ApiMerchant@index');
Route::post('/merchants', 'ApiMerchant@create');
Route::get('/merchants/{id}', 'ApiMerchant@edit');
Route::put('/merchants/{id}', 'ApiMerchant@update');
Route::delete('/merchants/{id}', 'ApiMerchant@delete');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
