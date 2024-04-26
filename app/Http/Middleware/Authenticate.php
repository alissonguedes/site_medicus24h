<?php

namespace App\Http\Middleware;

// use App\Models\System\ModuloModel;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

// use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class Authenticate extends Middleware
{

	/**
	 * Get the path the user should be redirected to when they are not authenticated.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return string|null
	 */
	protected function redirectTo($request)
	{

		if (!Auth::check()) {

			$base = basename(request()->path());

			if ($base != 'login') {

				return redirect()->route('login');

				// return redirect(request()->path($base));
			}

		} else {

		}

		// $modulo = new ModuloModel();

		// $current_route          = Route::currentRouteAction();
		// $current_route          = explode('@', $current_route);
		// $controller             = $current_route[0];
		// $action                 = $current_route[1];
		// $route                  = Route::currentRouteName();
		// $path                   = getCurrentPath();
		// $is_restrict_module     = $modulo->getIsRestrictModulo('/' . $path);
		// $is_restrict_controller = $modulo->getIsRestrictController($controller);
		// $is_restrict_route      = $modulo->getIsRestrictRoute($controller, $action, $route);
		// $login                  = $modulo->getRouteLogin('/' . $path);
		// $public_access          = $modulo->getIsNotRestritctRoutes($controller, $action);
		// $can_public_access      = [];

		// if ($public_access) {
		// 	foreach ($public_access as $can) {
		// 		$can_public_access[] = $can->name;
		// 	}
		// }

		// $login = $modulo->getRouteLogin('/' . $path);

		// if (!empty($login)) {
		// 	return route($login->name);
		// }

		// return route('account.auth.login', $path);

		return $redirector($request);

	}

}
