<?php

// use App\Http\Controllers\Api\CourseController;

use App\Http\Controllers\Api\CourseController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\Api\UserController;    


Route::group(['namespace'=> 'Api'], function () {
    // Route::post('/login', [UserController::class,'createUser']);
    Route::post('/login', [UserController::class,'createUser']);


    Route::group(['middleware'=> ['auth:sanctum']], function () {
        Route::any('/courseList', [CourseController::class,'courseList']);
    });

});

// Route::post("/auth/register", UserController::class)->name("createUser");
// Route::post('/auth/login', [UserController::class,'loginUser']);



// Route::any('/courseList', 'CourseController@courseList');

