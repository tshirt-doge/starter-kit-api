<?php

namespace App\Repositories;

use App\Interfaces\UserRepository;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Throwable;

class EloquentUserRepository implements UserRepository
{
    /**
     * @inheritDoc
     * @throws Throwable
     */
    public function create(array $userCreds, array $userInfo, array $roles)
    {
        return DB::transaction(function () use ($roles, $userCreds, $userInfo) {
            $user = User::create([
                'email' => $userCreds['email'],
                'password' => Hash::make($userCreds['password'])
            ]);

            $user->userInfo()->create($userInfo);

            $user->syncRoles(...$roles);

            return $user;
        });
    }

    /**
     * @inheritDoc
     */
    public function read(int $id)
    {
        return User::findOrFail($id);
    }

    /**
     * @inheritDoc
     */
    public function update(int $id, array $newUserInfo)
    {
        // TODO: Implement update() method.
    }

    /**
     * @inheritDoc
     */
    public function destroy(int $id)
    {
        return User::destroy($id);
    }

    /**
     * @inheritDoc
     */
    public function list(array $filters = null, bool $paginated = false)
    {
        return User::all();
    }
}
