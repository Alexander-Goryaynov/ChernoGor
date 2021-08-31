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
    Route::post('/categories', [CategoryController::class, 'store']);
    Route::post('/subcategories', [SubcategoryController::class, 'store']);
    Route::get('/services/tree', [CategoryController::class, 'tree']);
});
