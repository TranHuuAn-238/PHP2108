<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use voku\helper\AntiXSS;
use App\Http\Requests\PostLoginRequest as PostLogin;
use Illuminate\Support\Facades\DB;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function index()
    {
        return view('admin.login.index');
    }

    public function handleLogin(PostLogin $request, AntiXSS $antiXSS)
    {
        $user = $request->input('emailUser');
        $user = $antiXSS->xss_clean($user);
        $password = $request->input('passwordUser');
        $password = $antiXSS->xss_clean($password);
        // dd($user, $password);
        //$infoUser = DB::table('admins')->where(['email' => $user, 'password' => $password])->first(); // dieu kien trong where o day la dieu kien 'and'
        
        //1. ktra username có hợp lệ ko
        $infoUser = Admin::where(['email' => $user])->first(); // orm
        //2. ktra mk có hợp lệ ko
        // dd($infoUser);
        // query builder tra ve object, ko phai array nen phai dung '->'
        // dd($infoUser->id);

        // if($user === 'admin@gmail.com' && $password === '123456') {
        if($infoUser !== null) {
            $hasPassword = $infoUser->password; // lấy được mk đã mã hóa trong DB
            // so sánh mk đã mã hóa này với mk người dùng gửi lên
            if(Hash::check($password, $hasPassword)) {
                 // ok
                $request->session()->put('sessionEmailUser', $infoUser->email); // ~ $_SESSION['sessionEmailUser'] = $user;
                $request->session()->put('sessionIdUser', $infoUser->id);
                $request->session()->put('sessionUser', $infoUser->username);
                // chạy vào trang chọn vai trò sử dụng
                return redirect()->route('admin.choose.role');
                // ~ header("Location: index.php?c=dashboard");
            }
            return redirect()->back()->with('invalidLogin', 'Tài khoản không tồn tại'); // quay về lại form login vs thông báo lỗi
            
        } else {
            // account not exists
            // with: lưu vào flash session (session tạm - f5 sẽ mất)
            return redirect()->back()->with('invalidLogin', 'Tài khoản không tồn tại'); // quay về lại form login vs thông báo lỗi
        }
    }

    public function logout(Request $request)
    {
        // hủy session đc tạo ra đang tồn tại
        // quay về trang login
        $request->session()->flush();
        return redirect()->route('admin.login');
    }
}
