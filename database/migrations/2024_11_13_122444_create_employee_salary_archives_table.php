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
        Schema::create('employee_salary_archives', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('employee_id')->unsigned();
            $table->float('basis_net')->nullable()->default(0);
            $table->float('basis_gross')->nullable()->default(0);
            $table->date('basis_valid_from');
            $table->integer('basis_valid_from_year')->nullable()->unsigned();
            $table->integer('basis_valid_from_month')->nullable()->unsigned();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_salary_archives');
    }
};
