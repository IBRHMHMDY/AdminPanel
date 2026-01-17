<?php

namespace App\Filament\Resources\TableTypes\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class TableTypeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextColumn::make('restaurant.name')
                    ->label('المطعم')
                    ->sortable()
                    ->searchable()
                // يظهر فقط للسوبر أدمن
                    ->visible(fn () => auth()->user()->hasRole('Super Admin')),
                TextInput::make('name')
                    ->required(),
                TextInput::make('capacity')
                    ->required()
                    ->numeric(),
                TextInput::make('quantity')
                    ->required()
                    ->numeric(),
            ]);
    }
}
