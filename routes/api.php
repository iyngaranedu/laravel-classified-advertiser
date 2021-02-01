<?php
use Illuminate\Support\Facades\Route;
use Iyngaran\Advertiser\Http\Controllers\Api\PostController;


Route::post('/post/store', [PostController::class, 'store']);
