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
        Schema::create('historical_transactions', function (Blueprint $table) {
            $table->id();  // Clé primaire auto-incrémentée
            $table->foreignId('user_id')->constrained()->onDelete('cascade');  // Référence à l'utilisateur
            $table->enum('transaction_type', ['deposit', 'withdrawal', 'payment', 'transfer', 'service']);  // Type de transaction
            $table->decimal('amount', 10, 2);  // Montant de la transaction
            $table->string('account_number');
            $table->string('description')->nullable();  // Description ou détails de la transaction
            $table->string('reference_number')->nullable();  // Numéro de référence de la transaction
            $table->timestamp('transaction_date')->useCurrent();  // Date et heure de la transaction
            $table->timestamps();  // Timestamp pour la création et mise à jour (facultatif)
            // Optionnel : Index pour améliorer les performances des recherches
            $table->index('transaction_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('historical_transactions');
    }
};
