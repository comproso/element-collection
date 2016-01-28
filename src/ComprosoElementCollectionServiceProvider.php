<?php

namespace Comproso\Elements\Collection;

use Illuminate\Support\ServiceProvider;

class ComprosoElementCollectionServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        // loading views
		$this->loadViewsFrom(base_path('resources/views/vendor/comproso/element-collection'), "eco");

		// publish migrations
	    $this->publishes([
	        __DIR__.'/database/migrations' => base_path('database/migrations')
	    ], "migrations");

	    // publish views
	    $this->publishes([
	    	__DIR__.'/resources/views' => base_path('resources/views/vendor/comproso/element-collection')
	    ], 'views');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
