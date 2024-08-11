<?php

namespace App\Exports;

use App\Models\VClickersByTemplate;
use App\Services\PaginationService;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use App\Models\Operator;
use App\Models\Domain;
use Illuminate\Support\Facades\Auth;

class ClickersByTemplateExport implements FromCollection, WithMapping, WithHeadings
{
    use Exportable;
    protected $input;
    private $model;
    private $paginationService;

    public function __construct(array $input)
    {
        $this->input = $input;
        $this->model = new VClickersByTemplate;
        $this->paginationService = new PaginationService;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $model = $this->model->selectRaw("id, site, DATE(created) as created, campaign, template_id, campaign_name, revenue, pay_clicks, organic_clicks, email_clicks, unsubscribe, web_click, verify, general");

        $createdAt = array_search('created', $this->input["filterBy"]);
        if ($createdAt > -1 && count($this->input["filterValues"][$createdAt]) == 2) {
            $startDate = $this->input["filterValues"][$createdAt][0];
            $endDate = $this->input["filterValues"][$createdAt][1];
            $model->whereDate('created', '>=', $startDate)->whereDate('created', '<=', $endDate);
        }

        $domains = [];
        $site = array_search('site', $this->input["filterBy"]);
        if ($site > -1) {
            $domains = $this->input["filterValues"][$site];
        } else {
            $allOperatorPblishers = Operator::where('publisher_id', Auth::user()->publisher_id)->pluck('id');
            $domains = Domain::whereIn("operator_id", $allOperatorPblishers)->pluck('domain');
        }      

        $model->whereIn('site', $domains);
        
        return $model->get();
    }

    public function map($row): array
    {
        return [
            $row->id,
            $row->created,
            $row->site,
            $row->campaign,
            $row->campaign_name,
            $row->template_id,
            $row->revenue,
            $row->pay_clicks,
            $row->organic_clicks,
            $row->email_clicks,
            $row->unsubscribe,
            $row->web_click,
            $row->verify,
            $row->general
        ];
    }

    public function headings(): array
    {
        return [
            'id',
            'created',
            'site',
            'campaign',
            'campaign_name',
            'template',
            'revenue',
            'pay_clicks',
            'organic_clicks',
            'email_clicks',
            'unsubscribe',
            'web_click',
            'verify',
            'general',
        ];
    }
}
