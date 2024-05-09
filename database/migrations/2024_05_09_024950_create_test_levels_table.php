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
        Schema::create('test_levels', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(App\Models\Test::class)
                ->constrained()
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreignIdFor(App\Models\Level::class)
                ->constrained()
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->unsignedTinyInteger('order');
            $table->unsignedSmallInteger('count');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('test_levels', function (Blueprint $table) {
            $table->dropForeignIdFor(App\Models\Level::class);
            $table->dropForeignIdFor(App\Models\Test::class);
        });
        Schema::dropIfExists('test_levels');
    }
};
