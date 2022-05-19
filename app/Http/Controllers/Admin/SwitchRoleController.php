<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Role;
use App\Models\Permission;

class SwitchRoleController extends Controller
{
    public function index(Request $request)
    {
        // lấy ra toàn bộ roles của user vừa đăng nhập
        // lấy id của user được lưu ở session lúc login
        $idUser = $request->session()->get('sessionIdUser');
        $roles = Admin::find($idUser)->roles()->orderBy('name')->get();
        // dd($roles->toArray());

        // chọn lại switch role - nếu tồn tại session choose role cũ thì xóa đi
        if($request->session()->get('permissionSessionUser')) {
            $request->session()->forget('permissionSessionUser');
            $request->session()->forget('namePermissionSession');
        }

        return view('admin.switch-role', [
            'roles' => $roles
        ]);
    }

    public function handleSwitchRole(Request $request)
    {
        $idRole = $request->id;
        // $roles = Role::findOrFail($idRole); // ktra xem có $idRole đúng trong DB ko, nếu ko có thì tự trả về trang 403
        $roles = Role::find($idRole); // ko thì tự xử lý riêng
        if($roles === null) {
            return redirect()->back()->with('errorSwitchRole', 'Role not found');
        } else {
            // ok, xử lý tiếp
            // lấy hết các permission của role mà người dùng đã chọn
            $permission = Role::find($idRole)->permissions()->orderBy('name')->get();
            // dd($permission->toArray());
            if($permission === null) {
                return redirect()->back()->with('errorSwitchRole', 'Role not found');
            } else {
                $arrPermission = $permission->toArray();
                $arrSessionPermissions = array_column($arrPermission, 'id'); // tạo 1 mảng chỉ lấy 1 cột(id) của mảng truyền vào
                $strSessionPermissions = implode(",", $arrSessionPermissions); // chuyển mảng thành chuỗi >< explode
                // put: ko lưu đc mảng mà phải dùng push
                // dd($arrSessionPermissions);
                $request->session()->put('permissionSessionUser', $strSessionPermissions); // ->put lưu string, ->push lưu mảng
                $request->session()->put('namePermissionSession', $roles->name);
                // xong, đi vào trang mặc định
                return redirect()->route('admin.dashboard');
            }
        }
    }
}
