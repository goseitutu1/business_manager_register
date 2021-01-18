<?php

namespace App\Mail;

use App\Models\Employee;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class EmployeeAccountCreated extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The employee instance.
     *
     * @var Employee
     */
    public $employee;

    public $password;

    /**
     * Create a new message instance.
     *
     * @param Employee $employee
     * @param $password
     */
    public function __construct(Employee $employee, $password)
    {
        $this->employee = $employee;
        $this->password = $password;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('employee.email');
    }
}
