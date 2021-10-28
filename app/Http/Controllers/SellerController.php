<?php

namespace App\Http\Controllers;

use App\Http\Traits\DeleteProductTrait;
use App\Http\Traits\StoreProductTrait;
use App\Http\Traits\UpdatePasswordTrait;
use App\Http\Traits\UpdatePersonalInfoTrait;
use App\Http\Traits\UpdateProductTrait;
use App\Http\Traits\UpdateProfileImageTrait;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SellerController extends Controller
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
        $product = Product::with('user')->where('seller_id', Auth::user()->id)->paginate(10);

        return view('dashboards.seller.index', compact('product'));
    }

    function profile()
    {
        return view('dashboards.seller.profile');
    }

    function settings()
    {
        return view('dashboards.seller.settings');
    }

    function create()
    {
        return view('dashboards.seller.create');
    }

    function edit($id)
    {
        $data = array(
            'list' => Product::where('id', $id)->first()
        );
        return view('dashboards.seller.edit', $data);
    }
}