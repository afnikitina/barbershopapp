<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
		 if(env('REDIRECT_HTTPS')) {
			 if(isset($url)) {
				 $url->formatScheme('https');
			 }
		 }
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
		 if(env('REDIRECT_HTTPS')) {
			 $this->app['request']->server->set('HTTPS', true);
		 }
    }
}
