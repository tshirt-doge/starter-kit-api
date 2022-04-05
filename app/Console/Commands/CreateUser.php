<?php

namespace App\Console\Commands;

use App\Enums\Role;
use App\Interfaces\Repositories\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Validation\Rules\Enum;
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
    public function handle(UserRepositoryInterface $repository)
    {
        $attrs = [];
        $attrs['email'] = $this->ask('Enter email address');

        $attrs['first_name'] = $this->ask('Enter first name');
        $attrs['last_name'] = $this->ask('Enter last name');
        $attrs['password'] = $this->secret('Enter password');
        $attrs['roles'] = $this->choice(
            'Enter role',
            ['regular', 'super-admin', 'health-officer', 'medical', 'security'],
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
                    'roles.*' => [new Enum(Role::class)]
                ]
            );
        } catch (ValidationException $e) {
            $this->error($e->getMessage());
            return -1;
        }

        /** @var User $user */
        $user = $repository->create($attrs);
        $fullName = $user->userInfo->full_name;

        $this->info("User created: $fullName | $user->email");
        return 0;
    }
}
