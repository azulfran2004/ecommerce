<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use App\Models\Image;

class ProductController extends Controller
{
    public function files(Product $product, Request $request)
    {
        $request->validate([
            'file' => 'required|image|max:2048'
        ]);
        $url = $request->file('file')->store('products', 'public');
        $product->images()->create([
            'url' => $url
        ]);
    }
    
}
