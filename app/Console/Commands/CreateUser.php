<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class CreateUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'auth:user {email} {name} {password}';

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
     * @return int
     */
    public function handle()
    {
        $name = $this->argument('name');
        $email = $this->argument('email');
        $password = $this->argument('password');
        if (!$email or !$name or !$password) {
            $this->warn('Заполнены не все данные');

            return 0;
        }
        if (User::where('email', $email)->first()) {
            $this->warn('Пользователь с таким email уже существует');

            return 0;
        }
        $isCreated = User::create([
            'name' => $name,
            'password' => bcrypt($password),
            'email' => $email,
        ]);
        if (!$isCreated) {
            $this->warn('Чет трабл, не получилось создать');

            return 0;
        }

        $this->info('Пользователь успешно создан');

        return 1;
    }
}
