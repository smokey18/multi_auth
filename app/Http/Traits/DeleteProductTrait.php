<?php

namespace App\Http\Traits;

use App\Models\Product;

trait DeleteProductTrait
{
    function destroy($id)
    {
        Product::where('id', $id)->delete();
        return redirect()->back()->with('success', 'Product Deleted Successfully');
    }
}