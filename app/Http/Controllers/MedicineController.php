<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Medicines;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\Inovoices;
class MedicineController extends Controller
{
    public function AddMedicine(Request $request)//اضافة  دواء 
    {



        $validator = Validator::make($request->all(), [
            'scentific_name' => 'required',
            'trade_name' => 'required',
            'category_id' => 'required',
            'company' => 'required',
            'amount' => 'required',
            'expiry_date' => 'required',
            'price' => 'required'
        ]);


        if ($validator->fails()) {
            return response()->json([
                'message' => ' failed !',
            ]);
        }
        $e = $request->all();
        $medicine = Medicines::create($e);
        return response()->json([
            'message' => ' success ',
            'data' => $medicine
        ]);
    }

    
    public function showMedicine($name)//عرض الادوية عن طريق التصنيف
    {
        $medicine = Categories::where('name',$name)->with('med')->get();
        if ($medicine->isEmpty() ) {
            return response()->json([
                "success" => false,
                "message" => "not found.",
            ],200);
          
        }

        return response()->json([
            "success" => true,
            "message" => "medicine retrieved successfully.",
            "data" => $medicine
        ]);
    }
}
