<?php

Route::group([
    'namespace' => 'InetStudio\Reviews\Messages\Contracts\Http\Controllers\Back',
    'middleware' => ['web', 'back.auth'],
    'prefix' => 'back/reviews',
], function () {
    Route::any('reviews/messages/data', 'MessagesDataControllerContract@data')->name('back.reviews.messages.data.index');
    Route::post('reviews/messages/slug', 'MessagesUtilityControllerContract@getSlug')->name('back.reviews.messages.getSlug');
    Route::post('reviews/messages/suggestions', 'MessagesUtilityControllerContract@getSuggestions')->name('back.reviews.messages.getSuggestions');

    Route::resource('messages', 'MessagesControllerContract', ['as' => 'back.reviews']);
});
