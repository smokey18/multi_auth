<?php

namespace App\Http\Controllers;

use App\Http\Traits\UpdatePasswordTrait;
use App\Http\Traits\UpdatePersonalInfoTrait;
use App\Http\Traits\UpdateProfileImageTrait;
use App\Models\Cart;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Stripe;

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

    function addToCart(Request $request)
    {
        if (Auth::user()->role === 2) {
            Cart::insert([
                'buyer_id' => Auth::user()->id,
                'product_id' => $request->product_id
            ]);
            return response()->json(['status' => 1, 'msg' => 'Added to Cart Successfully']);
        } else {
            return response()->json(['status' => 0, 'msg' => 'Please Login First']);
        }
    }

    function cartList(Product $product)
    {
        $cart = Cart::with(['user', 'product'])->where('buyer_id', Auth::id())
            ->paginate(10);

        return view('dashboards.buyer.cart', compact('cart'));
    }

    function removeCart($id)
    {
        $cart = Cart::where('id', $id)->delete();

        if (!$cart) {
            return response()->json(['status' => 0, 'msg' => 'Something went wrong.']);
        } else {
            return response()->json(['status' => 1, 'msg' => 'Cart Removed Successfully']);
        }
    }

    function checkout()
    {
        $cart = Cart::with(['user', 'product'])->where('buyer_id', Auth::user()->id)->paginate(10);

        return view('dashboards.buyer.checkout', compact('cart'));
    }

    public function stripePost(Request $request)
    {

        $price = Cart::with(['user', 'product'])->where('buyer_id', Auth::user()->id)->paginate(10);

        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        Stripe\Charge::create([
            "amount" => $price,
            "currency" => "usd",
            "source" => $request->stripeToken,
            "description" => "Making test payment."
        ]);

        return redirect()->back()->with('success', 'Payment successful!');
    }
}