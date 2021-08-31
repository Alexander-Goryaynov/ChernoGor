<?php

namespace App\Providers;

use App\Interfaces\ICategoryService;
use App\Interfaces\IQualificationService;
use App\Interfaces\ISubcategoryService;
use App\Services\CategoryService;
use App\Services\QualificationService;
use App\Services\SubcategoryService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(IQualificationService::class, QualificationService::class);
        $this->app->bind(ICategoryService::class, CategoryService::class);
        $this->app->bind(ISubcategoryService::class, SubcategoryService::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
