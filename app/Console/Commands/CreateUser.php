<?php

namespace App\Console\Commands;

use App\Actions\Fortify\CreateNewUser;
use Illuminate\Console\Command;

class CreateUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:token {name} {email} {password} {device_name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create an user from the command line';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $input = [
            'name' => $this->argument('name'),
            'password' => $this->argument('password'),
            'password_confirmation' => $this->argument('password'),
            'email' => $this->argument('email'),
            'device_name' => $this->argument('device_name')
        ];

        $action = new CreateNewUser();

        $user = $action->create($input);

        $token = $user->createToken($input['device_name'])->plainTextToken;

        $this->info("User token is : {$token}");

        return Command::SUCCESS;
    }
}
