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
            $table->foreignIdFor(BisnisUnit::class)->nullable()->constrained()->onDelete('cascade');
            $table->string("approval_line_desc")->nullable();
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
