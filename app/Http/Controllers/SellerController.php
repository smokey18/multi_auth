<?php

namespace App\Http\Controllers;

use App\Http\Traits\UpdatePasswordTrait;
use App\Http\Traits\UpdatePersonalInfoTrait;
use App\Http\Traits\UpdateProfileImageTrait;
use Illuminate\Http\Request;

class SellerController extends Controller
{
    function index()
    {
        return view('dashboards.seller.index');
    }

    function profile()
    {
        return view('dashboards.seller.profile');
    }

    function settings()
    {
        return view('dashboards.seller.settings');
    }

    use UpdatePersonalInfoTrait;

    use UpdateProfileImageTrait;

    use UpdatePasswordTrait;
}