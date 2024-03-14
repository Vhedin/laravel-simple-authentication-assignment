<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    /**
     * redirect to user list
     *
     * @return mixed|\Illuminate\Http\RedirectResponse
     */
    public function index()
    {
        return redirect()->route('user.index');
    }
}
