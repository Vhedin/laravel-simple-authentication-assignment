<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserProfileUpdateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Interface\UserServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserServiceInterface $userService)
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
            ],
        ]);
        $this->userService = $userService;
    }

    /**
     * Showing User List
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index() : \Illuminate\Contracts\View\View
    {
        // get user list
        $collection = $this->userService->paginate(20);

        return view('user.index', compact('collection'));
    }

    /**
     * Showing User Create Form
     *
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
            ],
        ]);

        return view('user.create_edit');
    }

    /**
     * Store a newly created user
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(UserCreateRequest $request)
    {
        // check if avatar has file
        if ($request->hasFile('avatar')) {
            $request['profile_photo_path'] = $request->avatar->store('users');
        }
        $request['password'] = Hash::make($request->password);
        // create user
        $this->userService->store($request->all());
        // success session
        session()->flash('success', __('User created successfully'));

        // redirect to user list
        return redirect(route('user.index'));
    }

    /**
     * Show the specified user
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show($user) : \Illuminate\Contracts\View\View
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
            ],
        ]);
        $user = $this->userService->findOrFail($user);

        return view('user.show')->with('item', $user);
    }

    /**
     * Show the form for editing the specified user
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($user) : \Illuminate\Contracts\View\View
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
            ],
        ]);
        $user = $this->userService->findOrFail($user);

        return view('user.create_edit')->with('item', $user);
    }

    /**
     * Update the specified user
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(UserUpdateRequest $request, $user)
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
        else {
            $request['password'] = Hash::make($request->password);
        }
        // update user
        $this->userService->update($user, $request->all());
        // success session
        session()->flash('success', __('User updated successfully'));

        // redirect to user list
        return redirect(route('user.index'));
    }

    /**
     * Remove the specified user
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $user)
    {
        if (auth()->user()->id == $user) {
            session()->flash('error', __('You can\'t delete your account'));

            return response()->error('', __('You can\'t delete your account'), 403);
        }

        if ($request->has('force_delete')) {
            // force delete user
            $this->userService->forceDelete($user);
        }
        else {
            // delete user
            $this->userService->delete($user);
        }

        // success session
        session()->flash('success', __('User deleted successfully'));

        // redirect to user list
        return response()->success('', __('Successfully deleted user account'), 200);
    }

    /**
     * Display a listing of the trashed users
     *
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
            ],
        ]);

        $collection = $this->userService->onlyTrashedPaginate(20);

        return view('user.trash', compact('collection'));
    }

    /**
     * Restore the specified user
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function restore($user)
    {
        // restore user
        $this->userService->restore($user);
        session()->flash('success', __('User restored successfully'));

        return redirect(route('user.index'));
    }

    /**
     * Show the form for editing the profile
     *
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
            ],
        ]);

        return view('user.show')->with('item', auth()->user());
    }

    /**
     * Show the form for editing the profile
     *
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
            ],
        ]);

        return view('user.profile_edit')->with('item', auth()->user());
    }

    /**
     * Update the specified user profile
     *
     * @param  \App\Http\Requests\UserUpdateRequest  $request
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
        $this->userService->update(auth()->user(), $request->all());
        // success session
        session()->flash('success', __('User updated successfully'));

        // redirect to user list
        return redirect(route('user.profile'));
    }
}
