<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCodeReviewsTable extends Migration
{
public function up()
{
Schema::create('code_reviews', function (Blueprint $table) {
$table->id();
$table->string('filename');
$table->text('code');
$table->unsignedBigInteger('user_id'); // Who submitted the code
$table->timestamps();
});
}
public function down()
{
Schema::dropIfExists('code_reviews');
}
}