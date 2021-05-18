<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCookTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cook', function (Blueprint $table) {
            $table->increments('id');
            // 材料、栄養、カテゴリは別のテーブルと関連付ける
            $table->string('title'); // 料理のタイトル
            $table->string('materials'); // 材料のデータ
            $table->string('nutritions'); // 栄養のデータ
            $table->string('cat_ids'); // カテゴリ idの配列
            $table->string('cook_time'); // 制作時間
            $table->integer('num_people'); // 人数
            $table->string('created_by'); // 製作者の名前
            // 写真データ
            $table->string('picture_name');
            $table->string('picture_path');

            $table->string('howtomake'); // 作り方のテキスト
            $table->string('point'); // 作る際のポイント
            $table->string('excerpt'); // キャッチコピー、レシピの簡単な説明

            $table->timestamps(); // 作成日
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cook');
    }
}
