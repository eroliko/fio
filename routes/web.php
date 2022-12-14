<?php

use App\Http\Containers\AwardContainer\Controllers\AwardController;
use App\Http\Containers\PageContainer\Controllers\IndexPageController;
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

Route::get('/', [IndexPageController::class, 'show'])
    ->name('page-index')
;

Route::post('/awards', [AwardController::class, 'store'])
    ->name('action-ward-store')
;
