<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ServiceServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            \App\Services\Contracts\CustomerService::class,
            \App\Services\V1\CustomerServiceV1::class
        );
        $this->app->bind(
            \App\Services\Contracts\EmployeeService::class,
            \App\Services\V1\EmployeeServiceV1::class
        );
        $this->app->bind(
            \App\Services\Contracts\SchedulingService::class,
            \App\Services\V1\SchedulingServiceV1::class
        );
    }
}
