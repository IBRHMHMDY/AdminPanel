<?php

namespace App\Filament\Resources\Roles\Tables;

use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class RolesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label('ID')
                    ->sortable(),

                // عمود اسم الدور (Role Name)
                TextColumn::make('name')
                    ->label('اسم الدور') // العنوان الذي سيظهر في الجدول
                    ->searchable()      // يضيف خانة بحث لهذا العمود
                    ->sortable(),       // يسمح بترتيب الجدول أبجدياً

                // عمود يظهر عدد الصلاحيات داخل هذا الدور (ميزة مفيدة جداً)
                TextColumn::make('permissions_count')
                    ->counts('permissions') // يقوم بجمع العلاقة تلقائياً
                    ->label('عدد الصلاحيات')
                    ->badge(), // يظهر الرقم داخل شارة ملونة

                // عمود تاريخ الإنشاء
                TextColumn::make('created_at')
                    ->dateTime('d/m/Y') // تنسيق التاريخ
                    ->label('تاريخ الإنشاء')
                    ->sortable(),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                //
            ]);
    }
}
