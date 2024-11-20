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
        Schema::create('devices_data_for_mif_reporting', function (Blueprint $table) {
            $table->id();

            $table->integer('agr_id')->nullable()->unsigned();
            $table->string('agr_no')->nullable();
            $table->date('agr_date_start')->nullable();
            $table->date('agr_date_end')->nullable();
            $table->integer('agr_patron_id')->nullable()->unsigned();
            $table->string('agr_patron_txt')->nullable();
            $table->integer('agr_department_id')->nullable()->unsigned();
            $table->string('agr_department_acronym')->nullable();

            $table->integer('agr_status_id')->nullable()->unsigned();
            $table->integer('agr_kind_id')->nullable()->unsigned();
            $table->integer('agr_type_id')->nullable()->unsigned();
            $table->string('agr_status_txt')->nullable();
            $table->string('agr_kind_txt')->nullable();
            $table->string('agr_type_txt')->nullable();

            $table->integer('agr_item_id')->nullable()->unsigned();
            $table->string('agr_item_name')->nullable();
            $table->string('agr_item_serial_no')->nullable();

            $table->integer('dev_type_id')->nullable()->unsigned();
            $table->integer('dev_kind_id')->nullable()->unsigned();
            $table->integer('dev_format_id')->nullable()->unsigned();
            $table->integer('dev_typ1_id')->nullable()->unsigned();
            $table->integer('dev_producer_id')->nullable()->unsigned();

            $table->string('dev_type_txt')->nullable();
            $table->string('dev_kind_txt')->nullable();
            $table->string('dev_format_txt')->nullable();
            $table->string('dev_typ1_txt')->nullable();
            $table->string('dev_producer_txt')->nullable();

            $table->string('dev_family_txt')->nullable();

            $table->integer('dev_id')->nullable()->unsigned();
            $table->integer('dev_cust_id')->nullable()->unsigned();
            $table->string('dev_cust_name',352)->nullable();
            $table->string('dev_cust_tin')->nullable();

            $table->integer('created_at_month')->nullable()->unsigned();
            $table->integer('created_at_year')->nullable()->unsigned();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('devices_data_for_mif_reporting');
    }
};
