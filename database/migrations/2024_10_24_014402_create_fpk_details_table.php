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
            $table->enum('golongan',['01','02','03','04','05','06','24','25']);
            $table->enum('gender', ['Laki - laki', 'Perempuan','Keduanya']);
            $table->integer('usia');
            $table->string('thn_pengalaman');
            $table->enum('pendidikan',['SMA/SMK/MA', 'DIII', 'S1', 'S2']);
            $table->string('jurusan');
            $table->string('lokasi_kerja');
            $table->longText('alasan');
            $table->longText('spesifikasi');
            $table->longText('deskripsi');
            $table->longText('hard_skills')->nullable();
            $table->longText('soft_skills')->nullable();
            $table->text('catatan');
            $table->integer('revisi')->default(0);
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
