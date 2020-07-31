<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            \App\Repositories\Contracts\CustomerRepository::class,
            \App\Repositories\Eloquent\CustomerRepositoryEloquent::class
        );
        $this->app->bind(
            \App\Repositories\Contracts\EmployeeRepository::class,
            \App\Repositories\Eloquent\EmployeeRepositoryEloquent::class
        );
        $this->app->bind(
            \App\Repositories\Contracts\SchedulingRepository::class,
            \App\Repositories\Eloquent\SchedulingRepositoryEloquent::class
        );
    }
}
