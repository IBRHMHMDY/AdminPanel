<?php

namespace App\Filament\Resources\TableTypes;

use App\Filament\Resources\TableTypes\Pages\CreateTableType;
use App\Filament\Resources\TableTypes\Pages\EditTableType;
use App\Filament\Resources\TableTypes\Pages\ListTableTypes;
use App\Filament\Resources\TableTypes\Pages\ViewTableType;
use App\Filament\Resources\TableTypes\Schemas\TableTypeForm;
use App\Filament\Resources\TableTypes\Schemas\TableTypeInfolist;
use App\Filament\Resources\TableTypes\Tables\TableTypesTable;
use App\Models\TableType;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class TableTypeResource extends Resource
{
    protected static ?string $model = TableType::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'TableType';

    public static function form(Schema $schema): Schema
    {
        return TableTypeForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return TableTypeInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return TableTypesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListTableTypes::route('/'),
            'create' => CreateTableType::route('/create'),
            'view' => ViewTableType::route('/{record}'),
            'edit' => EditTableType::route('/{record}/edit'),
        ];
    }
}
