<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('campsites', function (Blueprint $table) {
            $table->id();
            $table->string('name', 150);
            $table->text('description')->nullable();
            $table->integer('capacity')->default(1);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('campsites');
    }
};
