<?php

namespace App\Console\Commands;

use App\Models\User;
use Hash;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Testing\Fluent\Concerns\Has;
use Illuminate\Validation\ValidationException;
use Throwable;
use Validator;

class CreateUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a user';

    /**
     * Execute the console command.
     *
     * @return int
     * @throws Throwable
     */
    public function handle()
    {
        $attrs = [];
        $attrs['email'] = $this->ask('Enter email address: ');

        $attrs['first_name'] = $this->ask('Enter first name: ');
        $attrs['last_name'] = $this->ask('Enter last name: ');
        $attrs['password'] = $this->secret('Enter password: ');
        $roles = $this->choice(
            'Enter role: ',
            ['regular', 'super-admin', 'security', 'health-officer', 'medical'],
            null,
            null,
            true
        );

        try {
            Validator::validate(
                $attrs,
                [
                    'email' => ['unique:users,email', 'email'],
                    'password' => ['required', 'min:6'],
                    'first_name' => ['required', 'string'],
                    'last_name' => ['required', 'string'],
                ]
            );
        } catch (ValidationException $e) {
            $this->error($e->getMessage());
            return -1;
        }

        // create the User
        DB::transaction(function () use ($attrs, $roles) {
            $user = User::create([
                'email' => $attrs['email'],
                'password' => Hash::make($attrs['password'])
            ]);

            $user->userInfo()->create([
                'first_name' => $attrs['first_name'],
                'last_name' => $attrs['last_name'],
            ]);

            $user->syncRoles(...$roles);

            $this->info('User created');

            return 0;
        });

        return -1;
    }
}
