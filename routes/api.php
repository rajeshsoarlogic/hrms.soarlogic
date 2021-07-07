<?php
use Illuminate\Http\Request;
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
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');



Route::namespace('Api')->group(function () {
    Route::get('departments', 'DepartmentController@index');
    Route::post('department/store', 'DepartmentController@store');
    Route::delete('department/delete/{id}', 'DepartmentController@destroy');
});