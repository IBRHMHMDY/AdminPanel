<?php

namespace App\Filament\Resources\Restaurants\Schemas;

use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TimePicker;
use Filament\Schemas\Schema;

class RestaurantForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                Textarea::make('address')
                    ->default(null)
                    ->columnSpanFull(),
                TextInput::make('phone')
                    ->tel()
                    ->default(null),
                SpatieMediaLibraryFileUpload::make('image')
                    ->collection('restaurant_images') // <--- CRITICAL: Must match the collection used in the Table
                    ->label('Restaurant Logo')
                    ->imageEditor()
                    ->disk('public')         // Specify the disk to store images
                    ->multiple()             // Allow multiple files
                    ->reorderable()          // Allow drag-and-drop reordering
                    ->responsiveImages(),    // Generate responsive variants
                TimePicker::make('open_at')
                    ->required(),
                TimePicker::make('close_at')
                    ->required(),
            ]);
    }
}
