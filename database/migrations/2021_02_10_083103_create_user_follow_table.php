<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserFollowTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_follow', function (Blueprint $table) {

            $table->increments('id');

            // 追加
            $table->integer('user_id')->unsigned()->index();
            $table->integer('follow_id')->unsigned()->index();

            $table->timestamps();
            
            // 外部Key固定
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            
            // onDelete cascade: 一緒に消す (このTableのDataも一緒に消す)

            $table->foreign('follow_id')->references('id')->on('users')->onDelete('cascade');

            // onDelete cascade: 一緒に消す (このTableのDataも一緒に消す)


            // user_idとfollow_idの組み合わせの重複を許さない　Followは1回限り
            $table->unique(['user_id', 'follow_id']);
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_follow');
    }
}
