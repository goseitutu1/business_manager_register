<?php

namespace App\Console\Commands\Admin;

use Illuminate\Console\Command;
use App\Models\Admin;

class DeleteAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:delete';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete an admin account';

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
        $id = $this->display();
        if (!is_null($id)) {
            $admin = Admin::where('id_hash', $id)->first();
            $admin->delete();
            $admin->user->delete();

            $this->info("Account deleted successfully!");
        }
    }

    private function display()
    {
        $headers = ['Id', 'Name', 'Email', 'Role'];

        $data  = Admin::all();

        $fields = [];
        $data->each(function ($admin) use (&$fields) {
            $fields[] = [
                'id' => $admin->id_hash,
                'Name' => $admin->user->full_name,
                'email' => $admin->user->email,
                'admin' => $admin->role->name
            ];
        });

        $this->table($headers, $fields);

        $id = null;
        if (count($fields) > 0)
            $id = $this->ask('Choose account to delete. eg. ' . $fields[0]['id']);

        return $id;
    }
}
