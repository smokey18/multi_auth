<?php

namespace App\Http\Controllers;

use App\Http\Traits\UpdatePersonalInfoTrait;
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
}