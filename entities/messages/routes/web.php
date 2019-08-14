<?php

use Illuminate\Support\Facades\Route;

Route::group(
    [
        'namespace' => 'InetStudio\Reviews\Messages\Contracts\Http\Controllers\Back',
        'middleware' => ['web', 'back.auth'],
        'prefix' => 'back/reviews',
    ],
    function () {
        Route::any('messages/data', 'DataControllerContract@data')
            ->name('back.reviews.messages.data.index');

        Route::post('messages/suggestions', 'UtilityControllerContract@getSuggestions')
            ->name('back.reviews.messages.getSuggestions');

        Route::post('messages/moderate/activity', 'ModerateControllerContract@activity')
            ->name('back.reviews.messages.moderate.activity');

        Route::post('messages/moderate/read', 'ModerateControllerContract@read')
            ->name('back.reviews.messages.moderate.read');

        Route::post('messages/moderate/destroy', 'ModerateControllerContract@destroy')
            ->name('back.reviews.messages.moderate.destroy');

        Route::resource(
            'messages',
            'ResourceControllerContract',
            [
                'as' => 'back.reviews',
            ]
        );
    }
);

Route::group(
    [
        'namespace' => 'InetStudio\Reviews\Messages\Contracts\Http\Controllers\Front',
        'middleware' => ['web'],
    ],
    function () {
        Route::post('reviews/more/{type}/{id}', 'ItemsControllerContract@getItems')
            ->name('front.reviews.messages.get');

        Route::post('reviews/{type}/{id}', 'ItemsControllerContract@sendMessage')
            ->name('front.reviews.messages.send');
    }
);
