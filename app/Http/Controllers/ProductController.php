<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Inertia\Inertia;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::query()->paginate(30);
        return Inertia::render(
            'Home',
            ['products' => $products]
        );
    }
}
