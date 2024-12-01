<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name() ,
            'account_number' => $this->faker->unique()->numerify('################'), // Générer un numéro de compte unique
            'card_number' => $this->faker->unique()->numerify('#### #### #### ####'), // Générer un numéro de carte unique
            'card_expiration_date' => $this->faker->date('m-y', 'now'), // Date d'expiration de la carte (au format mois/année)
            'balance' => $this->faker->randomFloat(2, 0, 10000), // Solde aléatoire entre 0 et 10 000
            'has_card' => $this->faker->boolean(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'phone_number' => $this->faker->unique()->numerify('##############'),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
