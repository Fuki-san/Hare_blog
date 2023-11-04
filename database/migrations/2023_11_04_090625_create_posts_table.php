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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('body');
            $table->string('image');
            //外部キーをもつカラムの追加。blogの個人情報を誰が登録したのかを確認するためにuser_idカラムを作成。
            //Userモデルがusersテーブルを操作。user_idはusersテーブルと結びついている
            $table->foreignID('user_id')
                //外部キーの制約。現在usersテーブルとpostsテーブルがあるが、usersのidとpostsのuser_idを紐づけるconstrained制約
                ->constrained()
                //親のusersテーブル(のカラムが)変更された場合に、子テーブルのpostsも変更されるように
                ->cascadeOnUpdate()
                //同様に、usersの個人情報が削除されたときに、postsの投稿が消えるように
                ->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
