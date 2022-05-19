<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    public function index()
    {
        // list role
        return view('admin.roles.index');
    }

    public function addRole()
    {
        // add role
        $permission = Permission::all();
        // dd($permission->toArray());
        return view('admin.roles.add', [
            'permission' => $permission
        ]);
    }

    public function handleAddRole(Request $request)
    {
        if($request->ajax()) {
            // echo response()->json($request->all());
            // validation data
            $validator = Validator::make($request->all(),[
                'nameRole' => 'required|unique:roles,name', // tên bảng, tên trường trong DB
                'strIdPermission' => 'required'
            ],[
                'nameRole.required' => 'Tên role ko được bỏ trống',
                'nameRole.unique' => 'Tên role này đã tồn tại',
                'strIdPermission.required' => 'Hãy gán quyền cho vai trò này'
            ]);

            if($validator->fails()) {
                // có lỗi
                return response()->json(['errors' => $validator->errors()->all()]); // trả về tất cả các lỗi vào mảng errors
            } else {
                // ko có lỗi
                // xử lý add bảng roles trước
                $nameRole = $request->nameRole;
                $slug = slugifyVietnam($nameRole);
                $description = $request->descriptionRole;
                $roles = new Role;
                $roles->name = $nameRole;
                $roles->slug = $slug;
                $roles->description = $description;
                $roles->save();
                // lay ra id vua luu de con luu sang bang role_permission, lenh nay phai ngay sau save()
                $idRole = $roles->id;

                // luu tiep vao bang role_permission
                $strIdPermission = $request->strIdPermission;
                $arrPermission = explode(",", $strIdPermission); // cắt chuỗi ra thành mảng chứa các idPermission
                $dataInsert = [];
                foreach($arrPermission as $idPermission) {
                    // insert nhiều bản ghi - mảng 2 chiều
                    $dataInsert[] = [
                        'role_id' => $idRole,
                        'permission_id' => $idPermission,
                        'created_at' => date('Y-m-d H:i:s')
                    ];
                }
                $insert = DB::table('role_permission')->insert($dataInsert);
                if($insert) {
                    // true
                    return response()->json(['success' => 'Thêm thành công']); 
                }
                return response()->json(['fails' => 'Thêm thất bại']); 
            }
        }
    }
}
