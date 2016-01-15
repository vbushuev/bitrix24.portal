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
Route::get('/demo', function () {return view('demo.demo');});
Route::get('/demo/private', function () {return view('demo.private.private');});
Route::get('/demo/private/cc', function () {return view('demo.private.cс');});
Route::get('/demo/business', function () {return view('demo.business.business');});
Route::get('/demo/business/credit', function () {return view('demo.business.credit');});
// Controllers
Route::controller('contur-focus', 'ConturFocusController');
Route::controller('bitrix24', 'Bitrix24Controller');
