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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('user_employee_id')->unsigned();
            $table->foreign('user_employee_id', 'user_fk')
                ->on('users')->references('id')
                ->onDelete('cascade');

            $table->bigInteger('role_employee_id')->unsigned();
            $table->foreign('role_employee_id', 'roles_fk')
                ->on('roles')->references('id')
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
        Schema::dropIfExists('employees');
    }
};
