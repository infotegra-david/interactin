<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role, $permission = '')
    {
        if (Auth::guest()) {
            return redirect(route('login'));
        }

        if (! $request->user()->hasRole($role)) {
            //abort(403);
            return Response::make(view('errors.403'), 403);
        }
        if ($permission != '') {
            if (! $request->user()->can($permission)) {
               //abort(403);
               return Response::make(view('errors.403'), 403);
            }
        }
        

        return $next($request);
    }
}
