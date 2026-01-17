<?php

namespace App\Filament\Resources\Restaurants\Pages;

use App\Filament\Resources\Restaurants\RestaurantResource;
use Filament\Resources\Pages\CreateRecord;

class CreateRestaurant extends CreateRecord
{
    protected static string $resource = RestaurantResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // إذا لم يتم تحديد المالك (في حال لم يكن سوبر أدمن)، اجعل المالك هو المستخدم الحالي
        $data['user_id'] = auth()->id();

        return $data;
    }
}
