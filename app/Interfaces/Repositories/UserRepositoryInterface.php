<?php

namespace App\Interfaces\Repositories;

interface UserRepositoryInterface
{
    /**
     * Create a new user
     *
     * @param array $userInfo
     */
    public function create(array $userInfo);

    /**
     * Read user details
     *
     * @param $id
     */
    public function read($id);

    /**
     * Update an existing user
     *
     * @param $id
     * @param array $newUserInfo
     */
    public function update($id, array $newUserInfo);

    /**
     * Delete a user
     *
     * @param $id
     */
    public function destroy($id);

    /**
     * Fetch a list of users
     *
     * @param array|null $filters
     * @param bool $paginated
     */
    public function list(array $filters = null, bool $paginated = false);
}
