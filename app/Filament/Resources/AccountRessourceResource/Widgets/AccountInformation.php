<?php

namespace App\Filament\Resources\AccountRessourceResource\Widgets;

use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Auth;

class AccountInformation extends BaseWidget
{
    protected function getStats(): array
    {

        $user = Auth::user();

        return [
            Stat::make('Solde',  intval($user->balance) . ' DA') ,

        ];
    }
}
