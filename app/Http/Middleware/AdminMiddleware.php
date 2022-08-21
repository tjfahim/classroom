<?php

namespace App\Http\Middleware;

use App\Models\Admin;
use App\Models\Teacher;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // if(Admin::check()){

        // }
        // elseif(Teacher::check()){

        // }
        // elseif(User::check())

        return $next($request);
    }
}
