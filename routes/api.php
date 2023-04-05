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
Route::post('/saveContact',[App\Http\Controllers\Api\ContactController::class, 'store']);
Route::get('/showContact',[App\Http\Controllers\Api\ContactController::class, 'index']);
Route::get('edit/{id}', [App\Http\Controllers\Api\ContactController::class, 'edit']);
Route::get('/deleteContact/{id}',[App\Http\Controllers\Api\ContactController::class, 'destroy']);
Route::post('/updateContact/{id}',[App\Http\Controllers\Api\ContactController::class, 'update']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
