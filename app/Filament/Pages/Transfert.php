<?php

namespace App\Filament\Pages;

use App\Models\User;
use Dotenv\Exception\ValidationException;
use Filament\Forms\Components\TextInput;
use Filament\Pages\Actions\ButtonAction;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Transfert extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.transfert';
    public static function canAccess(): bool
    {
        return !auth()->user()->has_card;
    }
    public $recipient_account_number;
    public $amount;

    // Définir le schéma du formulaire
    protected function getFormSchema(): array
    {
        return [
            TextInput::make('recipient_account_number')
                ->label('Recipient Account Number')
                ->required()
                ->placeholder('Enter recipient account number')
                ->maxLength(20),  // Limite la longueur du numéro de compte
            TextInput::make('amount')
                ->label('Amount to send')
                ->required()
                ->numeric()
                ->placeholder('Enter the amount'),
        ];
    }

    // Logique du transfert
    public function send()
    {
        // Valider les données
        $data = $this->validate();

        $sender = Auth::user(); // L'utilisateur actuel (expéditeur)
        $recipient = User::where('account_number', $data['recipient_account_number'])->first(); // Trouver le destinataire par son numéro de compte

        if(!$recipient) {
            $this->addError('recipient_account_number', 'Recipient not found');
            return;
        }


        // Vérifier si l'utilisateur a un solde suffisant
        if ($sender->balance < $data['amount']) {
            $this->addError('amount', 'Insufficient balance');
            return;        }

        // Transaction de base de données pour effectuer le transfert
        DB::transaction(function () use ($sender, $recipient, $data) {
            // Décrémenter le solde de l'expéditeur
            $sender->decrement('balance', $data['amount']);

            // Incrémenter le solde du destinataire
            $recipient->increment('balance', $data['amount']);
        });

        // Message de succès
        session()->flash('success', 'Money sent successfully!');
        return redirect()->route('filament.pages.send-money');  // Redirige après l'envoi
    }

    // Bouton pour envoyer l'argent
    protected function getActions(): array
    {
        return [
            ButtonAction::make('send')
                ->label('Send OTP Code')
                ->action('send')  // Appelle la méthode send()
                ->color('success')
                ->size('lg')
        ];
    }
}
