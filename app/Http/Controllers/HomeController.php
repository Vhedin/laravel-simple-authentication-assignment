<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * redirect to user list
     * @return mixed|\Illuminate\Http\RedirectResponse
     */
    public function index()
    {
        return redirect()->route('user.index');
    }
}
