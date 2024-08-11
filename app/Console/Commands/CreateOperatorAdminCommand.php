<?php

namespace App\Console\Commands;

use App\Services\OperatorService;
use Illuminate\Console\Command;

class CreateOperatorAdminCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'operator:create-admin {name} {email}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create Operator Admin';

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
     * @return mixed
     */
    public function handle()
    {
        app()->make(OperatorService::class)->createAdmin([
            'name' => $this->argument('name'),
            'email' => $this->argument('email')
        ]);

        $this->info('It was executed satisfactorily');
        return 1;
    }
}
