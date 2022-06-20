<?php

namespace App\Console\Commands\Dev;

use Illuminate\Console\Command;

class GetAdminPassword extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pass {name=superadmin}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get default admins password | name argument is login';

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
     * @return int
     */
    public function handle()
    {
        if (env('APP_ENV') !== 'local') {
            $this->warn('Dont run this on production');

            return 0;
        }
        $adminName = $this->argument('name');
        if ($adminName) {
            if (!$password = config('permission.passwords.' . $adminName)) {
                $this->warn(sprintf('User %s not found', $adminName));

                return 0;
            }
            $this->info($password);
        }

        return 1;
    }
}
