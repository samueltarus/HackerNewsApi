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

// 1. Top 10 most occurring words in the titles of the last 25 stories
Route::get('/load', [\App\Http\Controllers\EndpointController::class, 'index']);

// 2. Top 10 most occurring words in the titles of the post of exactly the last week
Route::get('/load-last-week', [\App\Http\Controllers\EndpointController::class, 'OccuringWordsTitlesInlastweek']);

// 3. Top 10 most occurring words in titles of the last 600 stories of users with at least 10.000 karma 
Route::get('/load-users-stories', [\App\Http\Controllers\EndpointController::class, 'OccuringWordsTitlesInlastUsersWithKarma']);
