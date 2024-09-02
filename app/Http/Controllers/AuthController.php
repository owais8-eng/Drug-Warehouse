<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use function Laravel\Prompts\password;

class AuthController extends Controller

{

  public function registerAdmin(Request $request)
  {
    $e = $request->all();
    $validator = Validator::make($e ,[
      'Pharmacy_name' => 'required|string',
      'phone' => 'required|numeric|unique:users',
      'password' => 'required|string|min:6',
      'confirm_password' => 'required|same:password',
    ]);

    if ($validator->fails()) {
      return response()->json($validator->errors());
    }
   $e['role_id']=1;
    $user=User::create($e);
    $success['token'] = $user->createToken('owais')->accessToken;
    $success['Data'] = $user;
    return response()->json([
      'message' => 'register successfully',
      'user' => $success

    ]);
  }

  public function registerPharmacist(Request $request)
  {
    $e = $request->all();
    $validator = Validator::make($e ,[
      'Pharmacy_name' => 'required|string',
      'phone' => 'required|numeric|unique:users',
      'password' => 'required|string|min:6',
      'confirm_password' => 'required|same:password',
    ]);

    
    if ($validator->fails()) {
      return response()->json([
        'message' => 'register failed !',

      ]);
    }
   $e['role_id']=2;
    $user=User::create($e);
    $success['token'] = $user->createToken('owais')->accessToken;
    $success['Data'] = $user;
    return response()->json([
      'message' => 'register successfully',
      'user' => $success

    ]);
  }


  public function login(Request $request)
  {
    if (Auth::attempt(['phone' => $request->phone,'password' => $request->password]))
     {
      $user = User::query()->find(auth()->user()['id']);
      $success['token'] = $user->createToken('owais')->accessToken;
      $success['name'] = $user;

      return response()->json([
        'data' => $success,
        'message' => 'user login successfully'
      ]);
    }

    return response()->json([
      'message' => 'Invalid login'
    ]);
  }

  public function logout()
  {
    auth()->user()->tokens()->delete();
    return response()->json([
      
      'message' => 'user logout successfully'
    ]);
  }

 }
