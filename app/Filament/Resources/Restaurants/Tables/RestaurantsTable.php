<?php

namespace App\Filament\Resources\Restaurants\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class RestaurantsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                SpatieMediaLibraryImageColumn::make('image')
                    ->collection('restaurant_images')
                    ->circular()
                    ->label('')
                    ->disk('public')
                    ->stacked()
                    ->conversion('thumb'),
                TextColumn::make('name')->label('اسم المطعم')->searchable(),
                TextColumn::make('phone')->label('رقم الهاتف')
                    ->searchable(),
                TextColumn::make('open_at')->label('وقت الفتح')
                    ->time()
                    ->sortable(),
                TextColumn::make('close_at')->label('وقت الإغلاق')
                    ->time()
                    ->sortable(),
                TextColumn::make('created_at')->label('تاريخ الإنشاء')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')->label('تاريخ التحديث')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
