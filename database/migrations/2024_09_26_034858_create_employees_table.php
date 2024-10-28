<?php

use App\Models\Employee;
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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('employee_name');
            $table->foreignIdFor(Jabatan::class)->nullable()->constrained()->onDelete('set null');
            $table->enum('golongan', ['01','02','03','04','05','06','24','25']);
            $table->enum('status',['Kontrak','Bulan']);
            $table->date('tanggal_bergabung');
            $table->timestamps();
        });

        Schema::table('users', function (Blueprint $table) {
            $table->foreignIdFor(Employee::class)->nullable()->constrained()->onDelete('cascade'); 
        });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
