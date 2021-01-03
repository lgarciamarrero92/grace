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

Route::get('users', 'App\Http\Controllers\Api\UserController@index');
Route::get('inputs-from-id/{id}', 'App\Http\Controllers\AchievementsController@all_inputs_from_id');

Route::get('/achievements/user/{id}', 'App\Http\Controllers\AchievementsController@all_achievements_from_user_id')->name('achievements.show');




