<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class ProjectSetup extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'project:setup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sets up the project my running migration and other relevant commands for you';

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
//        TODO!: add generating of api keys using 'apikey:generate' command
        $this->info("Setting up project");

        if (app()->isLocal()) {
            $this->info("Running migrations");
            Artisan::call('migrate');

            $this->info("Seeding Tables");
            $this->call('db:seed');
        }
        if (app()->isProduction()) {
            if ($this->confirm("You're in production. Do you wish to continue?")) {
                $this->info("Running migrations");
                $this->call('migrate');

                $this->info("Seeding Tables");
                $this->call("db:seed", ["--class" => 'ProjectSetupSeeder']);
            }
        }
        $this->info("Project Setup Completed");
        return;
    }
}
