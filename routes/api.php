<?php

use Illuminate\Support\Facades\Route;
use Iyngaran\Advertiser\Http\Controllers\Api\PostController;
use Iyngaran\Advertiser\Http\Controllers\Api\PublicControllers\PostController as PublicPostController;


Route::group(
    ['prefix' => 'public', 'as' => 'public.'],
    function () {
        Route::resource('/posts', PublicPostController::class)->only([
            'index',
            'show'
        ]);
    });


Route::resource('/posts', PostController::class)->except([
    'create',
    'edit'
]);
