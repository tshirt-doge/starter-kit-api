<?php

namespace App\Repositories\Eloquent;

use App\Interfaces\Repositories\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Throwable;

class UserRepository implements UserRepositoryInterface
{
    /**
     * @inheritDoc
     * @throws Throwable
     */
    public function create(array $userInfo) : User
    {
        return DB::transaction(function () use ($userInfo) {
            $user = User::create([
                'email' => $userInfo['email'],
                'password' => Hash::make($userInfo['password'])
            ]);

            $user->userInfo()->create($userInfo);

            $user->syncRoles(...$userInfo['roles']);

            return $user;
        });
    }

    /**
     * @inheritDoc
     */
    public function read($id)
    {
        return User::findOrFail($id);
    }

    /**
     * @inheritDoc
     */
    public function update($id, array $newUserInfo)
    {
        // TODO: Implement update() method.
    }

    /**
     * @inheritDoc
     */
    public function destroy($id)
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
