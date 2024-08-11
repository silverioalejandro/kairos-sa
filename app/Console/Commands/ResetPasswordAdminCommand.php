<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\OperatorService;

class ResetPasswordAdminCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'operator:reset-password-admin {id}';

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
        app()->make(OperatorService::class)->resetPassword($this->argument('id'));

        $this->info('It was executed satisfactorily');
        return 1;
    }
}
