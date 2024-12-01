<?php

namespace Database\Factories;

use App\Models\Historical_Transaction;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class Historical_TransactionFactory extends Factory
{
    protected $model = Historical_Transaction::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $user = User::factory()->create(); // L'utilisateur courant

        // Créez un autre utilisateur pour récupérer son account_number
        $otherUser = User::factory()->create(); // L'autre utilisateur qui envoie ou reçoit la transaction
        return [
            'user_id' => $user->id, // Si vous avez une factory pour User, sinon spécifiez un ID d'utilisateur
            'transaction_type' => $this->faker->randomElement(['deposit', 'withdrawal', 'transfer']),
            'account_number' => $otherUser->account_number,
            'amount' => $this->faker->randomFloat(2, 5, 1000), // Montant aléatoire entre 5 et 1000
            'transaction_date' => $this->faker->dateTimeThisYear(), // Date de la transaction

        ];
    }
}
