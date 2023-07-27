<?php

// --------------------------
// Custom Backpack Routes
// --------------------------
// This route file is loaded automatically by Backpack\Base.
// Routes you generate using Backpack\Generators will be placed here.

use App\Http\Controllers\Admin\AuctionPackageCrudController;
use App\Http\Controllers\Admin\AuctionCrudController;
use App\Http\Controllers\Admin\BasketCrudController;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => config('backpack.base.route_prefix', 'admin'),
    'middleware' => ['web', config('backpack.base.middleware_key', 'admin')],
    'namespace' => 'App\Http\Controllers\Admin',
], function () {
    Route::crud('article', 'ArticleCrudController');
    Route::crud('category', 'CategoryCrudController');
    Route::crud('tag', 'TagCrudController');
    Route::crud('wine-tags', 'WineTagCrudController');
    Route::crud('wine-variety', 'WineVarietyCrudController');
    Route::crud('drink-type', 'DrinkTypeCrudController');
    Route::crud('region', 'RegionCrudController');
    Route::crud('brands', 'BrandsCrudController');
    Route::crud('producers', 'ProducerCrudController');


    Route::crud('countries', 'CountryCrudController');
    Route::get('custom', 'CustomController@index')->name('page.custom.index');
    Route::crud('product', 'ProductCrudController');
    Route::crud('auction', 'AuctionCrudController');
    Route::crud('auction-package', 'AuctionPackageCrudController');
    Route::crud('basket', 'BasketCrudController');
    Route::get('auction-package/reorder/{slug}', [AuctionPackageCrudController::class,'reorder_product']);
    Route::post('auction-package/reorder/{slug}', [AuctionPackageCrudController::class,'reorder_product']);
    Route::get('auction/reorder/{slug}', [AuctionCrudController::class,'reorder_product']);
    Route::post('auction/reorder/{slug}', [AuctionCrudController::class,'reorder_product']);
    Route::get('basket/reorder/{slug}', [BasketCrudController::class,'reorder_product']);
    Route::post('basket/reorder/{slug}', [BasketCrudController::class,'reorder_product']);

    Route::crud('app-variable', 'AppVariableCrudController');
    Route::crud('wine-type', 'WineTypeCrudController');
    Route::crud('static-pages', 'StaticPagesCrudController');
});