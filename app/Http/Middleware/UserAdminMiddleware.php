<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;

class UserAdminMiddleware {
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	protected $auth;

	public function __construct(Guard $auth) {
		$this->auth = $auth;
	}

	public function handle($request, Closure $next) {
		if ($this->auth->guest()) {
			if ($request->ajax()) {
				return response('unautherised.', '401');
			} else {
				return redirect()->guest('/');
			}
		} elseif ($this->auth->user()->is_users_admin == '1') {
			return $next($request);
		} else {
			return redirect()->guest('/');
		}

	}
}
