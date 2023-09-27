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
        Schema::create('direct_distributor', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->char('allow_quotation', '1');
            $table->char('allow_partner', '1');
            $table->char('sisrev_brazil_code', '12');
            $table->char('sisrev_eua_code', '12');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('direct_distributor');
    }
};
