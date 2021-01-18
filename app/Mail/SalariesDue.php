<?php

namespace App\Mail;

use App\Models\Employee;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Collection;

class SalariesDue extends Mailable
{
    use Queueable, SerializesModels;

    public $businesses;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Collection $businesses)
    {
        $this->businesses = $businesses;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('employee.salary_due_email');
    }
}
