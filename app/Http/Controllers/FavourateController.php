<?php

namespace App\Http\Controllers;

use App\Models\Favourate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Medicines;

class FavourateController extends Controller
{
    public function get_favourate()
    {

        $userId = Auth::id();
        $favourate = Favourate::where('user_id', $userId)->with('medicine')->get();
        return response()->json([
            'favourate' => $favourate
        ], 200);
    }
  

    // FavoriteControlle

   public function addToFavorites(Request $request, $medicineId)
    {
        $medicine = Medicines::find($medicineId);

        if (!$medicine) {
            return response()->json(['message' => 'Medicine not found'], 404);
        }

        $userId = Auth::id();

        // تحقق مما إذا كان المنتج موجودًا في قائمة المفضلة بالفعل لهذا المستخدم
        $existingFavorite = Favourate::where('user_id', $userId)
            ->where('medicine_id', $medicineId)
            ->first();

        if ($existingFavorite) {
            return response()->json(['message' => 'Medicine already in favorites'], 400);
        }

        // إضافة المنتج إلى قائمة المفضلة
        $favorite = Favourate::create([
            'user_id' => $userId,
            'medicine_id' => $medicineId,
        ]);

        return response()->json(['message' => 'Product added to favorites', 'favorite' => $favorite], 200);
    }
}


