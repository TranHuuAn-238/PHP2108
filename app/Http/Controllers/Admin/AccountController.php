<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class AccountController extends Controller
{
    public function __construct()
    {
        // lấy session permission của account đang login (session permissionSessionUser) làm tham số truyền vào middleware
        // $this->middleware('middlename:create-product,thamsob,thamsoc');
    }

    public function index()
    {
        return view('admin.account.index');
    }

    public function addAccount()
    {
        $listRoles = Role::all();
        return view('admin.account.add', [
            'roles' => $listRoles
        ]);
    }

    public function handleAdd(Request $request, Admin $admin)
    {
        // dd($request->all());

        // tiến hành: Thêm mới dl vào bảng admins + Thêm mới dl vào bảng admin_role
        $username = $request->input('username');
        $password = $request->input('password');
        $email = $request->input('email');
        $phone = $request->input('phone');
        $fullName = $request->input('fullname');
        $address = $request->input('address');
        $birthday = $request->input('birthday');  // phải là định dạng YYYY-MM-DD chuẩn mysql
        $birthday = date('Y-m-d', strtotime($birthday));  // YYYY-MM-DD
        $gender = $request->input('gender');
        $gender = $gender === '0' || $gender === '1' ? $gender : '0';
        $roles = $request->input('roles'); // array chứa các vai trò

        // upload image avatar
        // kiểm tra xem có thực sự upload file ko
        $nameAvatar = null; // biến lấy tên file để thêm vào DB
        if($request->hasFile('avatar')) {
            // kiểm tra file up lên có bị lỗi ko
            if($request->file('avatar')->isValid()) {
                // $extension = $request->file('avatar')->getClientOriginalExtension();
                // tiến hành upload file
                // lấy ra tên file(đã đc laravel hash md5 khi lưu trữ ở dưới)
                $nameAvatar = $request->file('avatar')->hashName();
                // di chuyển file vào folder
                $request->file('avatar')->store(PATH_UPLOAD_AVATAR); // upload file avatar vào folder avatars trong public/storage(tên file đã đc tự động hash md5), đường dẫn ko cần storage vì tự hiểu vào storage, sẽ tự tạo folder avatar này nếu chưa có
                // dd($nameAvatar); die;

            }
        }

        // tiến hành lưu vào DB
        // mã hóa mật khẩu trc rồi mới lưu vào DB
        $hasPassword = Hash::make($password);

        $admin->username = $username;
        $admin->password = $hasPassword;
        $admin->email = $email;
        $admin->phone = $phone;
        $admin->fullname = $fullName;
        $admin->address = $address;
        $admin->birthday = $birthday;
        $admin->avatar = $nameAvatar;
        $admin->gender = $gender;

        $admin->save();
        $idAdmin = $admin->id; // lấy ra id vừa insert

        // lưu tiếp vào bảng admin_role
        if(is_numeric($idAdmin) && $idAdmin > 0) {
            $dataRoles = [];
            foreach($roles as $role) {
                $dataRoles[] = [
                    'admin_id' => $idAdmin,
                    'role_id' => $role,
                    'created_at' => date('Y-m-d H:i:s')
                ];
            }
            $insert = DB::table('admin_role')->insert($dataRoles);
            if($insert) {
                // quay về trang list user
                return redirect()->route('admin.account')->with('success.add.user', 'Add success');
            } else {
                // ko insert đc
                // xóa dl ở bảng admin, xóa ảnh đã upload
                // delete avatar(nếu có) đã lỡ upload vừa rồi ở bảng admin
                $user = Admin::find($idAdmin);
                $user->delete();
                if(Storage::exists(PATH_UPLOAD_AVATAR.'/'.$nameAvatar)) {
                    Storage::delete(PATH_UPLOAD_AVATAR.'/'.$nameAvatar);
                }
                // quay về form add
                return redirect()->route('admin.add.account')->with('error.add.user', 'Add failed admin role table');
            }
        } else {
            // có lỗi
            // delete avatar(nếu có) đã lỡ upload vừa rồi
            if(Storage::exists(PATH_UPLOAD_AVATAR.'/'.$nameAvatar)) {
                Storage::delete(PATH_UPLOAD_AVATAR.'/'.$nameAvatar);
            }
            // quay về form add
            return redirect()->route('admin.add.account')->with('error.add.user', 'Add failed admin table');
        }
        
    }
}
