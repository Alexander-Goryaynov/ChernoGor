<?php

namespace App\Providers;

use App\Interfaces\ICategoryService;
use App\Interfaces\IQualificationService;
use App\Services\CategoryService;
use App\Services\QualificationService;
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
