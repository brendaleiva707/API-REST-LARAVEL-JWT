<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Middleware\IsUserAuth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//PUBLIC ROUTES
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

//PRIVATE ROUTES
Route::middleware([IsUserAuth::class])->group(function(){

    Route::controller(AuthController::class)->group(function(){
        Route::post('logout', 'logout');
        Route::get('me', 'getUser');
    });

    Route::get('posts', [PostController::class, 'getPosts']);

    

    Route::controller(PostController::class)->group(function(){
        Route::post('post', 'addPost');
        Route::get('/post/{id}', 'getPostById');
        Route::patch('/post/{id}', 'updatePostById');
        Route::delete('/post/{id}', 'deletePostById');
    });
    
    

    
});