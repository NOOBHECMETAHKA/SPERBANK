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
        Schema::create('scores', function (Blueprint $table) {
            $table->id();
            $table->string('score_number', 20)->unique();
            $table->decimal('balance', 10, 2, true);
            $table->timestamp('opening_date')->nullable();

            $table->bigInteger('score_type_id')->unsigned();
            $table->foreign('score_type_id', 'score_type_fk')
                ->on('score_types')->references('id')
                ->onDelete('cascade');

            $table->bigInteger('user_score_id')->unsigned();
            $table->foreign('user_score_id', 'user_score_fk')
                ->on('users')->references('id')
                ->onDelete('cascade');

            $table->boolean('is_deleted')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('scores');
    }
};
