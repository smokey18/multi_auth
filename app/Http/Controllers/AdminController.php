<?php

namespace App\Http\Controllers;

use App\Http\Traits\UpdatePersonalInfoTrait;
use App\Http\Traits\UpdateProfileImageTrait;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    function index()
    {
        return view('dashboards.admin.index');
    }

    function profile()
    {
        return view('dashboards.admin.profile');
    }

    function settings()
    {
        return view('dashboards.admin.settings');
    }

    use UpdatePersonalInfoTrait;

    use UpdateProfileImageTrait;
}