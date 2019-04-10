<?php

use Illuminate\Support\Facades\Route;

Route::group(
    [
        'namespace' => 'InetStudio\Reviews\Sites\Contracts\Http\Controllers\Back',
        'middleware' => ['web', 'back.auth'],
        'prefix' => 'back/reviews',
    ],
    function () {
        Route::any('reviews/sites/data', 'DataControllerContract@data')
            ->name('back.reviews.sites.data.index');

        Route::post('reviews/sites/suggestions', 'UtilityControllerContract@getSuggestions')
            ->name('back.reviews.sites.getSuggestions');

        Route::resource(
            'sites',
            'ResourceControllerContract',
            [
                'except' => [
                    'show',
                ],
                'as' => 'back.reviews',
            ]
        );
    }
);
