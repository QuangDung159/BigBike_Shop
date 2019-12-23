<?php

namespace App\Http\Middleware;

use App\Constant;
use Closure;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class AuthenAdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Session::has('admin_id')) {
            return $next($request);
        } else {
            Session::put('msg_no_authen', 'Please login to go this page.');
            return Redirect::to(Constant::URL_ADMIN_LOGIN);
        }
    }
}
