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
        Schema::create('operations', function (Blueprint $table) {
            $table->id();

            $table->text('description');

            $table->decimal('accrual_amount', 10, 2, false)->default(0);

            $table->bigInteger('operation_type_id')->unsigned();
            $table->foreign('operation_type_id', 'operation_type_fk')
                ->on('operation_types')->references('id')
                ->onDelete('cascade');

            $table->bigInteger('card_operation_id')->unsigned();
            $table->foreign('card_operation_id', 'card_operation_fk')
                ->on('cards')->references('id')
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
        Schema::dropIfExists('operations');
    }
};
