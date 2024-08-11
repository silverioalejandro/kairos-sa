<?php

namespace App\Exports;

use App\Models\Domain;
use App\Models\Operator;
use App\Models\VClickersDate;
use Illuminate\Support\Facades\DB;
use App\Services\PaginationService;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class ClickerExportCampaignName implements FromCollection, WithMapping, WithHeadings
{
    use Exportable;

    protected $input;
    private $model;
    private $paginationService;

    public function __construct(array $input)
    {
        $this->input = $input;
        $this->model = new VClickersDate;
        $this->paginationService = new PaginationService;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $input = $this->input;
        $data = $this->model->with([])
            ->selectRaw('min(id) id, DATE(created_at) as created_at, site, count(1) total_click, sum(cpc) as revenue, (sum(cpc) /count(1)) average, campaign_name')->groupBy(DB::raw('DATE(created_at)'), 'campaign_name', 'site');

        $createdAt = array_search('created_at', $input["filterBy"]);
        if ($createdAt > -1) {
            $data->whereBetween(DB::raw("DATE(created_at_date)"), $input["filterValues"][$createdAt]);
        }

        $createdAt = array_search('created_at', $input["filterBy"]);
        if ($createdAt > -1) {
            $data->whereBetween(DB::raw("DATE(created_at_date)"), $input["filterValues"][$createdAt]);
        }

        $domains = [];
        $site = array_search('site', $input["filterBy"]);
        if ($site > -1) {
            $domains = $input["filterValues"][$site];
        } else {
            $allOperatorPblishers = Operator::where('publisher_id', Auth::user()->publisher_id)->pluck('id');
            $domains = Domain::whereIn("operator_id", $allOperatorPblishers)->pluck('domain');
        }

        $data->whereIn('site', $domains);
        $data->orderBy('created_at', 'desc');

        $this->model = $this->paginationService
            ->filter($data, $input);

        return $this->model->get();
    }

    public function map($row): array
    {
        return [
            $row->campaign_name,
            $row->created_at,
            $row->site,
            $row->total_click,
            number_format($row->revenue, 2, '.', ','),
            number_format($row->average, 2, '.', ',')
        ];
    }

    public function headings(): array
    {
        return [
            'Campaign Name',
            'Created',
            'Site',
            'Clicks',
            'Revenue',
            'Average'
        ];
    }
}
