<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DummyAPIController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('data', [DummyAPIController::class, 'getData']);
Route::get('students/{id?}', [DummyAPIController::class, 'studentsData']);
Route::post('studentadd', [DummyAPIController::class, 'StudentDataAdd']);
Route::get('studentsearch/{fname}', [DummyAPIController::class, 'StudentSearch']);
Route::delete('studentdelete/{id}', [DummyAPIController::class, 'StudentDelete']);
Route::post('studentsave', [DummyAPIController::class, 'StudentValidateData']);
Route::post('filesave', [DummyAPIController::class, 'FileSave']);