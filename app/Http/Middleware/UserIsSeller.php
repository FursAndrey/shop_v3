<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;

class UserIsSeller
{
    const SELLER_ROLE_IDS = [1, 2];
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (is_null($request->user())) {
            //если пользователь не авторизован - на главную
            session()->flash('warning', __('flushes.required_auth'));
            return redirect()->route('skuListPage');
        }
        $this_user_id = $request->user()->id;
        $this_user = User::with('roles')->find($this_user_id);
        foreach ($this_user->roles as $role) {
            //идеи лучше поканет
            if (in_array($role->id, self::SELLER_ROLE_IDS)) {
                //если у пользователя есть роль АДМИН - пропустить
                return $next($request);
            }
        }
        //если роль АДМИН не найдена - на главную
        session()->flash('warning', __('flushes.access_denied'));
        return redirect()->route('skuListPage');
    }
}
