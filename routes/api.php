<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\NotaryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\QualificationController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::prefix('/v1')->group(function() {
    Route::middleware('auth:sanctum')->get('/user', function(Request $request) {
        return $request->user();
    });
    Route::get('/qualifications/select', [QualificationController::class, 'select']);
    Route::prefix('/categories')->group(function() {
        Route::middleware('auth:sanctum')->group(function() {
            Route::get('/select', [CategoryController::class, 'select']);
            Route::middleware('role:admin')->group(function() {
                Route::get('/{id}/edit', [CategoryController::class, 'edit']);
                Route::post('/', [CategoryController::class, 'store']);
                Route::put('/{id}', [CategoryController::class, 'update']);
                Route::delete('/{id}', [CategoryController::class, 'destroy']);
            });
        });
    });
    Route::prefix('/subcategories')->group(function() {
        Route::middleware('auth:sanctum')->group(function() {
            Route::middleware('role:user')->group(function() {
                Route::get('/select', [SubcategoryController::class, 'select']);
            });
            Route::middleware('role:admin')->group(function() {
                Route::get('/{id}/edit', [SubcategoryController::class, 'edit']);
                Route::post('/', [SubcategoryController::class, 'store']);
                Route::put('/{id}', [SubcategoryController::class, 'update']);
                Route::delete('/{id}', [SubcategoryController::class, 'destroy']);
            });
        });
    });
    Route::get('/services/tree', [CategoryController::class, 'tree']);
    Route::prefix('/notaries')->group(function() {
        Route::get('/', [NotaryController::class, 'index']);
        Route::middleware('auth:sanctum')->group(function() {
            Route::middleware('role:user')->group(function() {
                Route::get('/select', [NotaryController::class, 'select']);
            });
            Route::middleware('role:admin')->group(function() {
                Route::get('/{id}/edit', [NotaryController::class, 'edit']);
                Route::post('/', [NotaryController::class, 'store']);
                Route::put('/{id}', [NotaryController::class, 'update']);
                Route::delete('/{id}', [NotaryController::class, 'destroy']);
            });
        });
    });
    Route::prefix('/orders')
        ->middleware('auth:sanctum')->group(function() {
            Route::get('/', [OrderController::class, 'index']);
            Route::post('/{id}/cancel', [OrderController::class, 'cancel']);
            Route::middleware('role:user')->group(function(){
                Route::post('/', [OrderController::class, 'store']);
            });
            Route::middleware('role:admin')->group(function(){
                Route::post('/{id}/finish', [OrderController::class, 'finish']);
            });
        });
    Route::middleware('auth:sanctum')->group(function() {
        Route::middleware('role:user')->group(function() {
            Route::put('/account', [UserController::class, 'update']);
            Route::get('/schedule/select', [ScheduleController::class, 'select']);
        });
        Route::middleware('role:admin')->group(function() {
            Route::get('/accounts', [UserController::class, 'index']);
        });
    });
});
