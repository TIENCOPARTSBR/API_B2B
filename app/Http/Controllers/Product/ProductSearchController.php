<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Interfaces\ProductInterface;
use Illuminate\Http\Request;

class ProductSearchController extends Controller
{
    public function __construct(
        private ProductInterface $product
    ) {}

    public function getProduct(Request $request) {
        return $this->product->getProduct($request->all());
    }
}
