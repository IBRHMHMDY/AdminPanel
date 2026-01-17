<?php

namespace App\Filament\Resources\Roles\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class RoleForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('اسم الدور (Role Name)')
                    ->required()
                    ->unique(ignoreRecord: true),

                // هذا الجزء يسمح لك باختيار الصلاحيات لهذا الدور
                Select::make('permissions')
                    ->label('الصلاحيات (Permissions)')
                    ->multiple() // اختيار متعدد
                    ->relationship('permissions', 'name') // علاقة مع جدول الصلاحيات
                    ->preload(),
            ]);
    }
}
