<?php

namespace App\Exports;

use App\Models\Domain;
use App\Models\Operator;
use App\Models\VClickersByHour;
use Illuminate\Support\Facades\DB;
use App\Services\PaginationService;
use App\Services\FeedsTotalsService;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class FeedsByMonthExport implements FromCollection, WithMapping, WithHeadings
{
    use Exportable;
    protected $input;
    private $model;
    private $paginationService;

    public function __construct(array $input)
    {
        $this->input = $input;
        $this->feedsTotalService = new FeedsTotalsService;
        $this->model = new VClickersByHour;
        $this->paginationService = new PaginationService;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return $this->feedsTotalService->index($this->input);

    }

    public function map($row): array
    {

        return [
            $row->day,
            $row->publisher,
            $row->feed,
            number_format($row->revenue, 2, '.', ','),
            number_format($row->cpc, 2, '.', ',')
        ];
    }

    public function headings(): array
    {
        return [
            'Month',
            'Partner',
            'Feed',
            'Revenue',
            'Average CPC'
        ];
    }
}
