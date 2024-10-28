<?php

use App\Models\Fpk;
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
        Schema::create('fpk_details', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Fpk::class)->constrained()->onDelete('cascade');
            $table->enum('gender', ['Laki - laki', 'Perempuan']);
            $table->integer('usia');
            $table->string('thn_pengalaman');
            $table->string('pendidikan');
            $table->string('jurusan');
            $table->string('lokasi_kerja');
            $table->text('uraian');
            $table->text('spesifikasi');
            $table->text('soft_skill');
            $table->integer('revisi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fpk_details');
    }
};
