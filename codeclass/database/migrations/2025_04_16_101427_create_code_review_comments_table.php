<?php



use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCodeReviewCommentsTable extends Migration
{
    public function up()
    {
        Schema::create('code_review_comments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('code_review_id');
            $table->unsignedBigInteger('user_id'); // Who commented
            $table->string('tag');
            $table->text('comment');
            $table->timestamps();

            $table->foreign('code_review_id')->references('id')->on('code_reviews')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }
    public function down()
    {
        Schema::dropIfExists('code_review_comments');
    }
}