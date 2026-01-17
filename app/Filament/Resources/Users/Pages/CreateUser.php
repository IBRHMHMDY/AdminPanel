<?php

namespace App\Filament\Resources\Users\Pages;

use App\Filament\Resources\Users\UserResource;
use Filament\Resources\Pages\CreateRecord;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // فحص: إذا لم يكن سوبر أدمن، فالمستخدم الجديد يتبع نفس مطعم المنشئ
        if (! auth()->user()->hasRole('Super Admin')) {
            $data['restaurant_id'] = auth()->user()->restaurant_id;
        }

        return $data;
    }
}
