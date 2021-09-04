<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\NotaryController;
use App\Http\Controllers\QualificationController;
use App\Http\Controllers\SubcategoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::prefix('/v1')->group(function() {
    Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
        return $request->user();
    });
    Route::get('/qualifications/select', [QualificationController::class, 'select']);
    Route::prefix('/categories')->group(function() {
        Route::post('/', [CategoryController::class, 'store']);
        Route::get('/select', [CategoryController::class, 'select']);
        Route::get('/{id}/edit', [CategoryController::class, 'edit']);
        Route::put('/{id}', [CategoryController::class, 'update']);
        Route::delete('/{id}', [CategoryController::class, 'destroy']);
    });
    Route::prefix('/subcategories')->group(function() {
        Route::post('/', [SubcategoryController::class, 'store']);
        Route::get('/select', [SubcategoryController::class, 'select']);
        Route::get('/{id}/edit', [SubcategoryController::class, 'edit']);
        Route::put('/{id}', [SubcategoryController::class, 'update']);
        Route::delete('/{id}', [SubcategoryController::class, 'destroy']);
    });
    Route::get('/services/tree', [CategoryController::class, 'tree']);
    Route::prefix('/notaries')->group(function() {
        Route::post('/', [NotaryController::class, 'store']);
    });
});
