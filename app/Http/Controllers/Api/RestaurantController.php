<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    public function index()
    {
        $user = auth('sanctum')->user();

        $restaurants = Restaurant::with('tableTypes')->get();

        $restaurants->transform(function ($restaurant) use ($user) {
            $restaurant->is_favorited = $user
                ? $restaurant->favorites()
                    ->where('user_id', $user->id)
                    ->exists()
                : false;

            return $restaurant;
        });

        return response()->json($restaurants);
    }

    public function show($id)
    {
        return response()->json(Restaurant::with('tableTypes')->findOrFail($id));
    }

    public function toggleFavorite(Request $request, $id) // تأكد من وجود $id هنا
    {
        $user = auth()->user(); // أو $request->user()

        // تأكد أن العلاقة معرفة في موديل User باسم favoriteRestaurants
        $user->favorites()->toggle($id);

        return response()->json(['status' => 'success']);
    }
}
