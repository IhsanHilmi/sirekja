<?php

use App\Models\ApprovalLine;
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
        Schema::create('approval_processes', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(ApprovalLine::class)->constrained()->onDelete('cascade');
            $table->foreignIdFor(Fpk::class)->constrained()->onDelete('cascade');
            $table->integer('current_order')->default(1);
            $table->enum('approval_status', ['Approved', 'Pending/On Going', 'Rejected'])->default('Pending/On Going');
            $table->dateTime('finished_time');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('approval_processes');
    }
};
