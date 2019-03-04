<?php

Route::group([
    'namespace' => 'InetStudio\Reviews\Messages\Contracts\Http\Controllers\Back',
    'middleware' => ['web', 'back.auth'],
    'prefix' => 'back/reviews',
], function () {
    Route::any('messages/data', 'MessagesDataControllerContract@data')->name('back.reviews.messages.data.index');

    Route::post('messages/slug', 'MessagesUtilityControllerContract@getSlug')->name('back.reviews.messages.getSlug');
    Route::post('messages/suggestions', 'MessagesUtilityControllerContract@getSuggestions')->name('back.reviews.messages.getSuggestions');

    Route::post('messages/moderate/activity', 'MessagesModerateControllerContract@activity')->name('back.reviews.messages.moderate.activity');
    Route::post('messages/moderate/read', 'MessagesModerateControllerContract@read')->name('back.reviews.messages.moderate.read');
    Route::post('messages/moderate/destroy', 'MessagesModerateControllerContract@destroy')->name('back.reviews.messages.moderate.destroy');

    Route::resource('messages', 'MessagesControllerContract', ['as' => 'back.reviews']);
});

Route::group(['namespace' => 'InetStudio\Reviews\Messages\Contracts\Http\Controllers\Front'], function () {
    Route::group(['middleware' => 'web'], function () {
        Route::post('reviews/more/{type}/{id}', 'MessagesControllerContract@getComments')->name('front.reviews.messages.get');
        Route::post('reviews/{type}/{id}', 'MessagesControllerContract@sendComment')->name('front.reviews.messages.send');
    });
});
