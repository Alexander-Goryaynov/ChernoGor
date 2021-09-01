<?php

use App\Http\Controllers\CategoryController;
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
    });
    Route::prefix('/subcategories')->group(function() {
        Route::post('/', [SubcategoryController::class, 'store']);
        Route::get('/select', [SubcategoryController::class, 'select']);
        Route::get('/{id}/edit', [SubcategoryController::class, 'edit']);
    });
    Route::get('/services/tree', [CategoryController::class, 'tree']);
});
