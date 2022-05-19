<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class TokenAuthenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $permission = 0)
    {
        // middleware sẽ nhận param chính là id permission truyền lên
        // id permission này sẽ đc ta định nghĩa trong code dựa vào bảng database permission

        // kiểm tra id permission với session lưu trữ toàn bộ id permission của account để biết được role đó sẽ có những quyền gì
        $strSessionPermission = $request->session()->get('permissionSessionUser');
        $arrSessionPermission = explode(',', $strSessionPermission);
        if(!in_array($permission, $arrSessionPermission)) {
            // điều hướng sang trang thông báo không có quyền truy cập
            return redirect()->route('admin.not.permission');
        }

        return $next($request);
    }
}
