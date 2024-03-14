<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;

class AuthController extends Controller
{
    /**
     * Show the login view.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function loginView() : \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        return view('auth.login');
    }


    /**
     * Handle an incoming authentication request.
     * @param LoginRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(LoginRequest $request) : \Illuminate\Http\RedirectResponse
    {
        $credentials = $request->only('email', 'password', 'remember');
        if (auth()->attempt($credentials, $request->remember)) {
            $request->session()->regenerate();
            return redirect()->route('home');
        }
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }


    /**
     * Log the user out of the application.
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request) : \Illuminate\Http\RedirectResponse
    {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }


}
