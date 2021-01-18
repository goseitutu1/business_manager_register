<?php

namespace App\Console\Commands\Admin;

use App\Models\Admin as AdminModel;
use App\Models\AdminRole;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class CreateAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates new admin acccount';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(AdminModel $admin)
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
        $details = $this->getDetails();

        $admin = $this->createAdmin($details);

        $this->display($admin);
    }

    /**
     * Ask for admin details.
     *
     * @return array
     */
    private function getDetails() : array
    {
        $roles = AdminRole::pluck('name')->toArray();

        $details['first_name'] = $this->ask('First Name');
        $details['last_name'] = $this->ask('Last Name');
        $details['email'] = $this->ask('Email');
        $details['password'] = $this->secret('Password');
        $details['confirm_password'] = $this->secret('Confirm password');
        $name = $this->choice('What is the admin role?', $roles, 0);
        $details['role_id'] = AdminRole::where('name', 'like', $name)->first()->id;

        while (!$this->isValidPassword($details['password'], $details['confirm_password'])) {
            if (!$this->isRequiredLength($details['password'])) {
                $this->error('Password must be more that six characters');
            }

            if (!$this->isMatch($details['password'], $details['confirm_password'])) {
                $this->error('Password and Confirm password do not match');
            }

            $details['password'] = $this->secret('Password');
            $details['confirm_password'] = $this->secret('Confirm password');
        }

        $details['type'] = "admin";
        return $details;
    }


    /**
     * Creates new admin record.
     *
     * @param array $details
     * @return mixed
     */
    private function createAdmin(array $details)
    {
        $details['password'] = Hash::make($details['password']);
        $user = User::create($details);
        $user->log("created new user " . $user->id);

        $admin = AdminModel::create([
            'user_id' => $user->id,
            'role_id' => $details['role_id'],
        ]);
        $user->log("created new admin account " . $admin->id);

        return $admin;
    }

    /**
     * Display created admin.
     *
     * @param App\Models\AdminModel
     * @return void
     */
    private function display(AdminModel $admin) : void
    {
        $headers = ['Name', 'Email', 'Role'];

        $fields = [
            'Name' => $admin->user->full_name,
            'email' => $admin->user->email,
            'admin' => $admin->role->name
        ];

        $this->info('Super admin created');
        $this->table($headers, [$fields]);
    }

    /**
     * Check if password is valid
     *
     * @param string $password
     * @param string $confirmPassword
     * @return boolean
     */
    private function isValidPassword(string $password, string $confirmPassword) : bool
    {
        return $this->isRequiredLength($password) &&
            $this->isMatch($password, $confirmPassword);
    }

    /**
     * Check if password and confirm password matches.
     *
     * @param string $password
     * @param string $confirmPassword
     * @return bool
     */
    private function isMatch(string $password, string $confirmPassword) : bool
    {
        return $password === $confirmPassword;
    }

    /**
     * Checks if password is longer than six characters.
     *
     * @param string $password
     * @return bool
     */
    private function isRequiredLength(string $password) : bool
    {
        return strlen($password) > 6;
    }
}
