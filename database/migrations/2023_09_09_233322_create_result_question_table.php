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
        Schema::create('result_question', function (Blueprint $table) {
            $table->foreignIdFor(App\Models\Result::class)
                ->constrained()
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreignIdFor(App\Models\Question::class)
                ->constrained()
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreignIdFor(App\Models\Answer::class)
                ->constrained()
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('result_question', function (Blueprint $table) {
            $table->dropForeignIdFor(App\Models\Result::class);
            $table->dropForeignIdFor(App\Models\Question::class);
            $table->dropForeignIdFor(App\Models\Answer::class);
        });
        Schema::dropIfExists('result_question');
    }
};
