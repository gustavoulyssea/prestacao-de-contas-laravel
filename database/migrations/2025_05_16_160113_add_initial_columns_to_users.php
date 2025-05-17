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
        Schema::table('users', function (Blueprint $table) {
            $table->string('cnpj')->unique();
            $table->string('razao_social');
            $table->string('responsible_name');
            $table->string('telephone');
            $table->string('uf');
            $table->string('city');
            $table->string('street');
            $table->string('street_number');
            $table->string('street_complement');
            $table->string('post_code');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
