<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;

class UserIsAdmin
{
    const ADMIN_ROLE_ID = 1;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(is_null($request->user())) {
            //если пользователь не авторизован - на главную
            session()->flash('warning', 'Требуется авторизация');
            return redirect()->route('skuListPage');
        }
        $this_user_id = $request->user()->id;
        $this_user = User::with('roles')->find($this_user_id);
        foreach ($this_user->roles as $role) {
            if ($role->id == self::ADMIN_ROLE_ID) {
                //если у пользователя есть роль АДМИН - пропустить
                return $next($request);
            }
        }
        //если роль АДМИН не найдена - на главную
        session()->flash('warning', 'Нет прав администратора');
        return redirect()->route('skuListPage');
    }
}
