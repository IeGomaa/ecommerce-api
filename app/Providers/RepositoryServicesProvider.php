<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServicesProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'App\Http\Interfaces\Admin\AdminAuthInterface',
            'App\Http\Repositories\Admin\AdminAuthRepository'
        );
        $this->app->bind(
            'App\Http\Interfaces\Admin\AdminCategoryInterface',
            'App\Http\Repositories\Admin\AdminCategoryRepository'
        );
        $this->app->bind(
            'App\Http\Interfaces\Admin\AdminClientInterface',
            'App\Http\Repositories\Admin\AdminClientRepository'
        );
        $this->app->bind(
            'App\Http\Interfaces\Admin\AdminOrderInterface',
            'App\Http\Repositories\Admin\AdminOrderRepository'
        );
        $this->app->bind(
            'App\Http\Interfaces\Admin\AdminProductInterface',
            'App\Http\Repositories\Admin\AdminProductRepository'
        );
        $this->app->bind(
            'App\Http\Interfaces\EndUser\AuthInterface',
            'App\Http\Repositories\EndUser\AuthRepository'
        );
        $this->app->bind(
            'App\Http\Interfaces\EndUser\CartInterface',
            'App\Http\Repositories\EndUser\CartRepository'
        );
        $this->app->bind(
            'App\Http\Interfaces\EndUser\CategoryInterface',
            'App\Http\Repositories\EndUser\CategoryRepository'
        );
        $this->app->bind(
            'App\Http\Interfaces\EndUser\ClientInterface',
            'App\Http\Repositories\EndUser\ClientRepository'
        );
        $this->app->bind(
            'App\Http\Interfaces\EndUser\OrderInterface',
            'App\Http\Repositories\EndUser\OrderRepository'
        );
        $this->app->bind(
            'App\Http\Interfaces\EndUser\ProductInterface',
            'App\Http\Repositories\EndUser\ProductRepository'
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
