<?php

namespace App\Exports;

use DateTime;
use App\Models\Ticket;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Contracts\Support\Responsable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class TicketsExport implements
    Responsable,
    ShouldAutoSize,
    WithMapping,
    WithHeadings,
    WithEvents,
    FromQuery
    // WithTitle
{
    use Exportable;

    // private $year;
    // private $month;

    // public function __construct(int $year, int $month) {
    //     $this->year = $year;
    //     $this->month = $month;

    // }

    public function query()
    {
        return Ticket::query()->with('buses');
        // ->whereYear('created_at', $this->year)
        // ->whereMonth('created_at', $this->month);
    }
    public function map($ticket) :array {
        return [
            $ticket->id,
            $ticket->ticket_code,
            $ticket->customer_name,
            $ticket->phone_number,
            $ticket->quantity,
            $ticket->totalPrice,
            $ticket->status,
            $ticket->paymentMethod,
            $ticket->buses->name,
            $ticket->buses->startPointName,
            $ticket->buses->endPointName,
            $ticket->buses->date_active,
            $ticket->buses->start_time,
            $ticket->created_at,
            $ticket->updated_at
        ];
    }
    public function headings(): array {
        return [
            '#',
            'Mã vé',
            'Tên khách hàng',
            'Số điện thoại',
            'Số lượng',
            'Giá',
            'Trạng thái',
            'Phương Thức',
            'Tên chuyến xe',
            'Điểm đi',
            'Điểm đến',
            'Ngày đặt',
            'Thời gian',
            'created_at',
            'updated_at'
        ];
    }
    public function registerEvents(): array {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                    $event->sheet->getStyle('A1:O1')->applyFromArray([
                        'font' => [
                            'bold' => true,
                        ],
                    ]);
                    $event->sheet->getStyle('A1:O33')->applyFromArray([
                        'borders' => [
                            'allBorders' => [
                                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                                'color' => ['argb' => 'black'],
                            ],
                        ]

                    ]);
                },

            ];
    }
    // public function title(): string {
    //     return DateTime::createFromFormat('!m', $this->month)->format('F');
    // }
}
