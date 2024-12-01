<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HistoricalTransactionResource\Pages;
use App\Filament\Resources\HistoricalTransactionResource\RelationManagers;
use App\Models\Historical_Transaction;
use App\Models\HistoricalTransaction;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class HistoricalTransactionResource extends Resource
{
    protected static ?string $model = Historical_Transaction::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';



    public static function table(Table $table): Table
    {

        return $table
            ->query(Historical_Transaction::query()->where('user_id' , auth()->id()))
            ->columns([
                Tables\Columns\TextColumn::make('transaction_type'),
                Tables\Columns\TextColumn::make('amount'),
                Tables\Columns\TextColumn::make('account_number'),
                Tables\Columns\TextColumn::make('transaction_date'),

            ])







            ->filters([
                //
            ])
            ->actions([
            ])
            ->bulkActions([
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }
    public static function getModel() : string
    {

        return Historical_Transaction::class;
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListHistoricalTransactions::route('/'),

        ];
    }
}
