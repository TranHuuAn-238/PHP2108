<?php

namespace App\Http\Controllers\Test;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Role;
use App\Models\Brand;
use App\Models\Production;

class EloquentController extends Controller
{
    public function query()
    {
        $user = Role::find(1)->admins;
        dd($user->toArray());

        $roles = Admin::find(2)->roles()->orderBy('name')->get(); // roles() là hàm liên kết trong model Admin
        dd($roles->toArray());

        $pd = Production::find(1); // tim san pham co id = 1
        dd($pd->brand->logo); // lay ra logo thuong hieu cua san pham do

        // $product = Brand::find(1)->productions; // lay san pham co id brand = 1
        // dd($product);
        // foreach($product as $key => $p) {
        //     // var_dump($p);
        //     echo $p->id;
        // }
        // die;

        // $data = Admin::all(); //object
        // if($data) {
        //     // convert to Array, chi co ORM dung dc, query builder ko dung dc
        //     dd($data->toArray());
        // }
    }

    public function addUser()
    {
        return view('test.add-user');
    }

    public function handleAdd(Request $request, Admin $admin)
    {
        //dd($request->all()); // lay tat ca dl gui qua
        // $admin->username = $request->input('username');
        // $admin->password = $request->input('password');
        // $admin->save(); // luu vao DB

        // ky thuat Mass Assignment giup add nhanh du lieu hon so voi cach ben tren(chi co ORM dung duoc, query builder ko ho tro)
        // name của các thẻ input phải trùng vs tên trường trong DB
        // phai khai bao $fillable ben model truoc de dung dc ky thuat nay
        //$add = Admin::create($request->all());
        //dd($add);

        Admin::firstOrCreate($request->all()); // tim ban ghi, neu ko co/ko ton tai ban ghi nay thi insert luon ~ firstOrNew

        $user2 = Admin::firstOrCreate($request->all()); // tim ban ghi, neu ko co/ko ton tai, ko tra ve 1 instance cua admin thi moi goi save() de insert
        $user2->save();

        // tu dong kiem tra xem update hay insert data
        Admin::updateOrCreate($request->all());
    }
}
