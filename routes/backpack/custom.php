<?php

// --------------------------
// Custom Backpack Routes
// --------------------------
// This route file is loaded automatically by Backpack\Base.
// Routes you generate using Backpack\Generators will be placed here.

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
    Route::crud('packaging', 'PackagingCrudController');
    Route::crud('auction', 'AuctionCrudController');
    Route::crud('auction-package', 'AuctionPackageCrudController');
    Route::crud('basket', 'BasketCrudController');
});