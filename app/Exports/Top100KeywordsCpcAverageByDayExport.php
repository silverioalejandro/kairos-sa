<?php

namespace App\Exports;

use App\Models\Domain;
use App\Models\Operator;
use App\Models\Clickers;
use Illuminate\Support\Facades\DB;
use App\Services\PaginationService;
use App\Services\Metrics\Top100KeywordsCpcAverageByDay;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class Top100KeywordsCpcAverageByDayExport implements FromCollection, WithMapping, WithHeadings
{
    use Exportable;

    protected $input;
    private $model;

    public function __construct(array $input)
    {
        $this->input = $input;
        $this->model = new Clickers;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $input = $this->input;

        $data = $this->model->with([])
            ->selectRaw('keyword, avg(cpc) as cpcav, count(1) AS total_clicks')
            ->groupBy('keyword')
            ->orderBy('cpcav', 'desc');


        if(Auth::user()->publisher_id == 10) {
            $data->havingRaw('count(1) >= 10');
        }
        

        if (in_array('created', $input["filterBy"])) {
            $position = array_search('created', $input["filterBy"]);
            $dates = $input["filterValues"][$position];
            $data->whereBetween(DB::raw("DATE(created)"), $dates);
        } else {
            $data->where(DB::raw("DATE(created)"), date('Y-m-d'));
        }
        // Get top 100 records
        return $data->limit(500)->get();
    }

    public function map($row): array
    {
        return [
            $row->keyword,
            number_format($row->cpcav, 2, '.', ','),
            number_format($row->total_clicks, 2, '.', ',')
        ];
    }

    public function headings(): array
    {
        return [
            'Keyword',
            'Average CPC',
            "Total Clicks"
        ];
    }
}
