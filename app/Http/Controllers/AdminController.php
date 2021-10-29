<?php

namespace App\Http\Controllers;

use App\Http\Traits\DeleteProductTrait;
use App\Http\Traits\StoreProductTrait;
use App\Http\Traits\UpdatePasswordTrait;
use App\Http\Traits\UpdatePersonalInfoTrait;
use App\Http\Traits\UpdateProductTrait;
use App\Http\Traits\UpdateProfileImageTrait;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{

    // Traits

    use UpdatePersonalInfoTrait;

    use UpdateProfileImageTrait;

    use UpdatePasswordTrait;

    use StoreProductTrait;

    use UpdateProductTrait;

    use DeleteProductTrait;

    // Controller Functions

    function index()
    {
        $product = Product::with('user')->get();

        return view('dashboards.admin.index', compact('product'));
    }

    function profile()
    {
        return view('dashboards.admin.profile');
    }

    function settings()
    {
        return view('dashboards.admin.settings');
    }

    function create()
    {
        return view('dashboards.admin.create');
    }

    function edit($id)
    {

        $list = Product::where('id', $id)->first();

        return view('dashboards.admin.edit', compact('list'));
    }
}