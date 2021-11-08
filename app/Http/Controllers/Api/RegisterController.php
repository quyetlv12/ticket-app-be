<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        $userCreate = User::create([
            "name" => $request->name,
            "email" => $request->email,
            "phone_number" => $request->phone_number,
            "password" => bcrypt($request->password),
            "image" => $request->image,
            "gender" => $request->gender,
        ]);
        return response()->json(
        $userCreate,
         200);
    }
}
