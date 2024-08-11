<?php

namespace App\Exports;

use App\Models\Operator;
use App\Helpers\PublisherHelper;
use App\Services\PaginationService;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class MetricsExport implements FromCollection, WithMapping, WithHeadings
{
    use Exportable;

	private $headers = [
		'Content-Type' => 'text/csv ; charset=utf-8',
	];
    protected $input;
    private $model;

	public function __construct(array $input, $model)
	{
        $this->input = $input;
        $this->model = $model;
	}

    public function collection()
    {
        $model = $this->model;
        $operator = Operator::find($this->input['authId']);
        if($operator->role_id == Operator::PUBLISHER){
            $model = $model->where('publisher_id', PublisherHelper::getIdAuth($this->input['authId']));
        }

        $this->model = app()->make(PaginationService::class)->filter($model, $this->input);
		return $this->model->get();
	}

	public function map($data): array
	{
        return [
			$data->id,
			$data->campaign_id,
            $data->template,
            $data->template_type_id,
            $data->api_call,
            $data->error,
            $data->clicks + $data->total_keyword_click,
            $data->total_keyword_click,
            $data->clicks,
            $data->revenue,
            $data->created_at
		];
	}

	public function headings(): array
	{
		return [
			'id',
            'campaign_id',
            'template',
            'template_type_id',
            'api_call',
            'error',
            'Clicks',
            'Other clicks',
            'Paid clicks',
            'revenue',
            'created_at'
		];
	}
}
