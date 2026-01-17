<?php

namespace App\Filament\Resources\Users\Pages;

use App\Filament\Resources\Users\UserResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // فحص: إذا لم يكن سوبر أدمن، فالمستخدم الجديد يتبع نفس مطعم المنشئ
        if (! auth()->user()->hasRole('Super Admin')) {
            $data['restaurant_id'] = auth()->user()->restaurant_id;
        }

        return $data;
    }
}
