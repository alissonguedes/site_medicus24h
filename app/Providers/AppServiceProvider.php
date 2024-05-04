<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider {
	/**
	 * Register any application services.
	 */
	public function register(): void {
		//
	}

	/**
	 * Bootstrap any application services.
	 */
	public function boot(): void {

		Blade::extend(function ($var) {
			return preg_replace('/\{\?(\s.+)\?\}/', '<?php ${1}; ?>', $var);
		});

		Blade::directive('var', function ($expression) {
			list($name, $val) = explode('=', $expression);
			return "<?php {$name} = {$val}; ?>";
		});

	}
}
