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
        Schema::create('cards', function (Blueprint $table) {
            $table->id();
            $table->string('owner', 50);
            $table->string('card_number', 45);
            $table->string('ending_date', 45);
            $table->string('CCV_code', 3);

            $table->bigInteger('card_score_id')->unsigned();
            $table->foreign('card_score_id', 'card_score_fk')
                ->on('scores')->references('id')
                ->onDelete('cascade');

            $table->bigInteger('card_type_id')->unsigned();
            $table->foreign('card_type_id', 'card_type_fk')
                ->on('card_types')->references('id')
                ->onDelete('cascade');

            $table->bigInteger('bank_id')->unsigned();
            $table->foreign('bank_id', 'bank_fk')
                ->on('banks')->references('id')
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
        Schema::dropIfExists('cards');
    }
};
