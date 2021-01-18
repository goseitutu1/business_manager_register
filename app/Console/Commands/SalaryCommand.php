<?php

namespace App\Console\Commands;

use App\Mail\SalariesDue;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SalaryCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'salary:emails {--salary-due}';

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
     * @return mixed
     */
    public function handle()
    {
        if ($this->option('salary-due')) {
            $admins = User::where('type', 'manager')
                ->whereHas('businesses', function ($row) {
                    $row->whereHas('employees', function ($employee) {
                        $employee->where('salary_due_date', today()->endOfMonth())
                            ->where('salary_reminder', 'like', '%monthly%')
                            ->where('salary', '>', 0);
                    });
                })->get();
            $admins->each(function ($admin) {
                Mail::to($admin)->send(new SalariesDue($admin->businesses));
            });
        }
    }
}
