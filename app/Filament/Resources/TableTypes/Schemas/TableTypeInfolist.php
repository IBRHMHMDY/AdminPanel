<?php

namespace App\Filament\Resources\TableTypes\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class TableTypeInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('restaurant.name')
                    ->label('المطعم')
                    ->placeholder('-'),
                TextEntry::make('name')
                    ->label('نوع الطاولة'),
                TextEntry::make('capacity')
                    ->numeric()
                    ->label('السعة'),
                TextEntry::make('quantity')
                    ->numeric()
                    ->label('العدد المتوفر'),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
