<?php

use App\Http\Controllers\{UserController, UserMoneyController, NurseryWorkerController, NurseryRoleController, PlantController, ReasonController, WorkWithMoneyController};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('user')->group(function () {
    Route::controller(UserController::class)->group(function () {
        Route::post('/login', 'login');
        Route::post('/register', 'store');
    });

    Route::group(['middleware' => ['auth:users']], function () {
        Route::controller(UserController::class)->group(function () {
            Route::post('/logout', 'logout');
            Route::get('/update', 'edit');
            Route::patch('/update', 'update');
            Route::patch('/updatepassword', 'update_password');
        });


        Route::controller(UserMoneyController::class)->group(function () {
            Route::get('/investitions', 'all');
            Route::get('/investitions/{id}', 'show');
            // Route::patch('/investitions', 'edit');
            Route::post('/investitions', 'store');
            Route::delete('/investitions/{id}', 'destroy');
        });
    });
});


Route::prefix('worker')->group(function () {
    Route::post('/login', [NurseryWorkerController::class, 'login']);
    // Route::post('/register', [NurseryWorkerController::class, 'store']);

    Route::group(['middleware' => ['auth:workers']], function () {
        Route::controller(NurseryWorkerController::class)->group(function () {
            Route::post('/register', 'store');
            Route::post('/logout', 'logout');
            Route::get('/update', 'edit');
            Route::patch('/update_personal/{id_personal}', 'update_personal');
            Route::get('/update', 'update');
        });

        Route::controller(NurseryRoleController::class)->group(function () {
            Route::get('/roles', 'index');
            Route::post('/roles', 'store');
            Route::patch('/roles/{id}', 'update');
            Route::delete('/roles/{id}', 'destroy');
        });

        Route::controller(PlantController::class)->group(function () {
            Route::get('/plant', 'index');
            Route::get('/plant/{id}', 'show');
            Route::post('/plant', 'store');
            Route::patch('/plant/{id}', 'update');
            Route::delete('/plant/{id}', 'destroy');
        });

        Route::controller(ReasonController::class)->group(function () {
            Route::get('/reason', 'index');
            Route::get('/reason/{id}', 'show');
            Route::post('/reason', 'store');
            Route::patch('/reason/{id}', 'update');
            Route::delete('/reason/{id}', 'destroy');
        });

        Route::controller(WorkWithMoneyController::class)->group(function () {
            Route::get('/investition', 'invest_index');
            Route::get('/workmoney', 'index');
            Route::get('/workmoney/{id}', 'show');
            Route::post('/workmoney', 'store');
        });
    });
});