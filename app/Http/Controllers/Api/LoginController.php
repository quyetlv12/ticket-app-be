<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SessionUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $dataCheckLogin = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if (Auth::attempt($dataCheckLogin)) {
            $checkTokenExit = SessionUser::where('user_id', auth()->id())->first();
            if (empty($checkTokenExit)) {
                $userSession = SessionUser::create([
                    'token' => Str::random(40),
                    'refresh_token' => Str::random(40),
                    'token_expried' => date('Y-m-d H:i:s', strtotime('+30 day')),
                    'refresh_token_expried' => date('Y-m-d H:i:s', strtotime('+365 day')),
                    'user_id' =>auth()->id()
                ]);
            }else{
                $userSession = $checkTokenExit;
            }

            return response()->json([
                'code' => 200,
                'data' => $userSession
            ], 200);
        }else {
            return response()->json([
                'code' => 401,
                'message' => 'username hoặc password không đúng'
            ], 401);
        }
    }
}
