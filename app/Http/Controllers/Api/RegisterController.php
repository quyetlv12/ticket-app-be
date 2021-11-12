<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\Console\Input\Input;

class RegisterController extends Controller
{
    public function register(Request $request)
    {

        $email = User::where('email', '=', $request->email)->first() ;
        $phone_number = User::where('phone_number', '=', $request->phone_number)->first();
        if( ! $email AND ! $phone_number){
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
        }elseif(!$phone_number){
            return response()
            ->json(['error' => 'Error: Email đã được sử dụng']);
        }else {
            return response()
            ->json(['error' => 'Error: SĐT đã được sử dụng']);
        }
    }
}
