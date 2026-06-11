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
        Schema::create('certificate_templates', function (Blueprint $table) {

        $table->id();

        $table->string('template_path');

        $table->decimal('name_x', 8, 2);
        $table->decimal('name_y', 8, 2);

        $table->decimal('category_x', 8, 2);
        $table->decimal('category_y', 8, 2);

        $table->decimal('number_x', 8, 2);
        $table->decimal('number_y', 8, 2);

        $table->string('name_color');
        $table->integer('name_size');

        $table->string('category_color');
        $table->integer('category_size');

        $table->string('number_color');
        $table->integer('number_size');

        $table->timestamps();

});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('certificate_templates');
    }
};
