<?php

namespace App\Filament\Resources\HistoricalTransactionResource\Pages;

use App\Filament\Resources\HistoricalTransactionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListHistoricalTransactions extends ListRecords
{
    protected static string $resource = HistoricalTransactionResource::class;

    protected function getHeaderActions(): array
    {
        return [
        ];
    }
}
