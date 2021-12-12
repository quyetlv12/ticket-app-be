<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class VerifyEmailController extends Controller
{
    public function verify(Request $request)
    {
        $user = User::find($request->route('id'));

        if ($user->hasVerifiedEmail()) {
            return response()->json(['message' => 'email đã verify' ]);
        }

        if ($user->markEmailAsVerified()) {
            event(new Verified($user));
        }
            return response()->json(['message' => 'email verify thành công' ]);
    }
}
