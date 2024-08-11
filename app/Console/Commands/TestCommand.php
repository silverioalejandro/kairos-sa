<?php

namespace App\Console\Commands;

use App\Models\Event;
use App\Models\Budget;
use App\Models\BudgetDetails;
use App\Models\BudgetVehicles;
use App\Models\Freight;
use App\Models\Product;
use App\Models\Customer;
use Illuminate\Console\Command;

class TestCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        $id = 33;
        $data = Budget::with(['event', 'event.customer', 'event.statusEvent', 'operator:id,email', 'statusBudget:id,name', 'paymentType:id,name', 'budgetDetails', 'budgetDetails.product', 'budgetVehicles', 'budgetVehicles.vehicle'])
                ->find($id);

        logger($data->toArray());

        dd($data->toArray());

        dd('test...');
        return 0;
    }
}
