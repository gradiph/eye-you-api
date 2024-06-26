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
        Schema::create('result_questions', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(App\Models\Question::class)
                ->constrained()
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreignIdFor(App\Models\Result::class)
                ->constrained()
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->text('image');
            $table->unsignedInteger('duration');
            $table->unsignedInteger('score');
            $table->string('correct_answer');
            $table->string('actual_answer')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('result_questions', function (Blueprint $table) {
            $table->dropForeignIdFor(App\Models\Question::class);
            $table->dropForeignIdFor(App\Models\Result::class);
        });
        Schema::dropIfExists('question_result');
    }
};
