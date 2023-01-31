<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ProjectUserPivot extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teams_users', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->integer('user_id')->nullable()->comment("Пользователь");
            $table->integer('team_id')->nullable()->comment("Команда");
            $table->string('memberType')->nullable()->comment("Тип участника")->default("editor");
            $table->boolean('is_invite')->default(false)->comment("Если это приглашение. Тогда участник не участник пока не согласится");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('teams_users');
    }
}
