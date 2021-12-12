<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Buses;
use App\Models\Ticket;
use App\Models\Buses_tickes;
use App\Models\statistical;
use Carbon\Carbon;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return Ticket::join('users', 'user_id', '=', 'users.id')
        //     ->join('buses', 'buses_id', '=', 'buses.id')
        //     ->select(
        //         'tickets.id',
        //         'users.name',
        //         'users.email',
        //         'tickets.status',
        //         )
        // // ->paginate(5)
        // // ->orderBy('id_ticket', 'asc')
        //     ->get();
        // return $list_ticket = Ticket::join('users', 'user_id', '=', 'users.id')
        // ->select(
        //         'tickets.id',
        //         'users.name',
        //         'users.email',
        //         'tickets.booking_date',
        //         'tickets.status',
        //         )
        // // ->paginate(5)
        // // ->orderBy('id_ticket', 'asc')
        // ->with('Buses')->get();
        $list_tk = Ticket::with('Buses')->get();
        return $list_tk;

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $date_ticket = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d');
        $data = [
            'ticket_code' => 'SL' .rand(1000,9999),
            'buses_id' => $request->buses_id,
            'user_id' => $request->user_id,
            'customer_name' => $request->customer_name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'quantity' => $request->quantity,
            'identity_card' => $request->identity_card,
            'status' => $request->status,
            'paymentMethod' => $request->paymentMethod,
            'totalPrice' => $request->totalPrice,
            'description' => $request->description,
            'date_ticket'=> $date_ticket
        ];
        return Ticket::create($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $ticket = Ticket::with('buses')->where('id', '=', $id)->first();

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ticket = Ticket::find($id);
        return $ticket;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $ticket = Ticket::find($id);
        $ticket->update($request->all());
          $ticket_date = $ticket->date_ticket;
        $statistic = statistical::where('ticket_date',$ticket_date)->get();
        if($statistic){
            $statistic_count = $statistic->count();
        }else{
            $statistic_count = 0;
        }
        if($ticket->status == "DONE"){
            $total_price = $ticket->totalPrice;
            $qty_ticket = 1;
            if($statistic_count>0){
                $statistic_update = statistical::where('ticket_date',$ticket_date)->first();
                $statistic_update->total_price = $statistic_update->total_price + $total_price;
                $statistic_update->qty_ticket = $statistic_update->qty_ticket + $qty_ticket;
                $statistic_update->save();
                return response()->json(['message' => 'cập nhật thành công']);
            }else{
                $statistic_new = new statistical();
                $statistic_new->ticket_date =  $ticket_date;
                $statistic_new->total_price =  $total_price;
                $statistic_new->qty_ticket = $qty_ticket;
                $statistic_new->save();
                return response()->json(['message' => 'Thêm thành công']);
                //return 2;
            }
        }
        // $ticket->update($request->all());
        // return $ticket;
    }
// lọc theo khoảng thời gian từ .... đến....
    public function loc_khoang_tgian(Request $request){
        $date_from = $request->date_from;
        $date_to = $request->date_to;
        return $get = statistical::whereBetween('ticket_date',[$date_from,$date_to])->orderBy('ticket_date','ASC')->get();


    }
    // lọc theo mốc tgian  7 ngày qua, tháng này, tháng trước, 1 năm vừa qua
    public function loc_theo_thang(Request $reques){
        $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
        $sub7day = Carbon::now('Asia/Ho_Chi_Minh')->subdays(7)->toDateString();
        $thangnay = Carbon::now('Asia/Ho_Chi_Minh')->startOfMonth()->toDateString();
        $dauthangtrc = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->startOfMonth()->toDateString();
        $cuoithangtrc = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->endOfMonth()->toDateString();
        $sub365day = Carbon::now('Asia/Ho_Chi_Minh')->subdays(365)->toDateString();
        if($reques->date_loc == "7ngay")
        {
           return $get = statistical::whereBetween('ticket_date',[$sub7day,$now])->orderBy('ticket_date','ASC')->get();
        }
        else if($reques->date_loc == "thangnay"){
            return $get = statistical::whereBetween('ticket_date',[$thangnay,$now])->orderBy('ticket_date','ASC')->get();
        }
        else if($reques->date_loc == "thangtruoc"){
            return $get = statistical::whereBetween('ticket_date',[$dauthangtrc,$cuoithangtrc])->orderBy('ticket_date','ASC')->get();
        }else{
            return $get = statistical::whereBetween('ticket_date',[$sub365day,$now])->orderBy('ticket_date','ASC')->get();
        }
    }
    // hàm mặc định khi load trang sẽ chạy hàm này để view biểu đồ
    public function loc_default(){
        $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
        $sub30day = Carbon::now('Asia/Ho_Chi_Minh')->subdays(30)->toDateString();
        return $get = statistical::whereBetween('ticket_date',[$sub30day,$now])->orderBy('ticket_date','ASC')->get();
    }
    public function destroy($id)
    {
        $ticket = Ticket::findOrFail($id);
        $ticket->delete();
    }
    public function searchTK(Request $request)
    {
        $search_query = Ticket::with(['buses']);
        if ($request->ticket_code) {
            $search_query->where('ticket_code', $request->ticket_code);
        }
        if ($request->phone_number) {
            $search_query->where('phone_number', $request->phone_number);
        }
        $ticket = $search_query->get();
        return $ticket;
    }
}
