<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/demo/business/credit', function () {
    return view('demo.business.credit');
});
Route::controller('contur-focus', 'ConturFocusController');
Route::controller('bitrix24', 'Bitrix24Controller');
