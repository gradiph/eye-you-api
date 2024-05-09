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
        Schema::create('achievement_user', function (Blueprint $table) {
            $table->unsignedBigInteger('achievement_id');
            $table->foreignIdFor(App\Models\User::class)
                ->constrained()
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->timestamps();
            
            $table->primary(['achievement_id', 'user_id']);
            $table->foreign('achievement_id')
                ->references('id')
                ->on('achievements')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('achievement_user', function (Blueprint $table) {
            $table->dropForeignIdFor(App\Models\Achievement::class);
            $table->dropForeignIdFor(App\Models\User::class);
        });
        Schema::dropIfExists('achievement_user');
    }
};
