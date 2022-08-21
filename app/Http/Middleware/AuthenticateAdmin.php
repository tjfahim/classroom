<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class AuthenticateAdmin extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */

    protected function authenticate($request, array $guard)
    {

            if ($this->auth->guard('admin-api')->check()) {
                return $this->auth->shouldUse('admin-api');
            }


        $this->unauthenticated($request, ['admin-api']);
    }
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            return route('adminlog');
        }
    }
}
