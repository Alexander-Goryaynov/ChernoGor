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

Route::get('/{any?}', function () { //все, что приходит по запросу: / или /regex_выражение будет перенаправлено на welcome
    return view('welcome');
})->where('any', '^(?!api\/)[\/\w\.-]*'); // регекс: text/lala/yohoo, или home, или labdab и тд, но не подходит
// для api/v1/notaries. так как для подобного регекса будет другой маршрут
