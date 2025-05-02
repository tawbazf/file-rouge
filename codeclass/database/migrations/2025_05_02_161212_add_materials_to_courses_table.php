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
        Schema::table('courses', function (Blueprint $table) {
            $table->json('videos')->nullable()->after('description');
            $table->json('pdfs')->nullable()->after('videos');
            $table->string('level')->nullable()->after('pdfs');
            $table->string('instructor')->nullable()->after('level');
            $table->string('instructor_avatar')->nullable()->after('instructor');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->dropColumn(['videos', 'pdfs', 'level', 'instructor', 'instructor_avatar']);
        });
    }
};