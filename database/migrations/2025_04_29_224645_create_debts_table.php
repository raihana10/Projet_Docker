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
        Schema::create('debts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->decimal('value', 10, 2);
            $table->unsignedBigInteger('id_from');
            $table->unsignedBigInteger('id_to');
            $table->unsignedBigInteger('group_id');
            $table->text('description')->nullable();
            $table->enum('status', ['paid', 'unpaid']);
            $table->timestamps();

            $table->foreign('id_from')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id_to')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('group_id')->references('id')->on('groups')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('debts');
    }
};
