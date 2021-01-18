<?php

namespace App\Console\Commands\Admin;

use App\Models\Admin;
use Illuminate\Console\Command;

class ListAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:list';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'List all the admin accounts which have been created';

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
        $headers = ['Name', 'Email', 'Role'];

        $data  = Admin::all();

        $fields = [];
        $data->each(function ($admin) use (&$fields) {
            $fields[] = [
                'Name' => $admin->user->full_name,
                'email' => $admin->user->email,
                'admin' => $admin->role->name
            ];
        });

        $this->table($headers, $fields);
    }
}
