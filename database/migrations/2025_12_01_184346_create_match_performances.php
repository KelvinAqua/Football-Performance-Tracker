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
    Schema::create('match_performances', function (Blueprint $table) {
        $table->id();
        $table->foreignId('player_id')->constrained()->onDelete('cascade');
        $table->string('opponent');
        $table->date('match_date');
        $table->unsignedTinyInteger('minutes_played');
        $table->unsignedTinyInteger('goals')->default(0);
        $table->unsignedTinyInteger('assists')->default(0);
        $table->decimal('rating', 3, 1)->nullable();  // Example: 7.5
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('match_performances');
    }
};
