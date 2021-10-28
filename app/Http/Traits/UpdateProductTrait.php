<?php

namespace App\Http\Traits;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

trait UpdateProductTrait
{
    function update(Request $request)
    {
        $Product = Product::find($request->input('cid'));
        $Product->title = $request->title;
        $Product->description = $request->description;
        $Product->price = $request->price;

        if ($request->hasFile('image')) {

            $path = 'images/' . $Product->image;
            if (File::exists($path)) {
                File::delete($path);
            }

            $image = array();
            foreach ($request->file('image') as $newFile) {
                $extension  = $newFile->getClientOriginalExtension();
                $filename = rand(1000000000, 9999999999) . '.' . $extension;
                $newFile->move('images/', $filename);
                $image[] = $filename;
                $Product->image = implode('|', $image);
            }
        }

        $Product->save();

        return redirect()->back()->with('success', 'Product Updated Successfully');
    }
}