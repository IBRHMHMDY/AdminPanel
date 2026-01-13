<?php

namespace App\Http\Controllers\Api;

class FavoriteController extends Controller
{
    public function favoriteToggle(Request $request, $restaurantId)
    {
        $user = auth()->user();

        if (! $user) {
            return response()->json(['message' => 'غير مصرح'], 401);
        }

        $exists = $user->favorites()
            ->where('restaurant_id', $restaurantId)
            ->exists();

        if ($exists) {
            $user->favorites()->detach($restaurantId);
            $status = false;
        } else {
            $user->favorites()->attach($restaurantId);
            $status = true;
        }

        return response()->json([
            'is_favorited' => $status,
        ]);
    }

    public function index(Request $request)
    {
        $user = $request->user();
        $favoriteRestaurants = $user->favorites()->get();

        return response()->json([
            'favorites' => $favoriteRestaurants,
        ]);
    }
}
