<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserIsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (!is_null(Auth::user()) && Auth::user()->hasAnyRole($roles)) {
            return $next($request);
        }

        //если у пльзователя нет нужных ролей - на главную
        session()->flash('warning', __('flushes.access_denied'));
        return redirect()->route('skuListPage');
    }
}
