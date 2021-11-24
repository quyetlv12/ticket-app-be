<?php

namespace App\Http\Controllers\Api;

use App\Exports\TicketsExport;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Excel;
use App\Exports\TicketMultiSheetExport;

class TicketExportController extends Controller
{
    private $excel;

    public function __construct(Excel $excel) {
        $this->excel = $excel;
    }
    public function export() {
        return $this->excel->download(new TicketsExport, 'tickes.xlsx');
    }
}
