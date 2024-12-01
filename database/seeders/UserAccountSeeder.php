<?php

namespace Database\Seeders;


use App\Models\Account;
use App\Models\Historical_Transaction;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserAccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        User::factory(10)->create()->each(function ($user) {
            // Pour chaque utilisateur créé, créer 5 transactions historiques
            Historical_Transaction::factory(5)->create([
                'user_id' => $user->id, // Associer chaque transaction à l'utilisateur
                'account_number' => $user->account_number,
            ]);
        });
    }
}
