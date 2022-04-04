<?php

namespace App\Interfaces;

interface UserRepository
{
    /**
     * Create a new user
     *
     * @param array $userCreds
     * @param array $userInfo
     * @param array $roles
     */
    public function create(array $userCreds, array $userInfo, array $roles);

    /**
     * Read user details
     *
     * @param int $id
     */
    public function read(int $id);

    /**
     * Update an existing user
     *
     * @param int $id
     * @param array $newUserInfo
     */
    public function update(int $id, array $newUserInfo);

    /**
     * Delete a user
     *
     * @param int $id
     */
    public function destroy(int $id);

    /**
     * Fetch a list of users
     *
     * @param array|null $filters
     * @param bool $paginated
     */
    public function list(array $filters = null, bool $paginated = false);
}
