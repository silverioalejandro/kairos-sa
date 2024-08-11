<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OperatorPublisherEmail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    private $operator;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(array $operator)
    {
        $this->operator = $operator;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.operator.publisher', $this->operator);
    }
}
