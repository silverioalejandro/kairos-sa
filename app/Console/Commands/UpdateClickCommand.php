<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\UpdatePublisherCampaignClickService;

class UpdateClickCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:click';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update clicks publisher campaign';

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
        app()->make(UpdatePublisherCampaignClickService::class)->updateClick();
        $this->info('It was executed satisfactorily');
        return 0;
    }
}
