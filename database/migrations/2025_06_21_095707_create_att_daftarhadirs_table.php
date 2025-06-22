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
        Schema::create('att_daftarhadirs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('agenda_id');
            $table->string('title');
            $table->text('description');
            $table->boolean('duplikat');
            $table->timestamps();
            $table->foreign('agenda_id')->references('id')->on('agendas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('att_daftarhadirs');
    }
};
