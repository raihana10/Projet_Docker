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
        Schema::create('appartient', function (Blueprint $table) {
            $table->unsignedBigInteger('idUtilisateur');
            $table->unsignedBigInteger('idGroupe');
        
            $table->foreign('idUtilisateur')
                  ->references('idUtilisateur')
                  ->on('utilisateur')
                  ->onDelete('cascade');
        
            $table->foreign('idGroupe')
                  ->references('id')
                  ->on('groupe')
                  ->onDelete('cascade');
        
            $table->timestamps();
        
            // Optionnel : clé primaire composée
            $table->primary(['idUtilisateur', 'idGroupe']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appartient');
    }
};
