<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;

class RestaurantController extends Controller
{
    public function index()
    {
        // جلب المطاعم مع أنواع الطاولات الخاصة بكل مطعم
        return response()->json(Restaurant::with('tableTypes')->get());
    }

    public function show($id)
    {
        return response()->json(Restaurant::with('tableTypes')->findOrFail($id));
    }
}
