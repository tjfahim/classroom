<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class AuthenticateStudent extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */

    protected function authenticate($request, array $guard)
    {

            if ($this->auth->guard('student-api')->check()) {
                // return $this->auth->shouldUse('student-api');
                echo "Student API";
            }


        $this->unauthenticated($request, ['student-api']);
    }
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            return route('login');
        }
    }
}
