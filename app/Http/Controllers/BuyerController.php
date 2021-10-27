<?php

namespace App\Http\Controllers;

use App\Http\Traits\UpdatePersonalInfoTrait;
use Illuminate\Http\Request;

class BuyerController extends Controller
{
    function index()
    {
        return view('dashboards.buyer.index');
    }

    function profile()
    {
        return view('dashboards.buyer.profile');
    }

    function settings()
    {
        return view('dashboards.buyer.settings');
    }

    use UpdatePersonalInfoTrait;
}