<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Buses;
use App\Models\Ticket;
use App\Models\Buses_tickes;


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
        return $createtk = Ticket::create($request->all());
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
        $ticket = Ticket::findOrFail($id);
        $ticket->update($request->all());
        return $ticket;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ticket = Ticket::findOrFail($id);
        $ticket->delete();
    }
}
