<?php

use Illuminate\Support\Facades\Route;
use Iyngaran\Advertiser\Http\Controllers\Api\PostController;
use Iyngaran\Advertiser\Http\Controllers\Api\PublicControllers\PostController as PublicPostController;
use Iyngaran\Advertiser\Http\Controllers\Api\FileUploadController;
use Iyngaran\Advertiser\Http\Controllers\Api\PublicControllers\FeaturedPostController;

Route::group(
    ['prefix' => 'public', 'as' => 'public.'],
    function () {
        Route::resource('/posts', PublicPostController::class)->only([
            'index',
            'show',
            'store'
        ]);

        Route::get('/featured-posts', FeaturedPostController::class);
    });


Route::resource('/posts', PostController::class)->except([
    'create',
    'edit'
]);

Route::post('/posts-file-upload', FileUploadController::class);

