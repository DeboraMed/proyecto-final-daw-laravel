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
        Schema::create('vacancies', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('title')->nullable();
            $table->string('description')->nullable();
            $table->string('contract_type')->nullable();
            $table->string('work_mode')->nullable();
            $table->string('schedule')->nullable();
            $table->string('academic_level')->nullable();
            $table->date('date')->nullable();
            $table->foreignId('company_id')->constrained()->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vacancies');
    }
};
