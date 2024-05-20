<?php

use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::prefix('user')->group(function () {
    Route::controller(UserController::class)->group(function () {
        Route::post('/login', 'login');
        Route::post('/register', 'store');
    });

    Route::group(['middleware' => ['auth:users']], function () {
        Route::controller(UserController::class)->group(function () {
            Route::post('/logout', 'logout');
            // Route::get('/update', 'edit');
            // Route::patch('/update', 'update');
        });
    });
});


// Route::prefix('worker')->group(function () {
//     Route::post('/login', [MedicController::class, 'login']);
//     Route::group(['middleware' => ['auth:medic']], function () {
//         Route::controller(MedicController::class)->group(function () {
//             Route::post('/register', 'store');
//             Route::post('/logout', 'logout');
//             Route::get('/update', 'edit');
//             Route::patch('/update/{medic}', 'update');
//         });

//         Route::controller(MyVisitController::class)->group(function () {
//             Route::get('/visits', 'medic_index');
//             Route::get('/visits/{id_visit}', 'medic_index_id');
//             Route::patch('/visit/{visit}', 'people_came');

//         });

//         Route::controller(MyRecomendationController::class)->group(function () {
//             Route::post('/recomendation', 'store');
//             Route::patch('/recomendation/{recomendation}', 'update');

//             // TO DO
//             // Route::post('/recomendation/{recomendation}', 'delete');
//         });

//         Route::controller(ProfileAmbulanceController::class)->group(function () {
//             Route::get('/specialization', 'index');
//             Route::post('/specialization', 'store');
//             Route::patch('/specialization/{specialization}', 'update');

//             // TO DO
//             // Route::post('/specialization/{specialization}', 'delete');
//         });
//     });
// });