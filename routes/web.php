<?php

use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;


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

// Auth
Auth::routes();

// Welcome
Route::get('/', function () {
    return view('welcome');
});
Route::get('/migrate', function(){
    Artisan::call('route:clear');
    Artisan::call('view:clear');
    Artisan::call('migrate:rollback',['--force' => true ]);
    dd('migrated!');
});
// Pages
Route::get('{page}/{subs?}', [PageController::class, 'index'])->middleware('web')
    ->where(['page' => '^((?!admin).)|[^/]*$', 'subs' => '.*']);
