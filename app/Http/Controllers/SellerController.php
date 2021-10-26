<?php

namespace App\Http\Controllers;

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
}