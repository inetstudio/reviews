<?php

Route::group(['namespace' => 'InetStudio\Reviews\Controllers'], function () {
    Route::any('modules/reviews/get/{alias?}', 'ReviewsFeedbacksController@getFeedbacks');
    Route::group(['middleware' => 'web', 'prefix' => 'back/reviews'], function () {
        Route::group(['middleware' => 'back.auth'], function () {

            Route::resource('feedbacks', 'ReviewsFeedbacksController', ['except' => [
                'show',
            ], 'as' => 'back.reviews']);

            Route::resource('sites', 'ReviewsSitesController', ['except' => [
                'show',
            ], 'as' => 'back.reviews']);
        });
    });
});
