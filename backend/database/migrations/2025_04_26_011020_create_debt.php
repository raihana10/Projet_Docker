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
        Schema::create('debt', function (Blueprint $table) {
            $table->id('idDebt');
            $table->unsignedBigInteger('idfrom');
            $table->unsignedBigInteger('idto');
            $table->unsignedBigInteger('idGroupe');
            $table->decimal('montant');
            $table->string('description')->nullable();
            $table->string('status');
            $table->date('date');
            $table->foreign('idfrom')
                  ->references('idUtilisateur')
                  ->on('utilisateur')
                  ->onDelete('cascade');
            $table->foreign('idto')
                  ->references('idUtilisateur')
                  ->on('utilisateur')
                  ->onDelete('cascade');
            $table->foreign('idGroupe')
                  ->references('id')
                  ->on('groupe')
                  ->onDelete('cascade');
        
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('debt');
    }
};
