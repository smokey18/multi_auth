<?php

namespace App\Http\Traits;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


trait StoreProductTrait
{
    function store(Request $request, User $user)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'price' => 'required',
            'image' => 'required'
        ]);

        $image = array();
        foreach ($request->file('image') as $newFile) {
            $extension  = $newFile->getClientOriginalExtension();
            $filename = rand(1000000000, 9999999999) . '.' . $extension;
            $newFile->move('images/', $filename);
            $image[] = $filename;
        }
        Product::create([
            'seller_id' => Auth::user()->id,
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            'image' => implode('|', $image),
        ]);

        if ($image) {
            return back()->with('success', 'Post have been successfully inserted');
        } else {
            return back()->with('fail', 'Something went wrong');
        }
    }
}