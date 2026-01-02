<?php

namespace App\Filament\Resources\Bookings\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class BookingInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('user.name')
                    ->label('المستخدم')
                    ->placeholder('-'),
                TextEntry::make('restaurant.name')
                    ->label('المطعم')
                    ->placeholder('-'),
                TextEntry::make('tableType.name')
                    ->label('نوع الطاولة')
                    ->placeholder('-'),
                TextEntry::make('booking_date')
                    ->dateTime(),
                TextEntry::make('guests_count')
                    ->numeric(),
                TextEntry::make('status')
                    ->badge(),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
