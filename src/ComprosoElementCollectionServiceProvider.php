<?php

namespace Comproso\Elements\Collection;

use Illuminate\Support\ServiceProvider;

use Validator;

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

	    // extend validation rules
	    Validator::extend('cetype', function($attribute, $value, $parameters, $validator) {
            // define cetypes
            $cetypes = ['text', 'input'/*, 'textarea'*/];

            return in_array($value, $cetypes);
        });

        Validator::extend('input_type', function($attribute, $value, $parameters, $validator) {
            // define cetypes
            $formtypes = ['text', 'hidden', 'radio', 'submit', 'reset', 'checkbox', 'button', /*'password',*/ 'color', 'date', 'datetime', 'datetime-local', /*'email',*/ 'month', 'number', 'range', 'search', /*'tel',*/ 'time', /*'url',*/ 'week'];

            return in_array($value, $formtypes);
        });
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
