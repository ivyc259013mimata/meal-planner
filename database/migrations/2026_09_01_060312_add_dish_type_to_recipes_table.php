<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('recipes', function (Blueprint $table) {
            // 主菜か副菜かを保存する列を追加。初期値は主菜にしておく
            $table->string('dish_type')->default('主菜');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('recipes', function (Blueprint $table) {
            // ロールバックしたときは、この列を削除する
            $table->dropColumn('dish_type');
        });
    }
};