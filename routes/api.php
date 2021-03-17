<?php
use Illuminate\Support\Facades\Route;
use Iyngaran\Advertiser\Http\Controllers\Api\PostController;


Route::resource('/post', PostController::class)->except([
    'create', 'edit'
]);
