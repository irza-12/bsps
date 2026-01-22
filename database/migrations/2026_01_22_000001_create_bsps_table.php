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
        Schema::create('bsps', function (Blueprint $table) {
            $table->id();
            $table->string('no_kk', 20);
            $table->string('nik', 20);
            $table->string('nama', 100);
            $table->text('alamat');
            $table->string('dusun', 100);
            $table->string('rt', 5);
            $table->integer('tahun');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bsps');
    }
};
