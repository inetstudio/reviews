<?php

Route::group([
    'namespace' => 'InetStudio\Reviews\Sites\Contracts\Http\Controllers\Back',
    'middleware' => ['web', 'back.auth'],
    'prefix' => 'back/reviews',
], function () {
    Route::any('reviews/sites/data', 'SitesDataControllerContract@data')->name('back.reviews.sites.data.index');
    Route::post('reviews/sites/slug', 'SitesUtilityControllerContract@getSlug')->name('back.reviews.sites.getSlug');
    Route::post('reviews/sites/suggestions', 'SitesUtilityControllerContract@getSuggestions')->name('back.reviews.sites.getSuggestions');

    Route::resource('sites', 'SitesControllerContract', ['except' => [
        'show',
    ], 'as' => 'back.reviews']);
});
