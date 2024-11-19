<?php

use App\Models\ApprovalLine;
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
        Schema::create('approval_line_user', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(ApprovalLine::class)->constrained()->onDelete('cascade');
            $table->foreignIdFor(User::class)->nullable()->constrained()->onDelete('set null');
            $table->enum('approves_as', ['Superadmin', 'Presdir' ,'Corp. HR', 'Direksi 1', 'Direksi 2', 'Direksi 3', 'Dept. Head']);
            $table->integer('order');
            $table->timestamps();
            $table->unique(['approval_line_id', 'approves_as'], 'approval_line_user_unique');
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('approval_line_user');
    }
};
