<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\TableType;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'restaurant_id' => 'required|exists:restaurants,id',
            'table_type_id' => 'required|exists:table_types,id',
            'booking_date' => 'required|date_format:Y-m-d H:i',
            'guests_count' => 'required|integer|min:1',
        ]);

        $bookingTime = Carbon::parse($request->booking_date);

        // 1. التحقق من توفر الطاولة
        // سنفترض أن الحجز يشغل الطاولة لمدة ساعتين
        $existingBookingsCount = Booking::where('table_type_id', $request->table_type_id)
            ->where('status', 'confirmed')
            ->whereBetween('booking_date', [
                $bookingTime->copy()->subHours(2),
                $bookingTime->copy()->addHours(2),
            ])->count();

        $tableType = TableType::find($request->table_type_id);

        if ($existingBookingsCount >= $tableType->quantity) {
            return response()->json(['message' => 'عذراً، لا توجد طاولات متاحة في هذا الوقت'], 422);
        }

        // 2. إنشاء الحجز
        $booking = Booking::create([
            'user_id' => auth()->id(), // نأخذه من التوكن تلقائياً
            'restaurant_id' => $request->restaurant_id,
            'table_type_id' => $request->table_type_id,
            'booking_date' => $bookingTime,
            'guests_count' => $request->guests_count,
            'status' => 'pending', // يبدأ كحجز معلق بانتظار موافقة المطعم
        ]);

        return response()->json([
            'message' => 'تم إرسال طلب الحجز بنجاح',
            'booking' => $booking,
        ], 201);
    }

    public function myBookings()
    {
        // جلب الحجوزات مع بيانات المطعم ونوع الطاولة
        return Booking::with(['restaurant', 'tableType'])
            ->where('user_id', auth()->id())
            ->orderBy('booking_date', 'desc')
            ->get();
    }

    public function cancel($id)
    {
        $booking = Booking::where('user_id', auth()->id())->findOrFail($id);

        if ($booking->status == 'pending') {
            $booking->update(['status' => 'cancelled']);

            return response()->json(['message' => 'تم إلغاء الحجز بنجاح']);
        }

        return response()->json(['message' => 'لا يمكن إلغاء حجز مؤكد أو ملغى بالفعل'], 400);
    }
}
