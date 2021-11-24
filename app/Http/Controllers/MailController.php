<?php

namespace App\Http\Controllers;

use App\Mail\InfoTicket;
use App\Models\Buses;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class MailController extends Controller
{
    public function sendmail(Request $request)
    {
        // TH no dang nhap roi`
        // if(Auth::user()){
        //     $customerId = Auth::user()->id;
        // }

        // $customer = Session::get('customer');
        // if($customer != ""){
        //     $customerId = $customer['id'];
        // }
        $id = $request->id;
        $checkId = Ticket::where('id', $id)->first();
        $email = Ticket::where('id', $id)->value('email');
        $buseId = Ticket::where('id', $id)->value('buses_id');
        $buse = Buses::where('id', $buseId)->first();
        // dd($buse);
        // dd($email);
        if ($checkId) {
            Mail::to($email)->send(new InfoTicket($email, $checkId, $buse));
            return new JsonResponse(
                [
                    'success' => true,
                    'message' => "Vé của bạn đã được gửi tới email"
                ],
                202
            );
        } else {
            return new JsonResponse(
                [
                    'success' => false,
                    'message' => "Vé của bạn gửi thất bại"
                ], 404
            );
        }
    }
}
