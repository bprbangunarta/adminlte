<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class PageController extends Controller
{
    public function blank(): View
    {
        return view('pages.blank');
    }

    public function login(): View
    {
        return view('auth.login');
    }
}
