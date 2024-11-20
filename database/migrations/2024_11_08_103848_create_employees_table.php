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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->integer('altum_id')->unsigned()->default('0'); // id pracownika w Altum
            $table->boolean('activity')->default('0'); // nieaktywny/aktywny w Altum
            $table->string('code')->nullable()->default(''); // kod, akronim z optimy
            $table->string('name')->nullable()->default(''); // imie
            $table->string('surname')->nullable()->default(''); // nazwisko
            $table->string('phone')->nullable()->default(''); // telefon służbowy w Altum
            $table->string('email')->nullable()->default('');
            $table->boolean('is_active')->default('0'); // nieaktywny/aktywny
            $table->bigInteger('department_id')->unsigned()->default('0'); // oddział usera 1:Gdańsk, 2:Katowice ...
            $table->bigInteger('workplace_id')->unsigned()->default('0'); // id stanowiska
            $table->bigInteger('section_id')->unsigned()->default('0'); // id działu
            $table->float('salary_basis_net')->unsigned()->default('0'); // podstawa wynagrodzenia netto
            $table->float('salary_basis_gross')->unsigned()->default('0'); // podstawa wynagrodzenia brutto
            $table->date('salary_basis_valid_from'); // podstawa wynagrodzenia ważna od ...

            $table->timestamps();
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
