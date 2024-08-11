<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use App\Mail\OperatorResetPasswordEmail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class EmailOperatorResetPasswordJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private array $operator;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(array $operator)
    {
        $this->operator = $operator;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
		Mail::to($this->operator['email'])
			->send(new OperatorResetPasswordEmail($this->operator));
    }
}
