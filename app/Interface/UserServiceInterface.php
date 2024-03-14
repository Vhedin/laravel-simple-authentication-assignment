<?php

namespace App\Interface;

interface UserServiceInterface
{
    /**
     * Get paginated user
     * @param int $perPage
     * @return void
     */
    public function paginate(int $perPage);

    /**
     * Get only trashed user
     * @param int $perPage
     * @return void
     */
    public function onlyTrashedPaginate(int $perPage);

    /**
     * Store user data
     * @param array $data
     * @return void
     */
    public function store(array $data);

    /**
     * Find user by id
     * @param mixed $user_id
     * @return void
     */
    public function findOrFail($user_id);

    /**
     * Update user data
     * @param mixed $user_id
     * @param array $data
     * @return void
     */
    public function update($user_id, array $data);

    /**
     * Delete user
     * @param mixed $user_id
     * @return void
     */
    public function delete($user_id);

    /**
     * Restore user
     * @param mixed $user_id
     * @return void
     */
    public function restore($user_id);

    /**
     * Force delete user
     * @param mixed $user_id
     * @return void
     */
    public function forceDelete($user_id);
}
