<?php

namespace App\Http\Controllers;

use App\Models\Inovoices;
use App\Models\Medicines;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Payments;
use App\Models\Status;

class StatusController extends Controller
{


    public function getAllOrders() //عرض جميع الطلبات لدى صاحب المستودع
    {


        $orders = Order::all();
        return response()->json($orders);
    }


    public function update_status(Request $request, $order_id)
    {
        $medicines = $request->input('medicines');

        $request->validate([
            'status_id' => 'required|in:1,2,3',
            'payment_id' => 'required|in:1,2',

        ]);



        $order = Order::find($order_id);

        if (!$order) {
            return response()->json(['message' => 'Order not found'], 404);
        }


        $order->update([
            'status_id' => $request->input('status_id'),
            'payment_id' => $request->input('payment_id'),
        ]);

        return response()->json(['message' => 'Order status and payment updated successfully']);
    }



    public function processOrder($order_id)
    {
        // احصل على الطلب
        $order = Inovoices::find($order_id);

        if (!$order) {
            return response()->json(['message' => 'Order not found'], 404);
        }

        // احصل على كميات الأدوية المطلوبة في الطلب
        $medicinesInOrder = $order->medicine;

        // قم بفحص الكميات المتوفرة في المستودع وتحديثها
        $errors = [];
        if (!empty($medicinesInOrder)) {
            foreach ($medicinesInOrder as $medicine) {
                $amount = $medicine->amount;
                $requestedAmount = $medicine->pivot->amount; // افتراضيًا نفترض أن كمية الأدوية في الطلب محفوظة في جدول الطلب بميزة ال pivot

                if ($requestedAmount > $amount) {
                    $errors[] = "Insufficient quantity available for medicine ID: {$medicine->id}. Available: $amount, Requested: $requestedAmount.";
                } else {
                    // تحديث كمية الأدوية في المستودع
                    $medicine->amount -= $requestedAmount;
                    $medicine->save();
                }
            }
        } else {
            if (!empty($errors)) {
                return response()->json(['errors' => $errors], 400);
            }




            return response()->json(['message' => 'Order processed successfully'], 200);
        }
    }
}
