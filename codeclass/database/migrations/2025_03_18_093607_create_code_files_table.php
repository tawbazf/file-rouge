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
        Schema::create('code_files', function (Blueprint $table) {
            $table->id();
            $table->foreignId('code_submission_id')->constrained()->onDelete('cascade');
            $table->string('filename');
            $table->string('file_path')->nullable();
            $table->longText('content');
            $table->string('language');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('code_files');
    }
};