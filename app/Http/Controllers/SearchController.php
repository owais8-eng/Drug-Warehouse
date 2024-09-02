<?php

namespace App\Http\Controllers;


use App\Models\Medicines;
use App\Models\Categories;
use Illuminate\Http\JsonResponse;

class SearchController extends Controller
{
     public function searchbyname($name): JsonResponse
     {
          $Medicine = Medicines::where('trade_name', 'like', '%' . $name . '%')
               ->orwhere('scentific_name', 'like', '%' . $name . '%')->get();

          if ($Medicine) {
               return response()->json([
                    'Medicine'=>$Medicine
               ]);
          }
          return response()->json(
               [
                    'message' => 'not found !'
               ]
          );
     }
     public function searchbycategory($name)
     {
          $Category =Categories::where('name', 'like', '%' . $name . '%')->get();

          if ($Category) {
               return response()->json([
                    'category'=>$name
               ]);
          }
          return response()->json(
               [
                    'message' => 'not found !'
               ]
          );
     }

     public function index()
     {
         $medicines= Medicines::all();
         return response()->json([

          'medicines'=>$medicines
         ]);

     }
     public function selectmed($id)
     {

       //  $medicines = Medicines::find($id);
         $medicine = Medicines::where('id',$id)->first();

         return response()->json([
              'data'=>$medicine
          ]);
     }

}
