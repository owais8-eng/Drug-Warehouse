<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inovoices;
use App\Models\Medicines;
use Illuminate\Support\Facades\Validator;
use App\Models\Order;
use GuzzleHttp\Promise\Create;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{



    public function AddOrder(Request $request) //اضافة طلبية
    {
        $addmed = $request->medicines;
        $validator = Validator::make($addmed, [

            'medicines.*.medicine_id' => 'required',
            'medicines.*.amount' => 'required',
        ]);

        if ($validator->fails())
         {
            return response()->json([
                'message' => 'validate',
                'error' => $validator->errors()
            ]);
        }
        $order = Order::Create([
            'user_id' => Auth::id(),
            'status_id' => 1,
            'payment_id' => 1
        ]);
        foreach ($addmed as $medicineData)
        {
            Inovoices::create([
                'order_id' => $order->id,
                'medicine_id' => $medicineData['medicine_id'],
                'amount' => $medicineData['amount'],
            ]);


            return response()->json(['message' => 'Success'], 200);
        }
    }
    public function getOrders() //عرض طلبات الصيدلاني
    {
        $user_id = Auth::id();
        $orders = Order::where('user_id', $user_id)->get();
        return response()->json($orders);
    }
}
