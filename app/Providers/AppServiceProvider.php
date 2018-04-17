<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Schema::defaultStringLength(199);
		
		view()->composer('*', function($view) {
			$view->with('total_orders', count(\App\Order::get()));
			$view->with('unanswered_orders', count(\App\Order::where('status', 'unanswered')->get()));
			$view->with('total_products', count(\App\Product::get()));
			$view->with('total_categories', count(\App\ProductCategory::get()));
			$view->with('total_users', count(\App\User::get()));
		});

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
