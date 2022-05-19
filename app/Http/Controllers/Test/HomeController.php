<?php

namespace App\Http\Controllers\Test;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        // sử dụng middleware trong controller thông qua __construct()
        //$this->middleware('test.login.user')->only('watchFilm'); // chỉ chi phối phương thức watchFilm
        $this->middleware('test.login.user')->except(['index','login']); // loại trừ những phương thức
    }

    public function index(Request $request)
    {
        // $name = $request->input('name'); nhận request từ form gửi lên
        // nhưng nếu nhận tham số truyền trực tiếp từ url thì ko cần input
        $name = $request->name;
        $id = $request->id;
        // dd($name, $id); // ~ var_dump + die
        // return "this is class " . __CLASS__ ;
        return view('test.index'); // đi qua thự mục test và file index.blade.php bên trong(view luôn nằm trong thư mục resources/views)
    }

    public function login(Request $request)
    {
        $username = $request->username; // $username = $request->input('username');
        $password = $request->password;  // $password = $request->input('password');
        // dd($username, $password);
        if($username === 'admin' && $password === '123') {
            $request->session()->put('user', $username);
            //$_SESSION['user'] = $username;
            return redirect()->route('test.watchFilm');
        }
        return redirect()->route('test.home',['name' => 'an', 'id' => 1]);
    }

    public function watchFilm()
    {
        return "xem phim ok";
    }
}
