<?php

namespace App\Providers;

use App\Interfaces\ICategoryService;
use App\Interfaces\INotaryService;
use App\Interfaces\IOrderService;
use App\Interfaces\IQualificationService;
use App\Interfaces\IScheduleService;
use App\Interfaces\ISubcategoryService;
use App\Interfaces\IUserService;
use App\Services\CategoryService;
use App\Services\NotaryService;
use App\Services\OrderService;
use App\Services\QualificationService;
use App\Services\ScheduleService;
use App\Services\SubcategoryService;
use App\Services\UserService;
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
        $this->app->bind(INotaryService::class, NotaryService::class);
        $this->app->bind(IOrderService::class, OrderService::class);
        $this->app->bind(IScheduleService::class, ScheduleService::class);
        $this->app->bind(IUserService::class, UserService::class);
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
