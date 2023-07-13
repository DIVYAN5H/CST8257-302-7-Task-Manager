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
        Schema::create('lists', function (Blueprint $table) {
            $table->id('list_id');
            $table->unsignedBigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('title');
            $table->timestamps();
        });
        Schema::create('task', function (Blueprint $table) {
            $table->id('task_id');
            $table->unsignedBigInteger('list_id')->unsigned();
            $table->foreign('list_id')->references('list_id')->on('lists');
            $table->string('description');
            $table->date('due_date');
            $table->integer('priority');
            $table->timestamps();
        });
        Schema::create('priority', function (Blueprint $table) {
            $table->id('priority_id');
            $table->string('priority_level');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasklist');
    }
};
