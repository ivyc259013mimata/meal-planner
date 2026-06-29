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
        Schema::create('recipes', function (Blueprint $table) {
            $table->id();   // 通し番号(PK)
            $table->timestamps();// 作成・更新日時
            $table->string('name');// レシピ名
            $table->string('category');// カテゴリ
            $table->boolean('is_favorite')->default(false);//お気に入りかどうか
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recipes');
    }
};
