<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->unsignedBigInteger('teacher_id')->nullable()->after('user_id');
            // If you want a foreign key constraint:
            // $table->foreign('teacher_id')->references('id')->on('users')->onDelete('set null');
        });
    }
    
    public function down()
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn('teacher_id');
        });
    }
};