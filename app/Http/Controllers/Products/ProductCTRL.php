<?php

namespace App\Http\Controllers\Products;

use Illuminate\Http\Request;

use App\Models\Products;


class ProductCTRL extends \App\Http\Controllers\Controller
{
  public function index($parent_id, $id) {
    $product = Products::with('comments')->with('same_products')->find($id);
    foreach($product->same_products as $index => $s_product) {
      if ($product->id == $s_product->id) {
        unset($product->same_products[$index]);
      }
    }

    if ($product->same_products->count() > 3) {
      unset($product->same_products[0]);
    }

    return view('products.product')->with(['product' => $product]);
  }
  
}
