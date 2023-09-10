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
        Schema::create('tests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('level_id');
            $table->unsignedBigInteger('mode_id');
            $table->timestamps();

            $table->foreign('level_id')
                ->references('id')
                ->on('levels')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->foreign('mode_id')
                ->references('id')
                ->on('modes')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tests', function (Blueprint $table) {
            $table->dropForeignIdFor(App\Models\Mode::class);
            $table->dropForeignIdFor(App\Models\Level::class);
        });
        Schema::dropIfExists('tests');
    }
};
