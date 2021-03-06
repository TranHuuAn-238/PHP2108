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
        Schema::table('permissions', function (Blueprint $table) {
            $table->dropColumn('slug');
        });

        if (!Schema::hasColumn('permissions', 'slug')) {
            // ko tồn tại cột thì mới thêm vào, đảm bảo đã nếu đã xóa rồi thì mới thêm cột
            Schema::table('permissions', function (Blueprint $table) {
                $table->string('slug',150)->after('name');
            });
        }

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('permissions', function (Blueprint $table) {
            //
        });
    }
};
