<?php

namespace App\Filament\Resources\Bookings\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class BookingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('user_id')
                    ->relationship('user', 'name')
                    ->searchable()
                    ->required()
                    ->preload(),
                Select::make('restaurant_id')
                    ->relationship('restaurant', 'name') // هذا السطر يجلب أسماء المطاعم تلقائياً
                    ->searchable()
                    ->required()
                    ->preload(),
                Select::make('table_type_id')
                    ->relationship('tableType', 'name')
                    ->searchable(['restaurants_id']) // هذا السطر يجلب أسماء أنواع الطاولات تلقائياً
                    ->required()
                    ->preload(),
                DateTimePicker::make('booking_date')
                    ->required(),
                TextInput::make('guests_count')
                    ->required()
                    ->numeric(),
                Select::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'confirmed' => 'Confirmed',
                        'cancelled' => 'Cancelled',
                        'completed' => 'Completed',
                    ])
                    ->default('pending')
                    ->required(),
            ]);
    }
}
