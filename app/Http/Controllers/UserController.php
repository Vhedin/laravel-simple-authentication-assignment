<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Requests\UserProfileUpdateRequest;

class UserController extends Controller
{
    public function __construct()
    {
        config_set('theme', [
            'title'      => 'User List',
            'rprefix'    => 'user',
            'breadcrumb' => [
                [
                    'name' => 'Dashboard',
                    'link' => route('home'),
                ],
                [
                    'name' => 'User List',
                    'link' => false,
                ],
            ]
        ]);
    }

    /**
     * Showing User List
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index() : \Illuminate\Contracts\View\View
    {
        // get user list
        $collection = User::paginate(20);
        return view('user.index', compact('collection'));
    }


    /**
     * Showing User Create Form
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create() : \Illuminate\Contracts\View\View
    {
        config_set('theme', [
            'title'      => 'Create User',
            'breadcrumb' => [
                [
                    'name' => 'Dashboard',
                    'link' => route('home'),
                ],
                [
                    'name' => 'User List',
                    'link' => route('user.index'),
                ],
                [
                    'name' => 'Create User',
                    'link' => false,
                ],
            ]
        ]);
        return view('user.create_edit');
    }


    /**
     * Store a newly created user
     * @param \App\Http\Requests\UserCreateRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(UserCreateRequest $request)
    {
        // check if avatar has file
        if ($request->hasFile('avatar')) {
            $request['profile_photo_path'] = $request->avatar->store('users');
        }
        // create user
        $user = User::create($request->all());
        // sync addresses
        $user->addresses()->createMany($request->addresses);
        // success session
        session()->flash('success', __('User created successfully'));
        // redirect to user list
        return redirect(route('user.index'));
    }

    /**
     * Show the specified user
     * @param \App\Models\User $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(User $user) : \Illuminate\Contracts\View\View
    {
        config_set('theme', [
            'title'      => 'User Detail',
            'breadcrumb' => [
                [
                    'name' => 'Dashboard',
                    'link' => route('home'),
                ],
                [
                    'name' => 'User List',
                    'link' => route('user.index'),
                ],
                [
                    'name' => 'User Detail',
                    'link' => false,
                ],
            ]
        ]);
        return view('user.show')->with('item', $user);
    }


    /**
     * Show the form for editing the specified user
     * @param \App\Models\User $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(User $user) : \Illuminate\Contracts\View\View
    {
        config_set('theme', [
            'title'      => 'Edit User',
            'breadcrumb' => [
                [
                    'name' => 'Dashboard',
                    'link' => route('home'),
                ],
                [
                    'name' => 'User List',
                    'link' => route('user.index'),
                ],
                [
                    'name' => 'Edit User',
                    'link' => false,
                ],
            ]
        ]);
        return view('user.create_edit')->with('item', $user);
    }

    /**
     * Update the specified user
     * @param \App\Http\Requests\UserUpdateRequest $request
     * @param \App\Models\User $user
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(UserUpdateRequest $request, User $user)
    {
        // check if avatar has file
        if ($request->hasFile('avatar')) {
            $request['profile_photo_path'] = $request->avatar->store('users');
            // delete old avatar
            if ($user->profile_photo_path) {
                Storage::delete($user->profile_photo_path);
            }
        }
        // check if password is empty
        if (empty($request->password)) {
            $request->request->remove('password');
        }
        // update user
        $user->update($request->all());
        // sync addresses
        $user->addresses()->delete();
        $user->addresses()->createMany($request->addresses);
        // success session
        session()->flash('success', __('User updated successfully'));
        // redirect to user list
        return redirect(route('user.index'));
    }


    /**
     * Remove the specified user
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $user)
    {
        if (auth()->user()->id == $user) {
            session()->flash('error', __('You can\'t delete your account'));
            return response()->error('', __('You can\'t delete your account'), 403);
        }

        if ($request->has('force_delete')) {
            $user = User::withTrashed()->find($user);
            // check profile photo
            if ($user->profile_photo_path) {
                Storage::delete($user->profile_photo_path);
            }
            // delete user
            $user->forceDelete();
        }
        else {
            $user = User::find($user);
            // soft delete user
            $user->delete();
        }

        // success session
        session()->flash('success', __('User deleted successfully'));
        // redirect to user list
        return response()->success('', __('Successfully deleted user account'), 200);
    }

    /**
     * Display a listing of the trashed users
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function trash() : \Illuminate\Contracts\View\View
    {
        config_set('theme', [
            'title'      => 'User Trash List',
            'breadcrumb' => [
                [
                    'name' => 'Dashboard',
                    'link' => route('home'),
                ],
                [
                    'name' => 'User List',
                    'link' => route('user.index'),
                ],
                [
                    'name' => 'User Trash List',
                    'link' => false,
                ],
            ]
        ]);

        $collection = User::onlyTrashed()->paginate(20);
        return view('user.trash', compact('collection'));
    }

    /**
     * Restore the specified user
     * @param \App\Models\User $user
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function restore($user)
    {
        User::withTrashed()->find($user)->restore();
        session()->flash('success', __('User restored successfully'));
        return redirect(route('user.index'));
    }



    /**
     * Show the form for editing the profile
     * @return mixed|\Illuminate\Contracts\View\View
     */
    public function profile() : \Illuminate\Contracts\View\View
    {
        config_set('theme', [
            'title'      => 'Profile',
            'breadcrumb' => [
                [
                    'name' => 'Dashboard',
                    'link' => route('home'),
                ],
                [
                    'name' => 'Profile',
                    'link' => false,
                ],
            ]
        ]);
        return view('user.show')->with('item', auth()->user());
    }

    /**
     * Show the form for editing the profile
     * @return mixed|\Illuminate\Contracts\View\View
     */
    public function editProfile() : \Illuminate\Contracts\View\View
    {
        config_set('theme', [
            'title'      => 'Edit Profile',
            'breadcrumb' => [
                [
                    'name' => 'Dashboard',
                    'link' => route('home'),
                ],
                [
                    'name' => 'Profile',
                    'link' => route('user.profile'),
                ],
                [
                    'name' => 'Edit Profile',
                    'link' => false,
                ],
            ]
        ]);
        return view('user.profile_edit')->with('item', auth()->user());
    }

    /**
     * Update the specified user profile
     * @param \App\Http\Requests\UserUpdateRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function updateProfile(UserProfileUpdateRequest $request)
    {
        // check if avatar has file
        if ($request->hasFile('avatar')) {
            $request['profile_photo_path'] = $request->avatar->store('users');
            // delete old avatar
            if (auth()->user()->profile_photo_path) {
                Storage::delete(auth()->user()->profile_photo_path);
            }
        }
        // check if password is empty
        if (empty($request->password)) {
            $request->request->remove('password');
        }
        // update user
        auth()->user()->update($request->all());
        // sync addresses
        auth()->user()->addresses()->delete();
        auth()->user()->addresses()->createMany($request->addresses);
        // success session
        session()->flash('success', __('User updated successfully'));
        // redirect to user list
        return redirect(route('user.profile'));
    }
}
