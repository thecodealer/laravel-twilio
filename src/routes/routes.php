<?php

use Illuminate\Support\Facades\Route;

Route::name('thecodealerlaraveltwilio.')->prefix('thecodealerlaraveltwilio')->namespace('\TheCodealer\LaravelTwilio\Controllers')->group(function(){
    Route::name('callbacks.')->prefix('callbacks')->group(function(){
        Route::name('twilio.')->prefix('twilio')->group(function(){
            Route::get('call-gather-response', 'Twilio@callGatherResponse')->name('call-gather-response');
            Route::get('call-status', 'Twilio@callStatus')->name('call-status');
        });

        Route::name('zapier.')->prefix('zapier')->group(function(){
            Route::get('/lead', 'Zapier@lead')->name('lead');
        });
    });
});
