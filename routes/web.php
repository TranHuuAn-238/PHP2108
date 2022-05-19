<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
/*
Route::get('/', function () {
    return view('welcome');
});


Route::get('demo', function () {
    return "hi u - demo";
})->name('demo');

// các phương thức(method) truy cập routing
Route::prefix('api')->group(function () {
    // ~ Route::post('api/login', function() {
    Route::post('login', function () {
        return "logined";
    });
    Route::put('method-put', function() {
        return "method put";
    });
    Route::delete('method-delete', function(){
        return "method delete";
    });
});

// tham số truyền lên routing
// 1- Tham số bắt buộc
Route::get('detail/{name}/{id}', function($name, $idPd) {
    // id: tham số
    // $idPd: biến nhận giá trị từ tham số truyền vào
    return "ID sản phẩm - {$idPd} có tên: {$name}";
});
// localhost:8000/detail/iphone-13/10

// 2- Tham số tùy chọn(ko bắt buộc), có ? theo sau và gán = null
Route::get('profile/{name}/{age?}', function($name, $age = null) {
    return "Tên: {$name} - tuổi: {$age}";
})->where(['name' => '[A-Za-z]+', 'age' => '\d+']); // nhiều tham số thì dùng mảng
// localhost:8000/profile/an/10
// validation param: bằng Regular Expression => dùng where()

// đặt tên cho routing: gọi thông qua tên của routing
Route::get('my-dashboard',function() {
    return "home page";
})->name('home');
Route::get('login', function() {
    // truy cập login sẽ tự động chuyển qua trang dashboard
    // return redirect()->route('home'); // home: tên của routing
    return redirect()->route('admin.brand'); // theo ->name('admin.') và ->name('brand')
});
// localhost:8000/login

// group name
// Route::prefix('admin')->name('admin.')->group(function() {
//     Route::get('brand',function() {
//         return "brand page";
//     })->name('brand');
// });

// routing view
Route::get('test-view',function() {
    return view('test'); // trả về thẳng 1 view
});

// test middleware(bộ lọc ktra http request) đã đăng ký
Route::get('production/{name}/{token}', function($name, $token) {
    return "Product name: {$name} - token: {$token}";
})->middleware('check.token'); // routing này sẽ bị kiểm tra bởi middleware
// localhost:8000/production/samsung/sadasd
// localhost:8000/production/samsung/php2108e

Route::get('watch-film/{name}/{age}', function($name, $age) {
    return "Bạn đã đủ {$age} - nên được xem phim {$name}";
})->name('watch-film')->middleware('check.age:user'); // :admin là tham số truyền vào middleware
Route::get('do-not-watch-film', function() {
    return "Bạn chưa đủ tuổi xem phim";
})->name('do-not-watch-film');
// localhost:8000/watch-film/sieunhan/18
// localhost:8000/watch-film/sieunhan/16

// csrf_token()
Route::get('render-token',function() {
    $token = csrf_token();
    return $token;
});
// localhost:8000/render-token
Route::get('render-token-view',function() {
    return view('test');
});

*/