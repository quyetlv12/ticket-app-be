<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class TicketMultiSheetExport implements WithMultipleSheets
{
    private $year;

    public function __construct(int $year) {
        $this->year = $year;
    }
    public function sheets(): array {
        $sheets = [];
        for ($month = 1; $month <= 12; $month ++) {
            $sheets[] = new TicketsExport($this->year, $month);
        }
        return $sheets;
    }
}
