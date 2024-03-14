<?php

namespace App\Services;

use App\Models\User;
use App\Events\UserSaved;
use App\Interface\UserServiceInterface;
use Illuminate\Support\Facades\Storage;

class UserService implements UserServiceInterface
{
    /**
     * Get paginated user
     * @param int $perPage
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function paginate(int $perPage = 20)
    {
        return User::paginate($perPage);
    }

    /**
     * Get only trashed user
     * @param int $perPage
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function onlyTrashedPaginate(int $perPage = 20)
    {
        return User::onlyTrashed()->paginate($perPage);
    }

    /**
     * Find user by id
     * @param mixed $user_id
     * @return User|User[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model
     */
    public function findOrFail($user_id)
    {
        return User::findOrFail($user_id);
    }

    /**
     * Store user data
     * @param array $data
     * @return User|\Illuminate\Database\Eloquent\Model
     */
    public function store(array $data)
    {
        // create user
        $user = User::create($data);
        // fire event
        event(new UserSaved($user, $data['addresses']));
        return $user;
    }

    /**
     * Update user data
     * @param mixed $user_id
     * @param array $data
     * @return User|User[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model
     */
    public function update($user_id, array $data)
    {
        $user = $this->findOrFail($user_id);
        $user->update($data);
        // fire event
        event(new UserSaved($user, $data['addresses']));
        return $user;
    }

    /**
     * Update user profile
     * @param mixed $user_id
     * @return bool|mixed|null
     */
    public function delete($user_id)
    {
        $user = $this->findOrFail($user_id);
        return $user->delete();
    }

    /**
     * Restore user
     * @param mixed $user_id
     * @return mixed
     */
    public function restore($user_id)
    {
        $user = User::withTrashed()->find($user_id);
        $user->restore();
        return $user;
    }

    /**
     * Force delete user
     * @param mixed $user_id
     * @return mixed
     */
    public function forceDelete($user_id)
    {
        $user = User::withTrashed()->find($user_id);
        // check profile photo
        if ($user->profile_photo_path) {
            Storage::delete($user->profile_photo_path);
        }
        // delete user
        return $user->forceDelete();
    }
}
