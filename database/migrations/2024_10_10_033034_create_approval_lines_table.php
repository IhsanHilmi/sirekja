<?php

use App\Models\BisnisUnit;
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
        Schema::create('approval_lines', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_employee')->constrained('employees')->onDelete('cascade');
            $table->ForeignIdFor(BisnisUnit::class)->constrained()->onDelete('cascade');
            $table->foreignId('hr_unit')->nullable()->constrained('employees')->onDelete('set null');
            $table->foreignId('direksi_1')->nullable()->constrained('employees')->onDelete('set null');
            $table->foreignId('direksi_2')->nullable()->constrained('employees')->onDelete('set null');
            $table->foreignId('direksi_3')->nullable()->constrained('employees')->onDelete('set null');
            $table->foreignId('presdir')->nullable()->constrained('employees')->onDelete('set null');
            $table->foreignId('corporate_hr')->nullable()->constrained('employees')->onDelete('set null');
            $table->foreignId('superadmin')->nullable()->constrained('employees')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('approval_lines');
    }
};
