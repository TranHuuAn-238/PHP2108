<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // cập nhật bảng roles - ko tạo bảng mới
        Schema::table('roles', function (Blueprint $table) {
            $table->string('name',60)->unique()->change(); // sửa kiểu dl
            $table->dropColumn('test'); // xóa cột
            $table->string('description',200)->nullable()->change(); // thêm cho phép null
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('roles', function (Blueprint $table) {
            //
        });
    }
};
