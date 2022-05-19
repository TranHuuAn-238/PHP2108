<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $sessionUser = $request->session()->get('sessionEmailUser'); // ~ $sessionUser = $_SESSION['sessionEmailUser'] ?? '';

        // test lấy session permission của account đang login (session permissionSessionUser)
        // $permit = $request->session()->get('permissionSessionUser');
        // dd($permit);

        $students = [
            [
                'id' => 1,
                'name' => '<h1><i>Huu An</i></h1>',
                'email' => 'an@gmail.com',
                'address' => 'Ha Noi',
                'age' => 21,
                'gender' => 1,
                'money' => 3500000
            ],
            [
                'id' => 2,
                'name' => 'Han',
                'email' => 'han@gmail.com',
                'address' => 'Hai Phong',
                'age' => 20,
                'gender' => 1,
                'money' => 3000000
            ],
            [
                'id' => 3,
                'name' => 'Tu',
                'email' => 'tu@gmail.com',
                'address' => 'Nghe An',
                'age' => 22,
                'gender' => 0,
                'money' => 2000000
            ],
            [
                'id' => 4,
                'name' => 'Tien',
                'email' => 'tien@gmail.com',
                'address' => 'Ha Nam',
                'age' => 19,
                'gender' => 0,
                'money' => 2500000
            ]
        ];

        return view('admin.dashboard.index', [
            'user' => $sessionUser,
            'students' => $students
        ]);
    }

    public function search(Request $request)
    {
        // kiểm tra xem có phải phương thức truy cập là ajax từ client ko
        if($request->ajax()) {
            $data = $request->key;
            // gửi kq, response về cho client
            return response()->json([
                'data' => $data
            ]);
        }
    }
}
