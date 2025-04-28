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
        Schema::table('badges', function (Blueprint $table) {
           
            $table->integer('points')->default(0)->after('level');
            $table->integer('min_points')->default(0)->after('points_required');
            $table->integer('min_activity_hours')->default(0)->after('min_points');
            $table->integer('time')->default(0)->after('min_activity_hours');
            $table->integer('projects')->default(0)->after('time');
            $table->string('color')->default('#3490dc')->after('projects');
            
            
            $table->text('description')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('badges', function (Blueprint $table) {
           
            $table->dropColumn([
                'points',
                'min_points',
                'min_activity_hours',
                'time',
                'projects',
                'color'
            ]);
            
            
            $table->text('description')->nullable(false)->change();
        });
    }
};