<?php


$baseAdminUrl = config('avored-ecommerce.admin_url');


Route::middleware(['web', 'admin.auth', 'permission'])
    ->prefix($baseAdminUrl)
    ->namespace('AvoRed\Banner\Http\Controllers')
    ->name('admin.')
    ->group(function () {


        Route::get('banner',  'BannerController@index')
                        ->name('banner.index');

        Route::get('banner/create',  'BannerController@create')
            ->name('banner.create');
        Route::post('banner',  'BannerController@store')
            ->name('banner.store');


        Route::get('banner/{id}/edit',  'BannerController@edit')
            ->name('banner.edit');
        Route::put('banner/{id}',  'BannerController@update')
            ->name('banner.update');

        Route::delete('banner/{id}',  'BannerController@destroy')
            ->name('banner.destroy');

    });

