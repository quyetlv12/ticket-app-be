<?php

namespace App\Http\Controllers\Api;

use App\Exports\TicketsExport;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Excel;
use App\Exports\TicketMultiSheetExport;
use App\Models\Ticket;
class TicketExportController extends Controller
{
    private $excel;

    public function __construct(Excel $excel) {
        $this->excel = $excel;
    }
    public function export(Request $request) {
        $from_date=!empty($request->from_date)?$request->from_date:"";
        $to_date=!empty($request->to_date)?$request->to_date:"";
        $today=!empty($request->today)?$request->today:"";
        return $this->excel->download(new TicketsExport($from_date,$to_date,$today), 'tickes.xlsx');

    }
}
