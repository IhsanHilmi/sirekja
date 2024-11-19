<?php

use App\Models\ApprovalProcess;
use App\Models\User;
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
        Schema::create('approval_steps', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(ApprovalProcess::class)->constrained()->onDelete('cascade');
            $table->foreignIdFor(User::class)->nullable()->constrained()->onDelete('cascade');
            $table->enum('approves_as', ['Superadmin', 'Presdir' ,'Corp. HR', 'Direksi 1', 'Direksi 2', 'Direksi 3', 'Dept. Head']);
            $table->enum('approval_stat',['Approved','Rejected','No action yet'])->default('No action yet');
            $table->integer('order')->default(1);
            $table->datetime('finished_time')->nullable()->default(null);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('approval_steps');
    }
};
