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

// Route::any('/admin/pages/{id}/build',[\App\Http\Controllers\PageBuilderController::class,'build'])->name('pagebuilder.build');
// Route::any('/admin/pages/build',[\App\Http\Controllers\PageBuilderController::class,'build'])->name('pagebuilder.build');


require __DIR__.'/auth.php';

Route::any('{uri}', [
    'uses' => [\App\Http\Controllers\WebsiteController::class,'uri'],
    'as' => 'page',
])->where('uri', '.*');