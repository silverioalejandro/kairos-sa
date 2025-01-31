<?php

namespace App\Console\Commands;

use App\Models\Operator;
use Illuminate\Console\Command;

class UpdateTokenCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:token';

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
        foreach (Operator::all() as $operator) {
            $operator->token = $operator->api_token;
            $operator->save();
        }
        return 1;
    }
}
