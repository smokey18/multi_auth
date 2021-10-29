<?php

namespace App\Http\Controllers;

use App\Http\Traits\UpdatePasswordTrait;
use App\Http\Traits\UpdatePersonalInfoTrait;
use App\Http\Traits\UpdateProfileImageTrait;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BuyerController extends Controller
{
    function index()
    {
        $product = Product::all();

        return view('dashboards.buyer.index', compact('product'));
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

    use UpdateProfileImageTrait;

    use UpdatePasswordTrait;

    function detail($id)
    {
        $list = Product::where('id', $id)->first();

        return view('dashboards.buyer.detail', compact('list'));
    }
}