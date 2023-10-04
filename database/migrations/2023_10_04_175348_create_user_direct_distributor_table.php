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
        Schema::create('direct_distributor_user_data', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('direct_distributor_id');
            $table->foreign('user_id')
                    ->references('id')
                    ->on('direct_distributor');
            $table->char('type', 1);
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->char('token', 6)->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('direct_distributor_user_data');
    }
};