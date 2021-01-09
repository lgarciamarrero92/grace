<?php

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

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia\Inertia::render('Dashboard');
})->name('dashboard');

Route::get('/entry/{category_id}', 'App\Http\Controllers\EntryController@create');

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
    Route::post('/categories/reorder','App\Http\Controllers\CategoryController@reorder')->name('reorder_categories');
});

Route::get('/achievements/create', 'App\Http\Controllers\AchievementsController@create')->name('achievements.create');
