<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Report;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    public function makeReport(Request $request)
    {
        $user = Auth::id();
        $from = $request->input('from');
        $to = $request->input('to');


        $orders = Order::where('status_id', 2)->where('user', $user);
        $reports = Report::whereBetween('date', [$from, $to])->get();
        if (!$orders && !$reports) {
            return response()->json(['empty' => 'No orders recently']);


            $total = 0;

            foreach ($orders as $order) {
                $items = $order->medicine;

                foreach ($items as $item) {
                    $total += $item->price;
                }
            }

        $report = Report::create([
            'is_order' => 1,
            'from' => $from,
            'to' => $to,
            'total' => $total,
            'date' => now(),
        ]);

        return response()->json(['report' => $report], 200);
    }
}

}
