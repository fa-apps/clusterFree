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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->post('/register','RegisterController@register');
Route::middleware('auth:sanctum')->post('/visit','RegisterController@visit');
Route::middleware('auth:sanctum')->post('/report','ReportController@report');
Route::post('/login','LoginController@login');
Route::post('/logout', 'LoginController@logout')->middleware('auth:sanctum');
Route::middleware('auth:sanctum')->get('/vlp','BoardController@vlp');
Route::middleware('auth:sanctum')->get('/rlp','BoardController@rlp');
Route::middleware('auth:sanctum')->get('/rsl','BoardController@rsl');