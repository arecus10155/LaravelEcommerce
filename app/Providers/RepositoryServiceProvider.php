<?php

namespace App\Providers;
use App\Repositories\CategoryInterface; 
use App\Repositories\CategoryResitory; 
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
	$this->app->bind(
	  'App\Repositories\CategoryInterface',
	  'App\Repositories\CategoryRepository'
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
