<?php

use App\Models\ApprovalLine;
use App\Models\Jabatan;
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
        Schema::create('fpks', function (Blueprint $table) {
            $table->id();
            $table->string('kodeFPK')->unique();
            $table->foreignIdFor(Jabatan::class)->constrained()->onDelete('cascade');
            $table->foreignIdFor(ApprovalLine::class)->constrained()->onDelete('cascade');
            $table->text('approval_status');
            $table->enum('jenis_FPK', ['PHK', 'Resign', 'Mutasi', 'Promosi', 'Demosi', 'Rotasi', 'New Hire']);
            $table->enum('FPK_status', ['Approved', 'Pending', 'Declined']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fpks');
    }
};
