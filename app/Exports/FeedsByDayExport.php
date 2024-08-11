<?php

namespace App\Exports;

use App\Models\Domain;
use App\Models\Operator;
use App\Models\VClickersByHour;
use Illuminate\Support\Facades\DB;
use App\Services\PaginationService;
use App\Services\Metrics\ClickerByHourService;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class FeedsByDayExport implements FromCollection, WithMapping, WithHeadings
{
    use Exportable;
    protected $input;
    private $model;
    private $paginationService;

    public function __construct(array $input)
    {
        $this->input = $input;
        $this->ClickerByHourService = new ClickerByHourService;
        $this->model = new VClickersByHour;
        $this->paginationService = new PaginationService;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $input = $this->input;
        $data = $this->ClickerByHourService->getFeedStatsByDay();
        // Apply feed filter if present
        $feeds = [];
        if (in_array('feed', $input["filterBy"])) {
            $position = array_search('feed', $input["filterBy"]);
            $feeds = $input["filterValues"][$position];
            $data->whereIn('feed', $feeds);
        }
    
        $pubs = [];
        if (in_array('publisher', $input["filterBy"])) {
            $position = array_search('publisher', $input["filterBy"]);
            $pubs = $input["filterValues"][$position];
            // cast pubs to lower case
            $pubs = array_map('strtolower', $pubs);
            //dd($pubs);
            $data->whereIn('publisher', $pubs);
        }

        if (in_array('month', $input["filterBy"])) {
            $position = array_search('month', $input["filterBy"]);
            $dates = $input["filterValues"][$position];
            $data->whereBetween(DB::raw("date_trunc('day', hour)::date"), $dates);
        } else {
            $data->where(DB::raw("date_trunc('day', hour)::date"), date('Y-m-d'));
        }

        return $data->get();
    }

    public function map($row): array
    {

        return [
            $row->day,
            $row->publisher,
            $row->feed,
            number_format($row->revenue, 2, '.', ','),
            number_format($row->clicks, 2, '.', ','),
            number_format($row->cpc, 2, '.', ',')
        ];
    }

    public function headings(): array
    {
        return [
            'Day',
            'Partner',
            'Feed',
            'Revenue',
            'Clicks',
            'Average CPC'
        ];
    }
}
