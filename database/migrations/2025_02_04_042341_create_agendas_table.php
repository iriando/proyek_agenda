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
        Schema::create('agendas', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('slug')->unique();
            $table->string('deskripsi');
            $table->string('zoomlink')->nullable();
            $table->string('slidolink')->nullable();
            $table->datetime('tanggal_pelaksanaan');
            $table->datetime('tanggal_selesai');
            $table->string('poster')->nullable();
            // $table->boolean('status_survey')->default('0');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agendas');
    }
};
