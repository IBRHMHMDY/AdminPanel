<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                TextInput::make('email')
                    ->label('Email address')
                    ->email()
                    ->required(),
                DateTimePicker::make('email_verified_at'),
                Select::make('restaurant_id')
                    ->label('المطعم التابع له')
                    ->relationship('restaurant', 'name')
                    ->searchable()
                    ->preload()
                // الشرط: يظهر فقط إذا كان المستخدم الحالي Super Admin
                    ->visible(fn () => auth()->user()->hasRole('Super Admin')),
                TextInput::make('password')
                    ->password()
                    ->required(),
                Select::make('roles')
                    ->label('الأدوار (Roles)')
                    ->relationship('roles', 'name') // يربط مع جدول الأدوار ويجلب الاسم
                    ->multiple() // يسمح باختيار أكثر من دور
                    ->preload() // يحمل القائمة فوراً
                    ->searchable(), // يضيف خاصية البحث

            ]);
    }
}
