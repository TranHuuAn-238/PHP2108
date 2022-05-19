<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckSwitchRoleAdmin
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
        // ~ CheckLoginAdminPage
        // phải chọn vai trò rồi thì mới được vào bên trong dashboard trở đi
        $sessionPermission = $request->session()->get('permissionSessionUser');
        if(empty($sessionPermission)) {
            return redirect()->route('admin.choose.role');
        }
        return $next($request);
    }
}
