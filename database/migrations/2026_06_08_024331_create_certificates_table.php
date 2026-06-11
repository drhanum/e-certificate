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
        Schema::create('certificates', function (Blueprint $table) {

            $table->id();

            $table->string('name');
            $table->string('email');
            
            $table->string('event_name');
            $table->string('organizer_name');

            $table->date('event_date');

            $table->string('certificate_number')->unique();

            $table->date('certificate_issue_date');

            $table->string('activity_type');

            $table->string('category');

            $table->date('valid_until')->nullable();

            $table->string('file_path')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('certificates');
    }
};
