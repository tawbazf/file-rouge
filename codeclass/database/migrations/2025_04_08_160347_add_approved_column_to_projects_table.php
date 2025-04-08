<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddApprovedColumnToProjectsTable extends Migration
{
    public function up()
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->boolean('approved')->default(false);
            // Add the deadline column too if it doesn't exist
            if (!Schema::hasColumn('projects', 'deadline')) {
                $table->timestamp('deadline')->nullable();
            }
        });
    }

    public function down()
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn('approved');
            // Uncomment if you want to drop the deadline column in case of rollback
            // $table->dropColumn('deadline');
        });
    }
}