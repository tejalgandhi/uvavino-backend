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
    Route::crud('regions', 'RegionsCrudController');
    Route::crud('brands', 'BrandsCrudController');


    Route::crud('countries', 'CountryCrudController');
    Route::get('custom', 'CustomController@index')->name('page.custom.index');
});
